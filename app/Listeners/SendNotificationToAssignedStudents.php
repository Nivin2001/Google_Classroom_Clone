<?php

namespace App\Listeners;

use App\Events\ClassworkCreated;
use App\Models\User;
use App\Notifications\NewClassworkNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNotificationToAssignedStudents
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
        // كيف بدي اعرف اليوزر اذا notfiable
        // اذا كان عامل use fot trait

        // هيك ببعت notificarion for user 1
        // and store in notifcation table
        // وراح حتوصلع ع مستوى  broadcast channel this message

        // $user=User::find(1);
        // $user->notify(new NewClassworkNotification($event->classwork) );

        // // لو بدي ابعت اشعارات لكل assigned user in classwork

        // // first way
        // foreach($event->classwork->users as $user){
        //     $user->notify(new NewClassworkNotification($event->classwork));
        // }

        //second way

        Notification::send($event->classwork->users ,new NewClassworkNotification($event->classwork));
    }

}
