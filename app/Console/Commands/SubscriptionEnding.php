<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use App\Models\Subscription;
use App\Models\user;
use Carbon\Carbon;
use App\Mail\SubscriptionReminder;
use Illuminate\Support\Facades\Log; // Import the Log facade


class SubscriptionEnding extends Command
{

    protected $signature = 'subscriptions:subscription-Reminder';
    protected $description = 'Subscription reminder message';

    public function handle()
    {
        $expiredSubscriptions = Subscription::where('status', 1)
        ->whereDate('end_date', '=', Carbon::now()->addDays(5)->toDateString())
        ->get();
        Log::info('the date is: ' . $expiredSubscriptions);

        foreach ($expiredSubscriptions as $subscription) {
            $user = User::find($subscription->user_id);
            if ($user) {
                Mail::to($user->email)->send(new SubscriptionReminder($subscription));
            }
        }

        $this->info('Subscription statuses updated successfully');
    }
}

