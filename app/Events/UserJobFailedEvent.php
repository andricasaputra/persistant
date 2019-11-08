<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserJobFailedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $job, $exception, $failed_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($event, $failed_id)
    {
        $this->failed_id = $failed_id;

        $this->job = $event->job;

        $this->exception = $event->exception;
    }
}
