<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscription;
use Carbon\Carbon;

class UpdateSubscriptionStatus extends Command
{
    protected $signature = 'subscriptions:update-status';
    protected $description = 'Update subscription statuses';

    public function handle()
    {
        $expiredSubscriptions = Subscription::where('end_date', '<', Carbon::now())->get();

        foreach ($expiredSubscriptions as $subscription) {
            $subscription->status = 0;
            $subscription->save();
        }

        $this->info('Subscription statuses updated successfully');
    }
}

