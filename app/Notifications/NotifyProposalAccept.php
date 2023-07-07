<?php

namespace App\Notifications;

use App\Models\Charges;
use App\Models\ProposalAccept;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyProposalAccept extends Notification
{
    use Queueable;

    private $proposal;

    private $charge_id;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($charge_id)
    {
        $this->proposal = Charges::query()->with([ 'attendant', 'franchising', 'proposalAccept.partner'])->findOrFail($charge_id);

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->subject('Notificação de Aceite')
                    ->line('Olá ' .$this->proposal['attendant']['name'].  '! Tem Proposta Aceita por um Franqueado !' )
                    ->action('Vizualizar', route('formalized.show', ['subdomain' => session('tenant')['subdomain'], 'reference' => $this->proposal['reference']]))
                    ->line('Agora Você pode gerar o acordo e condições de pagamento para essa unidade');
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

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'proposal' => $this->proposal,
        ];
    }
}
