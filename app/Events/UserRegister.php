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

class UserRegister
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public $package;

    public $message;

    public $request;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $package, $request)
    {
        $this->user = $user;

        $this->request = $request;

        $this->package = Package::whereId($package)->first();

        $this->message = "User $user->name baru saja melakukan registrasi dengan paket {$this->package->name}";
    }
}
