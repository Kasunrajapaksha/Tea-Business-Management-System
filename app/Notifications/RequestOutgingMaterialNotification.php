<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestOutgingMaterialNotification extends Notification
{
    use Queueable;
    private $order;
    private $transaction;
    public function __construct($order, $transaction)
    {
        $this->order = $order;
        $this->transaction = $transaction;
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
            'icon' => 'alert-circle',
            'color' => 'danger',
            'title' => 'REQUEAST MATERIAL!',
            'message' => 'A request for production items has been made for order [' . $this->order->order_no . '].',
            'route' => route('warehouse.inventory.show.outgoing',$this->transaction)
        ];
    }
}
