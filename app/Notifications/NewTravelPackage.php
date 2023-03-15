<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTravelPackage extends Notification
{
    use Queueable;

    private $travel_package;
    private $agency;

    /**
     * Create a new notification instance.
     */
    public function __construct($travel_package, $agency)
    {
        $this->travel_package = $travel_package;
        $this->agency = $agency;
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
        // create url to approve or cancel the travel package.

        return (new MailMessage)
                    ->line('A new travel package has been created by '. $this->agency->name . '.')
                    ->action('View Travel Package', url('/packages/'. $this->travel_package->id))
                    ->line('Please review the travel package. Thanks!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'A new travel package has been created by '. $this->agency->name . '.',
            'url' => '/packages/'.$this->travel_package->id,
        ];
    }
}
