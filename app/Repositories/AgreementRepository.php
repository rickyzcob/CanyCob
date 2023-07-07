<?php

namespace App\Repositories;

use App\Models\Agreements;
use App\Models\AgreementStatus;
use App\Models\Charges;
use App\Models\Partners;
use App\Models\Releases;
use App\Repositories\AgreementsRequest;
use App\Requests\AgreementRequest;
use App\Services\ClickSignService;
use App\Services\ReferenceService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

            if(auth()->user()->can('tenant_view_agreement_user') && auth()->user()->can('tenant_view_agreement_all')) {
                $agreementsDB = $agreementsDB->paginate($pageSize);
            }if(auth()->user()->can('tenant_view_agreement_user') && !auth()->user()->can('tenant_view_agreement_all')) {
                $agreementsDB->where('user_id', auth()->user()->id);
                $agreementsDB = $agreementsDB->paginate($pageSize);
            } else if (auth()->user()->can('tenant_view_agreement_all') && !auth()->user()->can('tenant_view_agreement_user')) {
                $agreementsDB = $agreementsDB->paginate($pageSize);
            }

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
            DB::beginTransaction();
            $requestValidated['franchising_id'] = $chargeDB['franchising_id'];
            $requestValidated['agreements_amount'] = $requestValidated['amount_corrected'];
            $requestValidated['status_id'] = 1;
            $requestValidated['charge_id'] = $charge_id;
            $requestValidated['reference'] = $reference;

            $agreementDB = auth()->user()->agreements()->create($requestValidated);

                for($i=1; $i <= $agreementDB->installments; $i++){
                    $insert_releases = Releases::query()->create([
                        'tenant_id' => Auth::user()->tenant->id,
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

            DB::commit();
            return [
                'status' => 'success',
                'data' => $agreementDB,
                'code' => 200,
                'message' => 'Acordo Gerado com sucesso !'
            ];


        } catch (Exception $exception){
            DB::rollBack();
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

    public function getAgreementsByUser()
    {
        try {
            $agreementsDB = Agreements::query()->with('status', 'franchising')->where('user_id', Auth::user()->id)->get()->toArray();

            return [
                'status' => 'success',
                'data' => $agreementsDB,
                'code' => 200,
            ];
        }catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao buscar o Produto'
            ];
        }
    }

    public function genererateWord($id = null)
    {
        $agreementDB = Agreements::query()->with('partner', 'franchising')->findOrFail($id);

//        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor();

        $values = [
            'reference' => $agreementDB['reference'],
            'franchising_name' => $agreementDB['franchising']['name'],
            'franchising_cnpj' => formatCPFCNPJ($agreementDB['franchising']['cnpj']),
            'franchising_city' => $agreementDB['franchising']['city'],
            'franchising_state' => $agreementDB['franchising']['state'],
            'franchising_address' => $agreementDB['franchising']['address'] ,
            'franchising_number' => $agreementDB['franchising']['number'],
            'franchising_neighborhood' => $agreementDB['franchising']['bairro'],
            'partner_name' => $agreementDB['partner']['name'],
            'partner_document' => formatCPFCNPJ($agreementDB['partner']['cpf']),
            'zip_code' => $agreementDB['franchising']['cep'],
            'agreement_amount' => formatMoney($agreementDB['agreements_amount']),
            'agreement_amount_write' => 'teste',
            'agreement_inflow' => formatMoney($agreementDB['inflow']),
            'agreement_installments' => $agreementDB['installments'],
            'installment_value' => formatMoney($agreementDB['installment_value']),
            'due_date' => formatDate($agreementDB['due_date']),
            'due_date_day' => Carbon::parse($agreementDB['due_date'])->format('d'),

        ];

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/public/templates/templateByInflow.docx'));

        $templateProcessor->setValues($values);

//        $section = $phpWord->addSection();
//        $text = $section->addText('INSTRUMENTO PARTICULAR DE CONFISSÃO DE DÍVIDA \n\n', array('align' => 'center', 'name' => 'Arial', 'size' => 20, 'bold' => true));
//        $text = $section->addText($content);
//        $text = $section->addText($agreementDB['partner']['name']);
//        $section->addImage(asset('storage/'.session('tenant')['logo']));
//        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($templateProcessor, 'Word2007');

        try {

            $templateProcessor->saveAs(storage_path('app/documents/Acordo-'.$agreementDB['reference'].'.docx'));

            $agreementDB->update([
                'generate_document' => 1,
                'file' => 'app/documents/Acordo-'.$agreementDB['reference'].'.docx',
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

    public function generateDocument($id = null)
    {
        DB::beginTransaction();
        try {
            $agreementDB = Agreements::query()->with('partner', 'franchising')->findOrFail($id);
            $clickSignRepository = new ClickSignRepository();
            $clickSignReturnDB = $clickSignRepository->getClickSing();

            if($clickSignReturnDB == null) {
                return [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Você não tem os dados da ClickSign cadastrados para gerar o Documento! Vá em configurações e adicione os dados ou entre em contato com o suporte'
                ];
            } else {

                DB::commit();
                $clicksignService = new ClickSignService();
                $returnClickSignService = $clicksignService->generateDocument($agreementDB, $clickSignReturnDB);

                if ($agreementDB['partner']['json_document'] == null) {
                    $returnClickSignServiceSignatory = $clicksignService->addSignatory($agreementDB['partner'], $clickSignReturnDB);
                    $signatory = json_encode($returnClickSignServiceSignatory, true);
                    Partners::query()->where(['id' => $agreementDB['partner']['id']])->update(['json_document' => $signatory]);
                }


                $document = json_encode($returnClickSignService, true);
                $agreementDB->update([
                    'json_document' => $document,
                ]);

                $decodeDocumentKey = json_decode($agreementDB['json_document'], true);
                $document_key = $decodeDocumentKey['document']['key'];

                $decodeSignatoryKey = json_decode($agreementDB['partner']['json_document'], true);
                $signer_key = $decodeSignatoryKey['signer']['key'];

                $addSignatoryByDocument = $clicksignService->addSignatoryByDocument($document_key, $signer_key, $agreementDB['partner']['name'], $clickSignReturnDB);
                $signatoryByDocument = json_encode($addSignatoryByDocument, true);

                $agreementDB->update([
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
            }

        } catch (\Exception $exception) {
            DB::rollBack();
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro no Sistema'
            ];
        }
    }
    public function sendEmail($id = null)
    {
        DB::beginTransaction();
        try {
            $clickSignRepository = new ClickSignRepository();
            $clickSignReturnDB = $clickSignRepository->getClickSing();

            if($clickSignReturnDB == null) {
                return [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Você não tem os dados da ClickSign cadastrados para gerar o Documento! Vá em configurações e adicione os dados ou entre em contato com o suporte'
                ];
            } else {

                DB::commit();
                $agreementDB = Agreements::query()->with('partner', 'franchising')->findOrFail($id);
                $decodeSignatoryKey = json_decode($agreementDB['signatory_document'], true);
                $request_signature_key = $decodeSignatoryKey['list']['request_signature_key'];
                $url_signature = $decodeSignatoryKey['list']['url'];

                $clicksignService = new ClickSignService();
                $returnClickSignService = $clicksignService->sentDocumentByMail($request_signature_key, $agreementDB['partner']['name'], $url_signature, $clickSignReturnDB);

                $agreementDB->update([
                    'sent' => 1,
                    'status_id' => 3
                ]);

                return [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Email Enviado Com sucesso'
                ];
            }

        } catch (\Exception $exception) {
            DB::rollBack();
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro no Sistema'
            ];
        }
    }

    public function downloadDocument($id = null)
    {

        try{
            $agreementDB = Agreements::query()->with('partner', 'franchising')->findOrFail($id);

                return [
                    'status' => 'success',
                    'data' => $agreementDB,
                    'code' => 200,
                    'message' => 'Download feito com sucesso'
                ];


        } catch (\Exception $exception) {

            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro no Sistema'
            ];
        }
    }

    public function changeStatus($id = null, $status_id = null)
    {

        DB::beginTransaction();
        try{

            $agreementDB = Agreements::query()->findOrFail($id);
            $agreementDB->update(['status_id' => $status_id]);
            $agreementDB->fresh();
            DB::commit();
            return [
                'status' => 'success',
                'data' => $agreementDB,
                'code' => 200,
                'message' => 'Status alterado com sucesso'
            ];


        } catch (\Exception $exception) {
            DB::rollBack();
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro no Sistema'
            ];
        }
    }
    public function getSelectStatusCharge()
    {
        $agreementStatusDB = AgreementStatus::query()->get()->toarray();
        return $agreementStatusDB;
    }

}
