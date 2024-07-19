<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewLike implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public  $postId;
    public $countLike;


    /**
     * Create a new event instance.
     */
    public function __construct($postId, $countLike)
    {
        //
        $this->postId = $postId;
        $this->countLike = $countLike;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('post.' .$this->postId),
        ];
    }
}
