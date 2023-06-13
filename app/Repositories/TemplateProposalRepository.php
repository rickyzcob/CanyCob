<?php

namespace App\Repositories;

use App\Models\TemplateProposal;
use PHPUnit\Exception;

class TemplateProposalRepository
{
    public function getSelectTemplateProposal($type)
    {
        try {
            $templateProposalDB = TemplateProposal::query()->whereStatus('Ativo')
                ->where('type', $type)
                ->get()
                ->toarray();

            return [
                'status' => 'success',
                'data' => $templateProposalDB,
                'code' => 200,
            ];

        } catch (Exception $exception){
            return [
                'status' => 'error',
                'code' => 401,
            ];
        }
    }
}
