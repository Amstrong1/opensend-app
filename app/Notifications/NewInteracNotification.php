<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewInteracNotification extends Notification
{
    use Queueable;
    public $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
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
            ->line('Nouvelle opération Interac')
            ->line('Détails')
            ->line('Type: ' . $this->data->type)
            ->line('Nom: ' . $this->data->name)
            ->line('Teléphone: ' . $this->data->tel)
            ->line('Email: ' . $this->data->email)
            ->line('Montant: ' . $this->data->amount)
            ->line('Banque: ' . $this->data->bank)
            ->line('Pays: ' . $this->data->country)
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
            'message' => 'Nouvelle opération Interac',
            'link' => $this->data->type == 'retrait' ? 'interac.retrait' : 'interac.depot',
        ];
    }
}
