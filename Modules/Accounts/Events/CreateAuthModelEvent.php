<?php

namespace Modules\Accounts\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class CreateAuthModelEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $auth_model;
    public $password;
    /**
     * Create a new event instance.
     *
     * @param mixed $auth_model
     */
    public function __construct($auth_model , $password)
    {
        $this->auth_model = $auth_model;
        $this->password = $password;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

}
