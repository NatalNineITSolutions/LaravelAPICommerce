<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\UpdateSubscriptionStatus;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
<<<<<<< HEAD
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command(UpdateSubscriptionStatus::class)->everyMinute();//->dailyAt('08:00');
        //once the application is deployed to its production environment, the cron job on the server will handle scheduling the execution of Laravel's scheduled tasks automatically.
    }
=======


>>>>>>> eb2d7e94040e6e41cf44186e0dd7947a716da34d

    /**
     * Register the commands for the application.
     *
     * @return void
     */

<<<<<<< HEAD
        require base_path('routes/console.php');
    }

    protected $commands = [
        Commands\UpdateSubscriptionStatus::class,
    ];
    
=======
>>>>>>> eb2d7e94040e6e41cf44186e0dd7947a716da34d
}
