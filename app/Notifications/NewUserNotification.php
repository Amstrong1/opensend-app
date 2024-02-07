<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class NewUserNotification extends Notification
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
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line(Lang::get('message.newInsc'))
            ->line('Informations de l\'tilisateur')
            ->line(Lang::get('message.name') . ' : ' . $this->user->name)
            ->line('Email :  ' . $this->user->email)
            ->line('Tel :  ' . $this->user->tel)
            ->line(Lang::get('message.country') . ' : ' . $this->user->country)
            ->line(Lang::get('message.city') . ' : ' . $this->user->city)
            ->line(Lang::get('message.address') . ' : ' . $this->user->adress)
            ->line(Lang::get('message.line3') . getFormattedDateHour($this->user->created_at));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Nouvel utilisateur enregistré',
            '   ' => 'user.index'            
        ];
    }
}
