<?php

namespace App\Listeners;

use App\Events\UserJobFailedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserJobFailedListener
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
     * @param  UserJobFailedEvent  $event
     * @return void
     */
    public function handle(UserJobFailedEvent $event)
    {
        $command = json_decode($event->job->getRawBody())->data->command;

        $uploadClass = unserialize($command);
 
        \App\Models\UserFailedJobs::create([
            'user_id' => $uploadClass->user_id,
            'failed_job_id' => $event->failed_id,
            'datas' => json_encode($uploadClass->rows),
            'exception' => $event->exception->getMessage()//.', line: '.$event->exception->getLine(),
        ]);
    }
}
