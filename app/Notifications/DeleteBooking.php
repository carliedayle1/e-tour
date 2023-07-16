<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeleteBooking extends Notification
{
    use Queueable;

    private $travel_package;
    private $timeslot;
    private $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($travel_package, $timeslot, $user)
    {
        $this->travel_package = $travel_package;
        $this->timeslot = $timeslot;
        $this->user = $user;
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
                    ->line('Hello '. $this->user->name . '. Your booking on .'. $this->timeslot->date . ' for '. $this->travel_package->title . ' has been canceled or deleted by the agency. You can book again for other schedule. Sorry for the inconvenience.')
                    ->action('Notification Action', url('/dashboard'))
                    ->line('Thank you and have a great day ahead!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Hello '. $this->user->name . '. Your booking on .'. $this->timeslot->date . ' for '. $this->travel_package->title . ' has been canceled or deleted by the agency. You can book again for other schedule. Sorry for the inconvenience.',
            'url' => '/dashboard'
        ];
    }
}
