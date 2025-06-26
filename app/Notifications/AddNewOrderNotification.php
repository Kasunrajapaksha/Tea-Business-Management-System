<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddNewOrderNotification extends Notification
{
    use Queueable;
    private $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'icon' => 'package',
            'color' => 'danger',
            'title' => 'NEW ORDER!',
            'message' => 'A new order [' . $this->order->order_no . '] has been created by ' . $this->order->user->first_name . ' ' . $this->order->user->last_name . '.',
            'route' => route('order.show', $this->order),
        ];
    }
}
