<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateStockReceivedNotification extends Notification
{
    use Queueable;

    private $stock;

    public function __construct($stock)
    {
        $this->stock = $stock;
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
            'icon' => 'truck',
            'color' => 'success',
            'title' => $this->stock->tea ? $this->stock->tea->tea_name . 'received!' : $this->stock->material->material_name . ' RECEIVED!',
            'message' => 'The stock [' . ($this->stock->tea_purchase ? $this->stock->tea_purchase->tea_purchase_no  : $this->stock->material_purchase->material_purchase_no)  . '] has been collected by ' . $this->stock->user->first_name . ' ' . $this->stock->user->last_name . '.',
            'route' => route('warehouse.inventory.index'),
        ];
    }
}
