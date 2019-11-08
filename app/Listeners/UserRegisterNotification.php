<?php

namespace App\Listeners;

use App\Events\UserRegister;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\UserRegister as Notification;

class UserRegisterNotification
{
    protected $paymentRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->paymentRepository = app('Payments')->init(config('e-persistant.payments_gateway.default'));
    }

    /**
     * Handle the event.
     *
     * @param  UserRegister  $event
     * @return void
     */
    public function handle(UserRegister $event)
    {
        // Add user package
        $event->user->packages()->attach($event->package->id, [
            'valid_until' => now()->addMonths((int) $event->package->lifetime), 
            'created_at' => now()
        ]);

        // Set the user payments if 
        // the user register as non trial user
        if ($event->package->name == 'trial') {
            
            $event->user->payments()->create([
                'name' => $event->user->name,
                'email' => $event->user->email,
                'package_type' => $event->package->name,
                'amount' => $event->package->price,
                'status' => 'settlement',
                'created_at' => now()
            ]);

        } else {
            $this->paymentRepository->submit($event->request, $event->user);
        }
     
        // Set user upload setting (sync/ascyn)
        $event->user->setting()->create([
            'uplaod_setting' => 'sync'
        ]);

        // Set user roles
        $role = $this->setRole($event->package->name);

        // Then assign the roles
        $event->user->assignRole([$role, 'user']);

        // Notify admin that we have new user
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
