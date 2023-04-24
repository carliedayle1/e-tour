<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConfirmBooking extends Notification
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
                    ->line('You can now post a feedback with this travel package named '. $this->travel_package->title)
                    ->action('View travel package', url('/travel-packages/view/'.$this->travel_package->id))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'You can now post a feedback with this travel package named '. $this->travel_package->title,
            'url' => '/travel-packages/view/'.$this->travel_package->id,
        ];
    }
}
