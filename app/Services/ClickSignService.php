<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;

class ClickSignService
{
    public function generateDocument($agreementDB = null)
    {
        try {
            $client = new Client();

            $host = 'https://sandbox.clicksign.com';

            $headers = [
                'Content-Type'=>'application/json',
                "Accept" => "application/json",
                'Host'=> 'sandbox.clicksign.com'

            ];

            $body = [
                "document" => [
                    "path" => "/Modelos/Teste-1245.docx",
                    "template" => [
                        "data" => [
                            "Valor" => formatMoney($agreementDB['agreements_amount']),
                            "Company Name" => "Clicksign Gestão de Documentos S.A.",
                            "Address" => "R. Teodoro Sampaio 2767, 10° andar",
                            "Phone" => "(11) 3145-2570",
                            "Website" => "https://www.clicksign.com"
                        ]
                    ]
                ]
            ];

            $request = new Request('POST', $host.'/api/v1/templates/357ba3ad-cd2c-4f0a-bea3-9669e4656b3f/documents?access_token=8dabd09a-0ccc-452a-b48f-b9b6d6c2e70d', $headers, json_encode($body)); // create request
            $response = $client->send($request);

            return json_decode($response->getBody()->getContents()); // return response object

        } catch (ClientException $e) {

            // return exception error
            $response = $e->getResponse();
            return json_decode((string)($response->getBody()->getContents()));

        }
    }

    public function addSignatory($partner = null)
    {
        $phone = str_replace( ['(', ')', '-'], '', $partner['phone']);


        try {
            $client = new Client();
            $host = 'https://sandbox.clicksign.com';

            $headers = [
                'Content-Type'=>'application/json',
                "Accept" => "application/json",
                'Host'=> 'sandbox.clicksign.com'

            ];

            $body = [
                "signer" => [
                    "email" => $partner['email'],
                    "phone_number" => $phone,
                    "auths" => [
                        "email"
                    ],
                    "name" => $partner['name'],
                    "documentation" => formatCPFCNPJ($partner['cpf']),
                    "birthday" => "1983-03-31",
                    "has_documentation" => true,
                    "selfie_enabled" => false,
                    "handwritten_enabled" => false,
                    "official_document_enabled" => false,
                    "liveness_enabled" => false,
                    "facial_biometrics_enabled" => false
                ]
            ];

            $request = new Request('POST', $host.'/api/v1/signers?access_token=8dabd09a-0ccc-452a-b48f-b9b6d6c2e70d', $headers, json_encode($body)); // create request
            $response = $client->send($request);

            return json_decode($response->getBody()->getContents()); // return response object

        } catch (ClientException $e) {
            // return exception error
            $response = $e->getResponse();
            return json_decode((string)($response->getBody()->getContents()));

        }

    }

    public function addSignatoryByDocument($document_key = null, $signer_key = null, $name = null)
    {

        try {
            $client = new Client();
            $host = 'https://sandbox.clicksign.com';

            $headers = [
                'Content-Type'=>'application/json',
                "Accept" => "application/json",
                'Host'=> 'sandbox.clicksign.com'
            ];

            $body = [
                "list" => [
                    "document_key" => $document_key,
                    "signer_key" => $signer_key,
                    "sign_as" => "sign",
//                    "group" => 1,
                    "refusable" => true,
                    "message" => "Prezado ".$name." !,\nPor favor assine o documento.\n\nQualquer dúvida estou à disposição.\n\nAtenciosamente,\nMy Company"
                ]
            ];

            $request = new Request('POST', $host.'/api/v1/lists?access_token=8dabd09a-0ccc-452a-b48f-b9b6d6c2e70d', $headers, json_encode($body)); // create request
            $response = $client->send($request);

            return json_decode($response->getBody()->getContents()); // return response object

        } catch (ClientException $e) {
dd($e);
            $response = $e->getResponse();
            return json_decode((string)($response->getBody()->getContents()));

        }
    }

    public function sentDocumentByMail($request_signature_key = null, $name = null)
    {

        try {
            $client = new Client();
            $host = 'https://sandbox.clicksign.com';

            $headers = [
                'Content-Type'=>'application/json',
                "Accept" => "application/json",
                'Host'=> 'sandbox.clicksign.com'
            ];

            $body = [
                "request_signature_key" => $request_signature_key,
                "message" => "Prezado" .$name.", \nPor favor assine o documento.\n\nQualquer dúvida estou à disposição.\n\nAtenciosamente,\n minha Equipe",
                "url" => "https://www.example.com/abc"
            ];

            $request = new Request('POST', $host.'/api/v1/notifications?access_token=8dabd09a-0ccc-452a-b48f-b9b6d6c2e70d', $headers, json_encode($body)); // create request
            $response = $client->send($request);
            return json_decode($response->getBody()->getContents()); // return response object

        } catch (ClientException $e) {

            $response = $e->getResponse();
            return json_decode((string)($response->getBody()->getContents()));

        }
    }

    public function listSigners($document_key = null, $signer_key = null, $name = null)
    {
//        dd($document_key, $signer_key, $name);
        try {
            $client = new Client();
            $host = 'https://sandbox.clicksign.com';

            $headers = [
                'Content-Type'=>'application/json',
                "Accept" => "application/json",
                'Host'=> 'sandbox.clicksign.com'
            ];

            $body = [
                "list" => [
                    "document_key" => $document_key,
                    "signer_key" => $signer_key,
                    "sign_as" => "sign",
                    "refusable" => true,
                    "group" => 1,
                    "message" => "Prezado ".$name." !,\nPor favor assine o documento.\n\nQualquer dúvida estou à disposição.\n\nAtenciosamente,\nMy Company"
                ]
            ];

            $request = new Request('POST', $host.'/api/v1/lists?access_token=8dabd09a-0ccc-452a-b48f-b9b6d6c2e70d', $headers, json_encode($body)); // create request
            $response = $client->send($request);

            dd($response);
            return json_decode($response->getBody()->getContents()); // return response object

        } catch (ClientException $e) {

            // return exception error
            $response = $e->getResponse();
            dd($response);
            return json_decode((string)($response->getBody()->getContents()));

        }
    }
}
