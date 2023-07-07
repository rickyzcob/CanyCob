<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class ClickSignService
{
    public function generateDocument($agreementDB = null, $clickSignDB = null)
    {
        try {
            $client = new Client();

            $host = 'https://'.$clickSignDB->host;

            $headers = [
                'Content-Type'=>'application/json',
                "Accept" => "application/json",
                'Host'=> $clickSignDB->host

            ];

            $body = [
                "document" => [
                    "path" => '/'.$agreementDB['franchising']['name'].'/Acordo-'.$agreementDB['reference'].'.docx',
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

            $request = new Request('POST', $host.'/api/v1/templates/'.$clickSignDB->template_document.'/documents?access_token='.$clickSignDB->token, $headers, json_encode($body)); // create request
            $response = $client->send($request);

            return json_decode($response->getBody()->getContents()); // return response object

        } catch (ClientException $e) {

            // return exception error
            $response = $e->getResponse();
            return json_decode((string)($response->getBody()->getContents()));

        }
    }

    public function addSignatory($partner = null, $clickSignDB = null)
    {
        $phone = str_replace( ['(', ')', '-'], '', $partner['phone']);


        try {
            $client = new Client();
            $host = 'https://'.$clickSignDB->host;

            $headers = [
                'Content-Type'=>'application/json',
                "Accept" => "application/json",
                'Host'=> $clickSignDB->host

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

            $request = new Request('POST', $host.'/api/v1/signers?access_token='.$clickSignDB->token, $headers, json_encode($body)); // create request
            $response = $client->send($request);

            return json_decode($response->getBody()->getContents()); // return response object

        } catch (ClientException $e) {
            // return exception error
            $response = $e->getResponse();
            return json_decode((string)($response->getBody()->getContents()));

        }

    }

    public function addSignatoryByDocument($document_key = null, $signer_key = null, $name = null, $clickSignDB = null)
    {

        try {
            $client = new Client();
            $host = 'https://'.$clickSignDB->host;

            $headers = [
                'Content-Type'=>'application/json',
                "Accept" => "application/json",
                'Host'=> $clickSignDB->host

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

            $request = new Request('POST', $host.'/api/v1/lists?access_token='.$clickSignDB->token, $headers, json_encode($body)); // create request
            $response = $client->send($request);

            return json_decode($response->getBody()->getContents()); // return response object

        } catch (ClientException $e) {
            $response = $e->getResponse();
            return json_decode((string)($response->getBody()->getContents()));

        }
    }

    public function sentDocumentByMail($request_signature_key = null, $name = null, $urlSignature = null, $clickSignDB = null)
    {

        try {
            $client = new Client();
            $host = 'https://'.$clickSignDB->host;

            $headers = [
                'Content-Type'=>'application/json',
                "Accept" => "application/json",
                'Host'=> $clickSignDB->host
            ];

            $body = [
                "request_signature_key" => $request_signature_key,
                "message" => "Prezado" .$name.", \nPor favor assine o documento.\n\nQualquer dúvida estou à disposição.\n\nAtenciosamente, \n".Auth::user()->tenant->name,
                "url" => $urlSignature
            ];

            $request = new Request('POST', $host.'/api/v1/notifications?access_token='.$clickSignDB->token, $headers, json_encode($body)); // create request
            $response = $client->send($request);
            return json_decode($response->getBody()->getContents()); // return response object

        } catch (ClientException $e) {

            $response = $e->getResponse();
            return json_decode((string)($response->getBody()->getContents()));

        }
    }

    public function getDocumentBySign($document_key = null, $agreementDB = null, $clickSignDB = null)
    {

        try {
            $client = new Client();
            $host = 'https://'.$clickSignDB->host;

            $headers = [
                'Content-Type'=>'application/json',
                "Accept" => "application/json",
                'Host'=> $clickSignDB->host
            ];

            $request = new Request('GET', $host.'/api/v1/documents/'.$document_key.'?access_token='.$clickSignDB->token, $headers); // create request
            $response = $client->send($request);
            return json_decode($response->getBody()->getContents()); // return response object

        } catch (ClientException $e) {

            $response = $e->getResponse();
            return json_decode((string)($response->getBody()->getContents()));

        }
    }

    public function listSigners($document_key = null, $signer_key = null, $name = null, $clickSignDB = null)
    {
//        dd($document_key, $signer_key, $name);
        try {
            $client = new Client();
            $host = 'https://'.$clickSignDB->host;

            $headers = [
                'Content-Type'=>'application/json',
                "Accept" => "application/json",
                'Host'=> $clickSignDB->host

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

            $request = new Request('POST', $host.'/api/v1/lists?access_token='.$clickSignDB->token, $headers, json_encode($body)); // create request
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
