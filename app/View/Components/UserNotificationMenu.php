<?php

namespace App\View\Components;

use Closure;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;


class UserNotificationMenu extends Component
{
    public $notifications;
    public $unreadCount;
    /**
     * Create a new component instance.
     */
    public function __construct($count = 10)
    {
        $user  = Auth::user() ;
        // the realtion between user and notification is morgh many
        $this->notifications = $user->notifications()
            ->take($count)// بعرضلي احدث 10
            ->get();// للتنفيذ
             //limit(5)

// بجيب الاشعارات غير المقروءى
        $this->unreadCount = $user->unreadNotifications()->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-notification-menu');
    }
}

