<?php

namespace App\Console\Commands;

use App\Models\Payment;
use Illuminate\Console\Command;

class CancelExpiredPayments extends Command
{
    protected $signature = 'payments:cancel-expired';
    protected $description = 'Cancel expired pending payments';

    public function handle()
    {
        $expiredPayments = Payment::where('status', Payment::STATUS_PENDING_PAYMENT)
            ->whereNull('proof_of_payment')
            ->where('expires_at', '<', now())
            ->get();

        foreach ($expiredPayments as $payment) {
            $payment->update(['status' => Payment::STATUS_EXPIRED]);
        }

        $this->info(count($expiredPayments) . ' expired payments canceled.');
    }
}
