<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifiedTravelPackage extends Notification
{
    use Queueable;

    private $travel_package;
    /**
     * Create a new notification instance.
     */
    public function __construct($travel_package)
    {
        $this->travel_package = $travel_package;
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
                    ->line('Your travel package '. $this->travel_package->title . ' has been'. ($this->travel_package->status ? ' activated ':'') . ($this->travel_package->featured ? 'and featured ':'') .'by the admin.')
                    ->action('Notification Action', url('/packages/'.$this->travel_package->id ))
                    ->line('Check it out now!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Your travel package '. $this->travel_package->title . ' has been'. ($this->travel_package->status ? ' activated ':'') . ($this->travel_package->featured ? 'and featured ':'') .'by the admin.',
            'url' => '/packages/'.$this->travel_package->id
        ];
    }
}
