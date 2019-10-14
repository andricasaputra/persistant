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
    	$this->request = $request;

    	$this->repository = app('Payments')->init($request->driver);
    }
 
    /**
     * Show index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $payments = Payment::latest()->paginate(8);
 
        return view('payments')->withpayments($payments);
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
    public function notificationHandler()
    {
    	$this->repository->notification($this->request);	
    }
}