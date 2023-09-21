<?php

namespace App\Events;

use App\Models\Classwork;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClassworkCreated 
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Classwork $classwork)
    {
        //

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */


     public function broadcastOn(): array
     {
         // Broadcast to a private channel specific to the classroom
         //classroom .1
         return [
             new PrivateChannel('classroom.', $this->classwork->classroom_id),
         ];
     }

     public function broadcastAs()
     {
         // Use a custom event name
         return 'classwork-created';
     }

     public function broadcastWith()
     {
         // Include additional data in the broadcast
         return [
             'id' => $this->classwork->id,
             'title' => $this->classwork->title,
             'user' => $this->classwork->user,
             'classroom'=> $this->classwork->classroom
         ];
     }
 }
