<?php

namespace App\Repositories;

use App\Models\Charges;
use App\Models\PartnersFranchisings;
use App\Models\ProposalAccept;
use App\Models\Proposals;
use App\Models\TemplateProposal;
use App\Notifications\NotifyProposalAccept;
use App\Requests\ProposalRequest;
use App\Services\ReferenceService;
use Carbon\Carbon;
use PHPUnit\Exception;
use function App\Repositories\strtr;

class ProposalRepository
{
    public function getPrososalsByCharge($charge_id)
    {

        $proposalReturnDB = Proposals::query()->with('partner', 'templateproposal')
            ->whereHas('templateproposal', function ($query) {
                $query->where('type', 'Cobrança');
            })
            ->where('charge_id', $charge_id)
            ->orderBy('id', 'DESC')->get()->toArray();
        return $proposalReturnDB;
    }

    public function create($request, $charge_id)
    {
        $proposalRequest = new ProposalRequest();
        $requestValidated = $proposalRequest->validate($request);

        $chargeDB = Charges::query()->find($charge_id)->toArray();
        $templateProposal = TemplateProposal::query()->find($requestValidated['template_proposal_id'])->toArray();
        $partner = PartnersFranchisings::query()->with(['partner', 'franchising'])->where('partner_id', $requestValidated['partner_id'])->first()->toArray();

        $installmentValue = $chargeDB['total_amount_corrected'] / $requestValidated['installments'];

        $content = $templateProposal['content'];

        $contentReplace = [
            '{name}' => $partner['partner']['name'],
            '{total_amount}' => formatMoney($chargeDB['total_amount_corrected']),
            '{installments}' => $requestValidated['installments'],
            '{value_installment}' => formatMoney($installmentValue),
        ];

        $modify = strtr($content, $contentReplace);

        $referenceService = new ReferenceService();
        $reference = $referenceService->getReference();

        $requestValidated['charge_id'] = $charge_id;
        $requestValidated['installment_value'] = $installmentValue;
        $requestValidated['content'] = $modify;
        $requestValidated['reference'] = $reference;

        try {

            $ChargeStatusDB = Proposals::query()->create($requestValidated);

            return [
                'status' => 'success',
                'data' => $ChargeStatusDB,
                'code' => 202,
                'message' => 'Proposta cadastrada com sucesso !'
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

    public function delete($id = null)
    {
        try {
            $proposalsDB = Proposals::query()->findOrFail($id);
            $proposalsDB->delete();

            return [
                'status' => 'success',
                'data' => $proposalsDB,
                'code' => 200,
                'message' => 'Proposta deletada com sucesso !'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao deletar'
            ];
        }
    }

    public function deleteProposalAccept($id = null)
    {
        try {
            $proposalsDB = ProposalAccept::query()->findOrFail($id);
            $proposalsDB->delete();

            return [
                'status' => 'success',
                'data' => $proposalsDB,
                'code' => 200,
                'message' => 'Proposta deletada com sucesso !'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao deletar'
            ];
        }
    }

    public function changeStatus($id = null, $status)
    {
        try {
            $proposalsDB = Proposals::query()->findOrFail($id);
            $proposalsDB->update([
                'status' => $status
            ]);

            $proposalsDB->refresh();

            if($proposalsDB['status'] == 'Inativo'){
                $message = 'Proposta Bloqueada com Sucesso !';
            } else {
                $message = 'Proposta Ativada com Sucesso !';
            }

            return [
                'status' => 'success',
                'data' => $proposalsDB,
                'code' => 200,
                'message' => $message
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao deletar'
            ];
        }
    }

    public function validateCPF($document, $id)
    {
        $mytime = Carbon::now();

//        dd($document, $id);

        try {
            $proposalDB = ProposalAccept::query()->with('partner', 'charge.attendant')->findOrFail($id);

//            dd($proposalDB['charge']['id']);

            if($mytime->diffInDays($proposalDB['created_at']) > $proposalDB['days']) {
                return [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'A Proposta passou da validade de ' .$proposalDB['days']. ' dias por favor entre em contato com
                    nossa equipe de atendimento para gerar uma nova proposta.'
                ];
            }elseif($proposalDB['partner']['cpf'] != $document){
                return [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'CPF Nao corresponde com o cadastrado na proposta, verifique o mesmo.'
                ];
            } else {
                $proposalDB->update([
                    'accept' => 'Sim'
                ]);
                $proposalDB->refresh();

                $sent = $proposalDB['charge']['attendant']->notify( new NotifyProposalAccept($proposalDB['charge']['id']));

                return [
                    'status' => 'success',
                    'data' => $proposalDB,
                    'code' => 200,
                    'message' => 'Proposta Aceita com sucesso !'
                ];

            }
        } catch (\Exception $exception) {

            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao deletar'
            ];
        }
    }
}
