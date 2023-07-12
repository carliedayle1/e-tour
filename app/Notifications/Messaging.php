<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Messaging extends Notification
{
    use Queueable;

    private $user_from;
    private $user_to;

    /**
     * Create a new notification instance.
     */
    public function __construct($user_from, $user_to)
    {
        $this->user_from = $user_from;
        $this->user_to = $user_to;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Hello, ' . $this->user_to->name . '. You have received a new message from '. $this->user_from->name)
                    ->action('Notification Action', url('/messages'))
                    ->line('Check it now!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Hello, ' . $this->user_to->name . '. You have received a new message from '. $this->user_from->name,
            'url' => '/messages'
        ];
    }
}
