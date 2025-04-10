<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
class SavingReminder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($goalName)
    {
        $this->goalName = $goalName;

        // Generate a random dynamic message
        $messages = [
            "Great job! You’re doing well with your savings goal: {$this->goalName}. Keep it up!",
            "Reminder: You still have a long way to go for the goal: {$this->goalName}. Don’t give up!",
            "Keep pushing towards your goal: {$this->goalName}! You can do it!",
            "Did you save today for your goal: {$this->goalName}? Every bit counts!",
            "Tip: Try to save a little more this month for your goal: {$this->goalName}. It’ll make a difference!"
        ];

        // Choose a random message
        $this->message = $messages[array_rand($messages)];
    }

    public $goalName;



    // Specify how the notification will be sent (e.g., via mail or database)
    public function via($notifiable)
    {
        return ['database', 'mail']; // You can add other channels like 'sms' or 'broadcast'
    }

    // For mail notifications
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Reminder: Time to Save!')
                    ->line($this->message)
                    ->action('Go to Your Savings', url('/savings'))
                    ->line('Stay on track to achieve your financial goals!');
    }

    // For database notifications (storing notifications in the database)
    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
        ];
    }
}
