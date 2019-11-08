<?php  

namespace App\Repositories\Payments;

use DB;
use Veritrans_Snap;
use Veritrans_Config;
use App\Models\Package;
use App\Models\Payment;
use Veritrans_Transaction;
use Veritrans_Notification;

class VeritransRepository implements PaymentsInterface
{
	public function __construct()
	{
		// Set midtrans configuration
        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
	}

	public function submit($request, $user = null)
	{
		DB::beginTransaction();

		$request = is_array($request) ? (object) $request : $request;
    		
    	try {

    		$user = isset($user) ? $user : auth()->user();

	        $package = Package::find($request->id);

	        // Save payment ke database
	        $payment = $user->payments()->create([
	            'name' => $user->name,
	            'email' => $user->email,
	            'package_type' => $package->name,
	            'amount' => floatval($package->price)
	        ]);

	        // Buat transaksi ke midtrans kemudian save snap tokennya.
	        $payload = [
	            'transaction_details' => [
	                'order_id'      => $payment->id,
	                'gross_amount'  => $payment->amount,
	            ],
	            'customer_details' => [
	                'first_name'    => $payment->name,
	                'email'         => $payment->email,
	                // 'phone'         => '08888888888',
	                // 'address'       => '',
	            ],
	            'item_details' => [
	                [
	                    'id'       => $payment->package_type,
	                    'price'    => $payment->amount,
	                    'quantity' => 1,
	                    'name'     => ucwords($payment->package_type)
	                ]
	            ]
	        ];

	        $snapToken = Veritrans_Snap::getSnapToken($payload);
	        $payment->snap_token = $snapToken;
	        $payment->save();

	        // Beri response snap token
	        $this->response['snap_token'] = $snapToken;

    		DB::commit();
       
        	return $this->response;
    		
    	} catch (\Exception $e) {

    		DB::rollback();
    		
    		throw new \Exception($e->getMessage(), 1);
    	}
	}

	public function status($id)
	{
		$payment = Payment::find($id);

		if ($payment->package_type != 'trial') {

			$status = Veritrans_Transaction::status($id);

			// Jika status payment user tidak sama dengan midtrans
			// transaction status, maka update status payment user
			if ($payment->status != $status->transaction_status) {

				$payment->update(['status' => $status->transaction_status]);

				$this->updatePackage($payment);
			}

		} else {

			$status = null;

		}

		return $status;
	}

	/**
     * Midtrans notification handler.
     *
     * @param Request $request
     * 
     * @return void
     */
    public function notification()
    {
    	DB::beginTransaction();

    	try {

    		$notif = new Veritrans_Notification();

		    $transaction = $notif->transaction_status;
		    $type = $notif->payment_type;
		    $orderId = $notif->order_id;
		    $fraud = $notif->fraud_status;
		    $payment = Payment::findOrFail($orderId);

		    if ($transaction == 'capture') {

		        // For credit card transaction, we need to check whether transaction is challenge by FDS or not
		        if ($type == 'credit_card') {

		          if($fraud == 'challenge') {

		            $payment->setPending();

		          } else {

		            $payment->setSuccess();
		          }

		        }

		    } elseif ($transaction == 'settlement') {

		        $payment->setSuccess();
		        
		        // Update user paket dan roles
		        $this->updatePackage($payment);

		    } elseif($transaction == 'pending'){

		        $payment->setPending();

		    } elseif ($transaction == 'deny') {

		        $payment->setFailed();

		    } elseif ($transaction == 'expire') {

		        $payment->setExpired();

		    } elseif ($transaction == 'cancel') {

		        $payment->setFailed();

		    }

		    DB::commit();
    		
    	} catch (\Exception $e) {

    		DB::rollback();
    		
    		throw new \Exception($e->getMessage(), 1);
    	}

    }
    
    protected function updatePackage($payment)
    {
        $package = Package::whereName($payment->package_type)->first();

	    $payment->users->packages()->detach();
	    
	    $payment->users->packages()->attach($package->id, [
            'valid_until' => now()->addMonths((int) $package->lifetime), 
            'created_at' => now()
        ]);
        
        $payment->users->syncRoles(2,3);
    }
}