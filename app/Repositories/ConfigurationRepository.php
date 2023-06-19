<?php

namespace App\Repositories;

use App\Models\Configurations;

class ConfigurationRepository
{

    public function getConfiguration()
    {
        return Configurations::query()->first();
    }
}
