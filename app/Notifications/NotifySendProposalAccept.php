<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifySendProposalAccept extends Notification
{
    use Queueable;

    private $proposal;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($proposal)
    {
        $this->proposal = $proposal;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Proposta de Aceite !' )
            ->line('Olá ' .$this->proposal['partner']['name'].  '! Segue formalização da proposta, clique no link abaixo para vizualizar.' )
            ->action('Vizualizar Termo', route('formalized.show', ['subdomain' => session('tenant')['subdomain'], 'reference' => $this->proposal['reference']]))
            ->line('Ao abrir a proposta clique em aceitar e em seguida digite seu CPF para validar.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
