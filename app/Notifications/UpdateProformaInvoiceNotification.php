<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateProformaInvoiceNotification extends Notification
{
    use Queueable;
    private $order;
    private $invoice;
    /**
     * Create a new notification instance.
     */
    public function __construct($order, $invoice)
    {
        $this->order = $order;
        $this->invoice = $invoice;
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
            'title' => 'PROFORMA INVOICE SENT!',
            'message' => 'The proforma invoice for order [' . $this->order->order_no . '] has been sent by ' . $this->invoice->user->first_name . ' ' . $this->invoice->user->last_name . '.',
            'route' => route('order.show', $this->order),
        ];
    }
}
