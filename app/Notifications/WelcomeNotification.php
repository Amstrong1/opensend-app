<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class WelcomeNotification extends Notification
{
    use Queueable;

    public $user;
    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line(Lang::get('message.line1') . $this->user->name . ',')
            ->line(Lang::get('message.line2'))
            ->line(Lang::get('message.line3') . getFormattedDateHour($this->user->last_login))
            ->line(Lang::get('message.line4') . request()->ip())
            ->line(Lang::get('message.line5'))
            ->line(Lang::get('message.line6'))
            ->line(Lang::get('message.line7'))
            ->line(Lang::get('message.line8'))
            ->line(Lang::get('message.line9'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [];
    }
}
