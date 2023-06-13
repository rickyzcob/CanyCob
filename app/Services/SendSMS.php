<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
class SendSMS
{
    public function send($request)
    {
        return Http::dd()->get('http://example.com');
    }

}
