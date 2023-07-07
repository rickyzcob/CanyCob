<?php

namespace App\Repositories;

use App\Models\Charges;
use App\Models\PartnersFranchisings;
use App\Models\ProposalAccept;
use App\Models\Proposals;
use App\Models\Releases;
use App\Models\TemplateProposal;
use App\Requests\ProposalRequest;
use App\Services\ReferenceService;
use Carbon\Carbon;
use PHPUnit\Exception;
use function App\Repositories\strtr;

class ProposalAcceptRepository
{
    public function create($request, $charge_id)
    {
        $proposalRequest = new ProposalRequest();
        $requestValidated = $proposalRequest->validate($request);

        $chargeDB = Charges::query()->find($charge_id)->toArray();
        $templateProposal = TemplateProposal::query()->find($requestValidated['template_proposal_id'])->toArray();
        $partner = PartnersFranchisings::query()->with(['partner', 'franchising'])->where('partner_id', $requestValidated['partner_id'])->first()->toArray();

        $releases = Releases::query()->where('charge_id', $charge_id)->get();

        foreach ($releases as $key => $itemRelease) {
            $rel[] = '<tr>
                        <td class="whitespace-nowrap px-6 py-4 font-medium">'.$itemRelease->name.'</td>
                         <td class="whitespace-nowrap px-6 py-4">'.formatDate($itemRelease->due_date).'</td>
                          <td class="whitespace-nowrap px-6 py-4">'.formatMoney($itemRelease->amount).'</td>
                          <td class="whitespace-nowrap px-6 py-4">'.formatMoney($itemRelease->amount_corrected).'</td>
                    </tr>';
        }
        if($requestValidated['type'] == 'Parcelado com Entrada') {
            $installmentValue = ($chargeDB['total_amount_corrected'] - $requestValidated['inflow'])  / $requestValidated['installments'];
            $balanceValue = ($chargeDB['total_amount_corrected'] - $requestValidated['inflow']);
            $requestValidated['balance_value'] = $balanceValue;

            $parse = 'Eu, '.$partner['partner']['name']. ' sob documento '. formatCPFCNPJ($partner['partner']['cpf']).', autorizo a negociação dos lançamentos em aberto no valor de ' .formatMoney($chargeDB['total_amount_corrected']).
             ' na condição de '.$requestValidated['type'] . ' sendo '.formatMoney($requestValidated['inflow']). ' de entrada e o saldo restante de '.formatMoney($balanceValue).' em ' .$requestValidated['installments']. 'x de ' .formatMoney($installmentValue). ' .' ;

        } elseif ($requestValidated['type'] == 'Parcelado sem Entrada') {
            $installmentValue = $chargeDB['total_amount_corrected'] / $requestValidated['installments'];
            $requestValidated['balance_value'] = $chargeDB['total_amount_corrected'];

            $parse = 'Eu, '.$partner['partner']['name']. ' sob documento '. formatCPFCNPJ($partner['partner']['cpf']).', autorizo a negociação dos lançamentos em aberto no valor de ' .formatMoney($chargeDB['total_amount_corrected']).
                ' na condição de '.$requestValidated['type'] . ' sendo em ' .$requestValidated['installments']. 'x de ' .formatMoney($installmentValue). ' .' ;

        } else {
            $installmentValue = $chargeDB['total_amount_corrected'];

            $parse = 'Eu, '.$partner['partner']['name']. ' sob documento '. formatCPFCNPJ($partner['partner']['cpf']).', autorizo a negociação dos lançamentos em aberto no valor de ' .formatMoney($chargeDB['total_amount_corrected']).
                ' na condição de '.$requestValidated['type'] . ' no valor de ' .formatMoney($chargeDB['total_amount_corrected']). ' .' ;

        }

        $content = $templateProposal['content'];

        $contentReplace = [
            '{type}'=> $requestValidated['type'],
            '{unit}' => $partner['franchising']['name'],
            '{name}' => $partner['partner']['name'],
            '{cpf}' => $partner['partner']['cpf'],
            '{email}' => $partner['partner']['email'],
            '{phone}' => $partner['partner']['phone'],
            '{address}' => $partner['franchising']['address']. '-' .$partner['franchising']['number'],
            '{date}' => Carbon::now()->format('d/m/y H:i'),
            '{parse}' => $parse,
            '{total_amount}' => formatMoney($chargeDB['total_amount_corrected']),
//            '{inflow}' => formatMoney($requestValidated['inflow']) ,
//            '{installments}' => $requestValidated['installments'],
//            '{balance}' => formatMoney($balanceValue),
//            '{value_installment}' => formatMoney($installmentValue),
            '{releases}' => implode($rel),
            '{days}' => $requestValidated['days']
        ];

        $modify = \strtr($content, $contentReplace);

        $referenceSerivce = new ReferenceService();
        $reference = $referenceSerivce->getReference();

        $requestValidated['installment_value'] = $installmentValue;
        $requestValidated['content'] = $modify;
        $requestValidated['charge_id'] = $charge_id;
        $requestValidated['reference'] = $reference;

        try {

            $proposalAcceptReturnDB = ProposalAccept::query()->create($requestValidated);

            $chargeDB = Charges::query()->where('id', $charge_id)->update(['proposal_accept_id' => $proposalAcceptReturnDB->id]);

            return [
                'status' => 'success',
                'data' => $proposalAcceptReturnDB,
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
    public function delete($id = null, $charge_id)
    {
        try {
            $chargeDB = Charges::query()->where('id', $charge_id);
            $chargeDB->update(['proposal_accept_id' => null]);

            $proposalsDB = ProposalAccept::query()->findOrFail($id);
            $proposalsDB->delete();

            return [
                'status' => 'success',
                'data' => $proposalsDB,
                'code' => 200,
                'message' => 'Proposta deletada com sucesso !'
            ];

        } catch (\Exception $exception) {
            dd($exception);
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
            $proposalsDB = ProposalAccept::query()->findOrFail($id);
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

        try {
            $proposalsDB = Proposals::query()->with('partner')->findOrFail($id);

            if($mytime->diffInDays($proposalsDB['created_at']) > $proposalsDB['days']) {
                return [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'A Proposta passou da validade de ' .$proposalsDB['days']. ' dias por favor entre em contato com
                    nossa equipe de atendimento para gerar uma nova proposta.'
                ];
            }elseif($proposalsDB['partner']['cpf'] != $document){
                return [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'CPF Nao corresponde com o cadastrado na proposta, verifique o mesmo.'
                ];
            } else {
                $proposalsDB->update([
                    'accept' => 'Sim'
                ]);

                $proposalsDB->refresh();

                return [
                    'status' => 'success',
                    'data' => $proposalsDB,
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
