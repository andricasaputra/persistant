<?php

namespace App\Events;

use App\Models\Package;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserRegister implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public $package;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $package)
    {
        $this->user = $user;

        $this->package = Package::whereId($package)->first();

        $this->message = "User {$user->name} baru saja melakukan registrasi dengan paket {$this->package->name}";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
        return ['users'];
    }

    public function broadcastAs()
    {
         return 'user-register';
    }
}
