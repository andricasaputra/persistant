<?php  

namespace App\Repositories\Payments;

use DB;
use Veritrans_Snap;
use Veritrans_Config;
use App\Models\Package;
use App\Models\Payment;
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

	public function submit($request)
	{
		DB::beginTransaction();
    		
    	try {

    		$user = auth()->user();

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

	/**
     * Midtrans notification handler.
     *
     * @param Request $request
     * 
     * @return void
     */
    public function notification($request)
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
		            // TODO set payment status in merchant's database to 'Challenge by FDS'
		            // TODO merchant should decide whether this transaction is authorized or not in MAP
		            // $payment->addUpdate("Transaction order_id: " . $orderId ." is challenged by FDS");
		            $payment->setPending();
		          } else {
		            // TODO set payment status in merchant's database to 'Success'
		            // $payment->addUpdate("Transaction order_id: " . $orderId ." successfully captured using " . $type);
		            $payment->setSuccess();
		          }

		        }

		    } elseif ($transaction == 'settlement') {

		        // TODO set payment status in merchant's database to 'Settlement'
		        // $payment->addUpdate("Transaction order_id: " . $orderId ." successfully transfered using " . $type);
		        $payment->setSuccess();

		    } elseif($transaction == 'pending'){

		        // TODO set payment status in merchant's database to 'Pending'
		        // $payment->addUpdate("Waiting customer to finish transaction order_id: " . $orderId . " using " . $type);
		        $payment->setPending();

		    } elseif ($transaction == 'deny') {

		        // TODO set payment status in merchant's database to 'Failed'
		        // $payment->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is Failed.");
		        $payment->setFailed();

		    } elseif ($transaction == 'expire') {

		        // TODO set payment status in merchant's database to 'expire'
		        // $payment->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is expired.");
		        $payment->setExpired();

		    } elseif ($transaction == 'cancel') {

		        // TODO set payment status in merchant's database to 'Failed'
		        // $payment->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is canceled.");
		        $payment->setFailed();

		    }

		    DB::commit();
    		
    	} catch (\Exception $e) {

    		DB::rollback();
    		
    		throw new \Exception($e->getMessage(), 1);
    	}

    }
}