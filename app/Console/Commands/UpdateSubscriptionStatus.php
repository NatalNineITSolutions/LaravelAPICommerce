<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\SubscriptionEnded;

class UpdateSubscriptionStatus extends Command
{
    protected $signature = 'subscriptions:update-status';
    protected $description = 'Update subscription statuses';

    public function handle()
    {

        $expiredSubscriptions = Subscription::where('status', 1)
        ->where('end_date', '<', Carbon::now())
        ->get();
        foreach ($expiredSubscriptions as $subscription) {
            $subscription->status = 0;
            $subscription->save();

            $user = User::find($subscription->user_id);
            if ($user) {
                Mail::to($user->email)->send(new SubscriptionEnded($subscription));
            }
        }

        $this->info('Subscription statuses updated successfully');
    }
}

