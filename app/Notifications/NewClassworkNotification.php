<?php

namespace App\Notifications;
use Illuminate\Notifications\Messages\VonageMessage;
use App\Models\Classwork;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class NewClassworkNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Classwork $classwork)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // channel to senf notification
        //mail,Database ,broadcast(notification in realtime )
        // vonage(sms),slack

        $via=
        ['broadcast',
        'database',
        'mail',
        // 'vonage'
        // 'HadraSmsChannel::class'

    ];
        // if($notifiable->receieve_email_notifications){
        //     $via[]='mail';
        // }
        // if($notifiable->receieve_push_notifications){
        //     $via[]='broadcast';
        // }

        return  $via;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $classwork=$this->classwork;

        $content=__(':name posted a new type:title',[
            'name'=>$classwork->user->name,
            'type'=>__($classwork->type),
            'title'=>$classwork->title

        ]);
        return (new MailMessage)
                     ->subject(__('New:type',[
                        'type' =>$this->classwork->type,
                     ]
                     ))
                     ->greeting(__('Hi:name',[
                        'name' =>$notifiable->name
                     ]))
                    ->line($content)
                    ->action('Go to Classwork', route('classrooms.classworks.show',[$classwork->classroom_id,$classwork->id]))
                    ->line('Thank you for using our application!');
    }

    public function ToDatabase(object $notifiable):DatabaseMessage
    {


     return new DatabaseMessage($this->createMessage($_COOKIE));
    }

public function ToBroadcast(object $notifiable):BroadcastMessage
{
    // مش شرط يكون يوزر ممكن يكون اي مودل


 return new BroadcastMessage($this->createMessage());

}

protected function createMessage():array
{
    $classwork=$this->classwork;

    $content=__(':name posted a new type:title',[
        'name'=>$classwork->user->name,
        'type'=>__($classwork->type),
        'title'=>$classwork->title

    ]);
    return [
        'title' => __('Add New:type',[
            'type' =>$this->classwork->type,
        ]),
        'body' =>$content,
        'image' =>'',
        'link' => route('classrooms.classworks.show',[$classwork->classroom->id,$classwork->id]),
        'classwork_id' => $classwork->id,
    ];

}

public function toVonage(object $notifiable): VonageMessage
{
    //SMS Notification
    return (new VonageMessage)
    ->content(__('A new classwork created!'));
}
public function toHadra(object $notifiable): string
{
    //SMS Notification
    return (__('A new classwork created!'));
}





    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
 }
}
