<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateInventoryNotification extends Notification
{
    use Queueable;
    private $stock;
    /**
     * Create a new notification instance.
     */
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
            'icon' => $this->stock->tea ? 'coffee' : 'shopping-bag',
            'color' => 'success',
            'title' => $this->stock->tea ? 'TEA PURCHASE COMPLETED!' : 'MATERIAL PURCHASE COMPLETED!',
            'message' => 'The ' . ($this->stock->tea_purchase ? 'tea' : 'material') . ' purchase [' . ($this->stock->tea_purchase ? $this->stock->tea_purchase->tea_purchase_no  : $this->stock->material_purchase->material_purchase_no)  . '] has been successfully completed!',
            'route' => route('warehouse.inventory.show', $this->stock->id),
        ];
    }
}
