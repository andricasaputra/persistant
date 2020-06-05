<?php  

namespace App\Repositories;

use App\Models\Payments;

trait hasPayments
{
    public function hasSettlementPayments()
    {
        return $this->user()
        			->payments()
        			->whereStatus('settlement')
        			->orderBy('id', 'desc')
        			->first();
    }

    public function hasPendingPayments()
    {
        return $this->user()
        			->payments()
        			->whereStatus('pending')
        			->get();
    }

    public function paymentStatus($user)
    {
        return $user->payments()->get();
    }
}