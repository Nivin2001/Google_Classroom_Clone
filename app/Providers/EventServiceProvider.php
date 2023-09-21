<?php

namespace App\Providers;

use App\Events\ClassworkCreated;
use App\Listeners\PostInClassroomStream;
use App\Listeners\SendNotificationToAssignedStudents;
use App\Models\Classroom;
use App\Observers\ClassroomObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ClassworkCreated::class =>[
        PostInClassroomStream::class,
        SendNotificationToAssignedStudents::class,
        ],

    ];
    // protected $obsrver=[
    //     Classroom::class=>[ClassroomObserver::class],
    // ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    //   Classroom::observe(ClassroomObserver::class);
    // Event::listen('classworks.created', [new PostInClassroomStream,'handle']);
    //     dd('EventTriggered');


}

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
