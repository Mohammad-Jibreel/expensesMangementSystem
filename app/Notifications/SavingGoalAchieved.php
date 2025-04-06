<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SavingGoalAchieved extends Notification
{
    use Queueable;

    public $message;

    /**
     * Create a new notification instance.
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database'];  // You can choose other channels like 'mail', 'database', etc.
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
        ];
    }
}
