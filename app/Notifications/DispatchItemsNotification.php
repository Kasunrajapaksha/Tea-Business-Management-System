<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DispatchItemsNotification extends Notification
{
    use Queueable;
    private $transaction;

    public function __construct($transaction)
    {
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
            'icon' => 'home',
            'color' => 'success',
            'title' => 'ITEM RELEASED!',
            'message' => $this->transaction->tea_id ? $this->transaction->production_plan->order->orderItem->tea->tea_name .' '. $this->transaction->production_plan->order->orderItem->quantity.' Kg ] has been released for production.' :  $this->transaction->production_plan->order->productionMaterial->material->material_name . ' ' . $this->transaction->production_plan->order->productionMaterial->units. ' Units ] has been released for production.',
            'route' => route('production.plan.show', $this->transaction->production_plan->id),
        ];
    }
}
