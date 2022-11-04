<?php

namespace App\Listeners;

use App\Events\LogEvent;
use App\Http\Logger\FileLogger;
use App\Http\Logger\LoggerInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(public FileLogger $logger)
    {
        // code here....
    }

    /**
     * Handle the event.
     *
     * @param LogEvent $event
     * @return void
     */
    public function handle(LogEvent $event)
    {
        $this->logger->log($event);
    }
}
