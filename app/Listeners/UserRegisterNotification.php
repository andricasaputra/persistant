<?php

namespace App\Listeners;

use App\Events\UserRegister;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\UserRegister as Notification;

class UserRegisterNotification
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
     * @param  UserRegister  $event
     * @return void
     */
    public function handle(UserRegister $event)
    {
        $event->user->packages()->attach($event->package->id, [
            'valid_until' => now()->addMonths((int) $event->package->lifetime), 
            'created_at' => now()
        ]);

        $role = $this->setRole($event->package->name);

        $event->user->assignRole([$role, 'user']);

        // $event->user->notify(new Notification($event->user, $role, $package));
    }

    protected function setRole($package)
    {
        switch ($package) {
            case 'tahunan':
                $role = 'subscriber';
                break;
            case 'bulanan':
                $role = 'subscriber';
                break;
            default:
               $role = 'trial';
                break;
        }

        return $role;
    }
}
