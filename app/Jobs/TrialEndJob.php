<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TrialEndJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users=User::has('subscriptions')->get();

        // Send Emails
        foreach($users as $user){
            $controller = new Controller;
            if ($user->onTrial() && $user->trial_ends_at->isPast()) {
                // Send Push Notification
                $controller->fcm(
                    $controller->getUserDevices($user->id),
                    'Attention!',
                    'Your trial plan has ended. Please upgrade to a paid plan to continue using our services.'
                );
            }
            
        }
        
    }
}
