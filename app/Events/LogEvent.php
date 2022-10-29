<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LogEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $name;
    public string $email;
    public string $logged_in;
    public string $status;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($name, $email, $logged_in, $status)
    {
        $this->name = $name;
        $this->email = $email;
        $this->logged_in = $logged_in;
        $this->status = $status;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
