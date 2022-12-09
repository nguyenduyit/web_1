<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentConfirmNotification extends Notification
{
    use Queueable;
    public $student,$id_post,$status;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($student,$id_post)
    {
        //
        $this->student=$student;
        $this->id_post=$id_post;
        $this->status=true;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
            'id' => $this->student['id'],
            'name' => $this->student['name'],
            'id_post' => $this->id_post,
            'status' => $this->status,
        ];
    }
}
