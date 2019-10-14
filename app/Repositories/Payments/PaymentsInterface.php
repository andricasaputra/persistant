<?php 

namespace App\Repositories\Payments;

interface PaymentsInterface
{
	public function submit($request);
}