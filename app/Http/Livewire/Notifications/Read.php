<?php

namespace App\Http\Livewire\Notifications;

use App\Http\Traits\WithModal;
use App\Repositories\NotifyRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Tests\CreatesApplication;
use WireUi\Traits\Actions;

class Read extends Component
{
    protected $listeners = [
        'updateCount'
    ];

    use Actions, WithModal;

    public function updateCount($notificationID = null, $proposalID = null)
    {
        $this->emit('NotificationMarkedAsRead', Auth::user()->unreadNotifications()->count());
    }

    public function render()
    {
        return view('livewire.notifications.read');
    }
}
