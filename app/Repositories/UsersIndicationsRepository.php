<?php

namespace App\Repositories;

use App\Models\UsersIndicators;
use PHPUnit\Util\Exception;

class UsersIndicationsRepository
{
    public function show($id = null)
    {
        try {
            $userIndicationsDB = UsersIndicators::query()->with('owner', 'user')->where('owner_id', $id)->get()->toArray();

            return $userIndicationsDB;

        } catch (Exception $exception) {
            return $exception;
        }

    }

}
