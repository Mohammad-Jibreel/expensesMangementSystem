<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomGoalNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database'];  // Store notification in the database
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->message
        ];
    }

}
