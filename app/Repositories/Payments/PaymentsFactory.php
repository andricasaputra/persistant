<?php 

namespace App\Repositories\Payments;

class PaymentsFactory
{
	public function init($driver)
	{
		if ($driver == 'midtrans') {
			return new VeritransRepository;
		} else {
			//NEXT TODO
			return 'simple payment class';
		}

		throw new \Exception("Theres no payments driver supported", 1);
	}
}