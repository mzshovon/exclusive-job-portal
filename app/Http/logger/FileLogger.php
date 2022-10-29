<?php

namespace App\Http\Logger;

use Illuminate\Support\Facades\Log;

class FileLogger implements LoggerInterface
{
    /**
     * @param $event
     * @return void
     */
    public function log($event): void {
        $data = [
            'user_name' => $event->name,
            'user_email' => $event->email,
            'logged_in' => $event->logged_in,
            'status' => $event->status
        ];

        Log::channel('users')->info(json_encode($data));
    }
}
