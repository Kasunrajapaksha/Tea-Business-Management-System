<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateShippingScheduleNotification extends Notification
{
    use Queueable;
    private $order;
    /**
     * Create a new notification instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
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
            'icon' => 'package',
            'color' => 'info',
            'title' => 'SHIPPING SCHEDULE UPDATED!',
            'message' => 'The shipping schedule for order [' . $this->order->order_no . '] has been updated by ' . $this->order->shippingSchedule->user->first_name . ' ' . $this->order->shippingSchedule->user->last_name . '.',
            'route' => route('order.show', $this->order),
        ];
    }
}
