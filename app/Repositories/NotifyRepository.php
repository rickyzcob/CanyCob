<?php

namespace App\Repositories;

use PHPUnit\Util\Exception;

class NotifyRepository
{
    public function markAsRead($notificationId)
    {
        try {
            $notification = auth()->user()->notifications()->where('id', $notificationId)->first();
//            dd($notification);
//            $this->notificationId = $notificationId;
//
//            $this->authorize(NotificationPo::MARK_AS_READ, $this->notification);

            $notification->markAsRead();

//            $this->emit('NotificationMarkedAsRead', Auth::user()->unreadNotifications()->count());

            return [
                'status' => 'success',
                'data' => $notification,
                'code' => 202
            ];

        }catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro na requisição'
            ];

        }

    }

}
