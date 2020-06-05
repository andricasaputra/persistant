<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
class PaymentController extends Controller
{
	protected $request;

	protected $repository;

    /**
     * Class constructor.
     *
     * @param \Illuminate\Http\Request $request User Request
     *
     * @return void
     */
    public function __construct(Request $request)
    {
    	$this->middleware('expired')->only('submitPayment');

    	$this->request = $request;
    	
    	$driver = $request->has('driver') 
                  ? $request->driver 
                  : config('e-persistant.payments_gateway.default'); 

    	$this->repository = app('Payments')->init($driver);
    }
 
    /**
     * Show index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $payments = Payment::latest()->paginate(8);
 
        return view('payments')->withPayments($payments);
    }
 
    /**
     * Submit payment.
     *
     * @return array
     */
    public function submitPayment()
    {
		$response = $this->repository->submit($this->request);	

		return response()->json($response);
    }

    /**
     * Midtrans notification handler.
     *
     * @param Request $request
     * 
     * @return void
     */
    public function status($id)
    { 
        $status = $this->repository->status($id);

        if (! $status) {
            return back()->withWarning('Mohon lakukan transaksi pembayaran terlebih dahulu sebelum memeriksa status pembayaran');
        }

        if (trial() && is_null($status)) {

            return view('package.trial_status');

        } else {

            return view('package.payment_status')->withStatus($status);
        }

        return back()->withWarning('Kami tidak dapat menemukan status order anda');
    }
 
    /**
     * Midtrans notification handler.
     *
     * @param Request $request
     * 
     * @return void
     */
    public function notificationHandler()
    {
    	$this->repository->notification();	
    }
}