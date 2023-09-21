<?php

namespace App\Listeners;

use App\Events\ClassworkCreated;
use App\Models\stream;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class PostInClassroomStream
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */

    public function handle(ClassworkCreated $event): void
    {
        //
        $classwork=$event->classwork;
        $content =
        __($classwork->user->name .
         ' posted a new ' .
         $classwork->type .
         ': ' . $classwork->title);




        stream::create([
            'id' =>Str::uuid(),
            'classroom_id'=>$classwork->classroom_id,
            'user_id' => $event->classwork->user_id,
            'content' => $content,
            'link' =>route('classrooms.classworks.show',[
                $classwork->classroom_id,
                $classwork->id,

            ]),

        ]);

    }
}
