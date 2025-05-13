<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdatePriceListNotification extends Notification
{
    use Queueable;
    private $tea;

    /**
     * Create a new notification instance.
     */
    public function __construct($tea)
    {
        $this->tea = $tea;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
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
            'icon' => 'coffee',
            'color' => 'warning',
            'title' => 'PRICE LIST UPDATED!',
            'message' => 'The price for [' . $this->tea->tea_name . '] has been updated by ' . $this->tea->user->first_name . ' ' . $this->tea->user->last_name . '.',
        ];
    }
}
