<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\ResetPasswordCode;


class ResetPasswordCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var ResetPasswordCode
     */
    public ResetPasswordCode $resetPasswordCode;

    /**
     * Create a new event instance.
     *
     * @param ResetPasswordCode $resetPasswordCode
     */
    public function __construct(ResetPasswordCode $resetPasswordCode)
    {
        $this->resetPasswordCode = $resetPasswordCode;
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
