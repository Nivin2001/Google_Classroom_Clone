<?php
namespace App\Notifications\channels;

use App\Services\HadaraSms;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

 class HadraSmsChannel
 {
    public function send( object $notifiable,Notification $notification):void
    {
        $service=new HadaraSms(config('services.hadara.key'));
        $service->send(
            $notifiable->routeNotificationForHadara($notification),
            $notification->toHadara($notifiable),
        );

    }

 }

