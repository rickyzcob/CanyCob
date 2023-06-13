<?php

namespace App\Services;
use DateTime;
class ReferenceService
{
    public function getReference()
    {
        $agora = new DateTime();
        $reference = $agora->format('YmdHi');

        return $reference;
    }

}
