<?php

namespace Modules\Accounts\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Accounts\Entities\Verification;


class VerificationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Verification
     */
    public Verification $verification;

    /**
     * Create a new event instance.
     *
     * @param Verification $verification
     */
    public function __construct(Verification $verification)
    {
        $this->verification = $verification;
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
