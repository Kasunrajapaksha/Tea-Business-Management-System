<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AlertLowTeaStockNotification extends Notification
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
            'icon' => 'alert-circle',
            'color' => 'danger',
            'title' => 'TEA STOCK RUNNING LOW!',
            'message' => $this->tea->tea_name . ' stock is running low. Remaining stock: ['. number_format($this->tea->stock_level,1) .' kg].',
            'route' => route('tea.teaType.show', $this->tea),
        ];
    }
}
