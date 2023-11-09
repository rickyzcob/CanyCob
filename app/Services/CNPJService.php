<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;

class CNPJService
{
    public function consultCNPJ($cnpj = null)
    {
        $cnpj = str_replace(['.', '-', '/'],'', $cnpj);

        try {
            $client = new Client();

            $request = new Request('GET', 'https://api-publica.speedio.com.br/buscarcnpj?cnpj='.$cnpj);
            $response = $client->sendAsync($request)->wait();

//            dd($response->getBody()->getContents());

//            dd(json_decode($response->getBody()->getContents()));

            return json_decode($response->getBody()->getContents(), true); // return response object

        } catch (ClientException $e) {

            // return exception error
            $response = $e->getResponse();
            return json_decode((string)($response->getBody()->getContents()));

        }

    }

}
