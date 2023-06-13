<?php

namespace App\Repositories;

use App\Models\Agreements;
use App\Models\Charges;
use App\Models\Partners;
use App\Models\Releases;
use App\Requests\AgreementRequest;
use App\Services\ClickSignService;
use App\Services\ReferenceService;
use Carbon\Carbon;
use PHPUnit\Exception;

class AgreementRepository
{
    public function index($filterData = null, $pageSize, $orderBy)
    {

        try {
            $agreementsDB = Agreements::query()->with('franchising', 'partner');

            if (isset($filterData['name']) && $filterData['name'] != null) {
                $agreementsDB->whereHas('franchising', function ($query) use ($filterData){
                    $query->where('name', 'like', '%'.$filterData['name'].'%');
                });
            }
            if (isset($filterData['status']) && $filterData['status'] != null) {
                $agreementsDB->where('status', $filterData['status']);
            }

//            $agreementsDB->orderBy($orderBy['column'], $orderBy['order']);
            $agreementsDB->whereHas('franchising', function ($query) use ($orderBy){
                $query->orderBy($orderBy['column'], $orderBy['order']);
            });

            $agreementsDB = $agreementsDB->paginate($pageSize);

            return [
                'status' => 'success',
                'data' => $agreementsDB,
                'code' => 202
            ];
        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao Cadastrar'
            ];
        }
    }

    public function create($request, $charge_id)
    {
        $AgreementsRequest = new AgreementRequest();
        $requestValidated = $AgreementsRequest->validate($request);
        $chargeDB = Charges::query()->with('franchising')->findOrFail($charge_id);

        $referenceService = new ReferenceService();
        $reference = $referenceService->getReference();
        try {

            $requestValidated['franchising_id'] = $chargeDB['franchising_id'];
            $requestValidated['agreements_amount'] = $requestValidated['amount_corrected'];
            $requestValidated['status_id'] = 1;
            $requestValidated['reference'] = $reference;

            $agreementDB = auth()->user()->agreements()->create($requestValidated);

                for($i=1; $i <= $agreementDB->installments; $i++){
                    $insert_releases = Releases::query()->create([
                        'name' => 'Acordo',
                        'cnpj' => $chargeDB['franchising']['cnpj'],
                        'agreement_id' => $agreementDB->id,
                        'status_id' => 5,
                        'franchising_id' => $agreementDB->franchising_id,
                        'parcel' => $i,
                        'imported' => 'Sim',
                        'issue_date' => date('Ymd'),
                        'due_date' =>  $i == 1 ? Carbon::parse($requestValidated['due_date'])->format('Ymd') : Carbon::parse($requestValidated['due_date'])->subMonth()->addMonths($i)->format('Ymd'),
                        'amount' => $agreementDB->installment_value
                    ]);
                }

            $chargeDB->update(['agreement_id' => $agreementDB->id, 'status_id' => 16]);


            return [
                'status' => 'success',
                'data' => $agreementDB,
                'code' => 200,
                'message' => 'Acordo Gerado com sucesso !'
            ];


        } catch (Exception $exception){

            return [
                'status' => 'error',
                'data' => $exception,
                'code' => 200,
                'message' => 'Erro ao Cadastrar'
            ];

        }
    }

    public function update($id, $request)
    {
        $AgreementsRequest = new AgreementsRequest();
        $requestValidated = $AgreementsRequest->validate($request, $id);

        try {
            $agreementsDB = Agreements::query()->findOrFail($id);
            $agreementsDB->update($requestValidated);

            return [
                'status' => 'success',
                'data' => $agreementsDB,
                'code' => 202,
                'message' => 'Taxa de Juros atualizado com sucesso !'
            ];

        }catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao Atualizar'
            ];
        }
    }

    public function show($id)
    {
        try {
            $agreementsDB = Agreements::query()->find($id);

            return [
                'status' => 'success',
                'data' => $agreementsDB,
                'code' => 202,
                'message' => 'Acordo obtido com sucesso !'

            ];
        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao buscar o Produto'
            ];
        }
    }

    public function showByReference($reference)
    {
        try {
            $agreementsDB = Agreements::query()->with('franchising','partner')->where('reference', $reference)->first();

            return [
                'status' => 'success',
                'data' => $agreementsDB,
                'code' => 202,
                'message' => 'Taxa obtido com sucesso !'

            ];
        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao buscar o Produto'
            ];
        }
    }

    public function delete($id = null)
    {
        try {
            $agreementsDB = Agreements::query()->findOrFail($id);
            $agreementsDB->delete();

            return [
                'status' => 'success',
                'data' => $agreementsDB,
                'code' => 202,
                'message' => 'Taxa de Juros apagado com sucesso !'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro ao deletar'
            ];
        }
    }

    public function generateDocument($id = null)
    {
        try {
            $agreementDB = Agreements::query()->with('partner', 'franchising')->findOrFail($id);

            $clicksignService = new ClickSignService();
            $returnClickSignService = $clicksignService->generateDocument($agreementDB);

            if ($agreementDB['partner']['json_document'] == null) {
                $returnClickSignServiceSignatory = $clicksignService->addSignatory($agreementDB['partner']);
                $signatory = json_encode($returnClickSignServiceSignatory, true);
                Partners::query()->where(['id' => $agreementDB['partner']['id']])->update(['json_document' => $signatory]);
            }

            $document = json_encode($returnClickSignService, true);

            $decodeDocumentKey = json_decode($agreementDB['json_document'], true);
            $document_key = $decodeDocumentKey['document']['key'];

            $decodeSignatoryKey = json_decode($agreementDB['partner']['json_document'], true);
            $signer_key = $decodeSignatoryKey['signer']['key'];

            $addSignatoryByDocument = $clicksignService->addSignatoryByDocument($document_key, $signer_key, $agreementDB['partner']['name']);
            $signatoryByDocument = json_encode($addSignatoryByDocument, true);

            $agreementDB->update([
                'json_document' => $document,
                'generate_document' => 1,
                'signatory_document' => $signatoryByDocument,
                'status_id' => 2
            ]);

            $chargeDB = Charges::query()->where('agreement_id', $agreementDB->id)->update(['status_id' => 16]);

            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'Documento Gerado Com sucesso'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro no Sistema'
            ];
        }
    }
    public function sendEmail($id = null)
    {
        try {
            $agreementDB = Agreements::query()->with('partner', 'franchising')->findOrFail($id);
            $decodeSignatoryKey = json_decode($agreementDB['signatory_document'], true);
            $request_signature_key = $decodeSignatoryKey['list']['request_signature_key'];

            $clicksignService = new ClickSignService();
            $returnClickSignService = $clicksignService->sentDocumentByMail($request_signature_key, $agreementDB['partner']['name']);

            $agreementDB->update([
                'sent' => 1,
                'status_id' => 3
            ]);

            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'Email Enviado Com sucesso'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro no Sistema'
            ];
        }
    }


}
