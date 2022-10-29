<?php

namespace App\Http\Logger;

use App\Events\LogEvent;

interface LoggerInterface
{
    public function log(LogEvent $event): void;
}
