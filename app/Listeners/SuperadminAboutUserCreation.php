<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\CreatedNotificationMail;
use App\Mail\CreatedNotificationMailForUser;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SuperadminAboutUserCreation
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $super_admins = User::whereRoleIs('superadmin')->get();
        foreach ($super_admins as $value) {
            Mail::to($value->email)->send(new CreatedNotificationMailForUser($event->data));
        }
    }
}
