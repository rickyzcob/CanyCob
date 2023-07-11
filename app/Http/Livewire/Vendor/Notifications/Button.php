<?php

namespace App\Http\Livewire\Vendor\Notifications;

use App\Repositories\NotifyRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Button extends Component
{
    use WithPagination, Actions;

    public $count;
    public $visible;

    protected $listeners = [
        'refreshButtonNotifications' => '$refresh',
        'NotificationMarkedAsRead' => 'getCountNotifications',
        'echo:notifications,ProposalAccept' => '$refresh',
        ];

    public function getNotificationsByUser()
    {
        $notifications = Auth::user()->unreadNotifications()->get()->toArray();
        return $notifications;
    }
    public function getCountNotifications(): int
    {
        $this->count = Auth::user()->unreadNotifications()->count();
        return $this->count;
    }

    public function markAsRead($notificationID = null, $reference = null)
    {
        $notifyRepository = new NotifyRepository();
        $notifyReturnDB = $notifyRepository->markAsRead($notificationID);

        if($notifyReturnDB['status'] == 'success') {

            $this->emit('refreshButtonNotifications');
            $this->emitSelf('NotificationMarkedAsRead', Auth::user()->unreadNotifications()->count());
////            $url = route('formalized.show', $proposalID);
//            redirect()->route('login');
            return redirect()->route('charges.show', ['subdomain' => session('tenant')['subdomain'], 'reference' => $reference] );
        } else if ($notifyReturnDB['status'] == 'error') {
            $this->notification([
                'title'       => 'Erro ao marcar como lido !',
                'description' => $notifyReturnDB['message'],
                'icon'        => 'error'
            ]);
            $this->emit('closeModal');
        }
    }

    public function updateCount(int $count): int
    {
        return $count;
    }

    public function render(): View
    {
        $response = new \stdClass();
        $response->notifications = $this->getNotificationsByUser();
        $response->countNotifications = $this->getCountNotifications();

        return view('livewire.vendor.notifications.button', ['response' => $response]);
    }
}
