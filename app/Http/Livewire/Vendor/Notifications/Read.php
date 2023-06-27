<?php

namespace App\Http\Livewire\Vendor\Notifications;

use App\Http\Traits\WithModal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
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
        return view('livewire.vendor.notifications.read');
    }
}
