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

    public $class;
    public $id;
    public $password;

    /**
     * Create a new event instance.
     *
     * @param mixed $auth_model
     */
    public function __construct(string $class , string $id , string $password)
    {
        $this->class = $class;
        $this->id = $id;
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
