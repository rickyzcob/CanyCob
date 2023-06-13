<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

class SendWhatsappService
{
    public function sendMessage($data = null, $proposal = null)
    {
        $numberWhatsapp = str_replace( ['(', ')', '-'], '', $data['phone']);

        try {
            $client = new Client();

            $headers = [
                'Content-Type'=>'application/json',
                "Accept" => "application/json",
                'Authorization'=>'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL3BsYXRhZm9ybWEuYXBpYnJhc2lsLmNvbS5ici9hdXRoL2xvZ2luIiwiaWF0IjoxNjg0MTgzOTcyLCJleHAiOjE3MTU3MTk5NzIsIm5iZiI6MTY4NDE4Mzk3MiwianRpIjoiQk9XdzVQVXFTaGhrY1p5dCIsInN1YiI6IjI4NzkiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.UJYkQ3-xQWa7pmX6ztRa3sh6P6UUNuA0YR1Wit19Zn8',
                'SecretKey'=>'e3b0e4b8-7670-47b6-8543-47f869ccc90e',
                'PublicToken'=>'1baaeb27-5c45-4d5e-a491-5eb929e22c4e',
                'DeviceToken'=>'29c66e4e-9fd0-4b66-8a25-ba9df32d512d',
            ];

            $body = [
                  "number" => '55'.$numberWhatsapp,
                  "text" => "Olá " .$data['name']." ! \n\nPreparamos uma oferta incrível para você ! \n\nclique no link abaixo e confira a sua oportuidade \n\n" .route('proposal.show', $proposal['id']),
                  "title" =>"Botões",
                  "footer" =>"Aqui vai o texto do rodapé da mensagem",
                  "buttons" => [
                        [
                            "id" => "resposta01",
                            "text" => "Voce Gostou 👍🏼"
                        ],
                        [
                            "id" => "resposta02",
                            "text" => "Nao Gostei 👎🏼"
                        ]
                    ]
                  ];

            $request = new Request('POST', 'https://cluster.apigratis.com/api/v1/whatsapp/sendText', $headers, json_encode($body)); // create request
            $response = $client->send($request); // send request

            if(isset(explode("?", 'sendText')[0]) and explode("?", 'sendText')[0] === 'qrcode'){
                return $response->getBody()->getContents();
            }

            return json_decode($response->getBody()->getContents()); // return response object

        } catch (ClientException $e) {

            // return exception error
            $response = $e->getResponse();
            return json_decode((string)($response->getBody()->getContents()));

        }

    }

}
