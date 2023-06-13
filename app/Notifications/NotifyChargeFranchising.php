<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyChargeFranchising extends Notification
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
                    ->subject('Proposta Odonto Incrível para você !' )
                    ->line('Olá ' .$this->proposal['partner']['name'].  '! Estamos com condições Imperdiveis para quitar seus debitos' )
                    ->action('Vizualizar Proposta', route('proposal.show', $this->proposal['id']))
                    ->line('Entre em contato agora para nao perder essa oportunidade')
        ->line('Entre em contato agora para nao perder essa oportunidade');
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
