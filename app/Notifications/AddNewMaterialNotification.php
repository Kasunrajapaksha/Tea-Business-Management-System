<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddNewMaterialNotification extends Notification
{
    use Queueable;
    private $material;

    /**
     * Create a new notification instance.
     */
    public function __construct($material)
    {
        $this->material = $material;
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
            'icon' => 'shopping-bag',
            'color' => 'info',
            'title' => 'NEW MATERIAL!',
            'message' => 'A new material [' . $this->material->material_no . '] has been added by ' . $this->material->user->first_name . ' ' . $this->material->user->last_name . '.',
        ];
    }
}
