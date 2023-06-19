<?php

namespace App\Repositories;

use App\Jobs\ExportReleasesJob;
use App\Jobs\ImportReleasesJob;
use App\Models\Charges;
use App\Models\Fees;
use App\Models\ImportReleasesHistoric;
use App\Models\ProductSpecification;
use App\Models\Releases;
use App\Requests\ReleasesRequest;
use App\Services\ReferenceService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Bus;
use PHPUnit\Exception;

class ReleasesRepository
{
    public function index($filterData = null, $pageSize, $orderBy)
    {

        try {
            $ReleasesDB = Releases::query()->with('franchising');

            if (isset($filterData['name']) && $filterData['name'] != null) {
                $ReleasesDB->where('name', 'like', '%' .$filterData['name']. '%');

//                $ReleasesDB->whereHas('franchising', function ($query) use ($filterData){
//                    $query->where('name', 'like', '%'.$filterData['name'].'%');
//                });
            }

            if (isset($filterData['cnpj']) && $filterData['cnpj'] != null) {
                $ReleasesDB->where('cnpj', $filterData['cnpj']);
            }

            if (isset($filterData['date_start']) && $filterData['date_start'] != null) {
                $ReleasesDB->where('due_date', '>=', $filterData['date_start']);
            }

            if (isset($filterData['date_end']) && $filterData['date_end'] != null) {
                $ReleasesDB->where('due_date', '<=', $filterData['date_end']);
            }

            $ReleasesDB->orderBy($orderBy['column'], $orderBy['order']);

            if($pageSize) {
                $ReleasesDB = $ReleasesDB->paginate($pageSize);
            } else {
                $ReleasesDB = $ReleasesDB->get();
            }


            return [
                'status' => 'success',
                'data' => $ReleasesDB,
                'code' => 202
            ];
        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro no sistema'
            ];
        }
    }

    public function import($file)
    {
        try {
            $referenceService = new ReferenceService();
            $reference = $referenceService->getReference();

            sleep(2);

            $batch = Bus::batch([
                new ImportReleasesJob($file),
            ])->dispatch();

            $selectImportedDinscinctReleasesDB = Releases::query()->select('releases.id', 'releases.name', 'releases.cnpj',
                'releases.franchising_id', 'releases.due_date', 'releases.amount', 'releases.imported', 'franchisings.id as franch_id',
                'franchisings.attendant_id')
                ->leftJoin('franchisings', 'franchisings.cnpj', 'releases.cnpj')
                ->where('releases.franchising_id', null)
                ->where('releases.imported', 'Nao')
                ->where('releases.status_id', 3)
                ->orderBy('releases.id')
                ->groupBy('releases.cnpj')
                ->get();


            foreach ($selectImportedDinscinctReleasesDB as $itemFranchisingn) {
                $chargeDB = Charges::query()->where('franchising_id', $itemFranchisingn->franch_id)->first();
                if(!$chargeDB || $chargeDB->agreement == 1){
                    $createChargeForReleases = Charges::query()->create([
                        'franchising_id' => $itemFranchisingn->franch_id,
                        'attendant_id' => $itemFranchisingn->attendant_id,
                        'reference' => $reference,
                        'status_id' => 9,
                        'total_amount' => 0,
                        'total_amount_corrected' => 0
                    ]);
                }
            }

            $selectFeesAutomaticByMonth = Fees::query()->whereStatus('Ativo')->where('automatic', 'Sim')->where('type', 'Month')->first();
            $percentageByMonth = $selectFeesAutomaticByMonth->value / 100;

            $selectFeesAutomaticByYear = Fees::query()->whereStatus('Ativo')->where('automatic', 'Sim')->where('type', 'Year')->first();
            $percentageByYear = $selectFeesAutomaticByYear->value / 100;

            $mytime = Carbon::now();

            $selectImportedReleasesDB = Releases::query()->select('releases.id', 'releases.name', 'releases.cnpj', 'releases.franchising_id', 'releases.amount',
                'releases.amount_corrected', 'releases.due_date', 'franchisings.id as franch_id')
                ->leftJoin('franchisings', 'franchisings.cnpj', 'releases.cnpj')
                ->where('releases.franchising_id', null)
                ->where('releases.status_id', 3)
                ->get();

            $addHistoricImportRelasesDB = auth()->user()->historicImportReleases()->create([
                'type' => 'Importação',
                'date' => Carbon::now(),
                'quantity' => $selectImportedReleasesDB->count()
            ]);

            foreach ($selectImportedReleasesDB as $itemRelease) {
                $itemRelease->franchising_id = $itemRelease->franch_id;
                $itemRelease->historic_id = $addHistoricImportRelasesDB->id;
                if($mytime->diffInMonths($itemRelease->due_date) > '1') {
                    $itemRelease->amount_corrected = ($itemRelease->amount * $percentageByYear) + $itemRelease->amount + ($mytime->diffInMonths($itemRelease->due_date) * $itemRelease->amount * $percentageByMonth) ;
                }else {
                    $itemRelease->amount_corrected = ($itemRelease->amount * $percentageByYear) + $itemRelease->amount + ($mytime->diffInDays($itemRelease->due_date) * $itemRelease->amount * ($percentageByMonth/30)) ;
                }
                $itemRelease->update();
            }

            $selectReleasesToAddChargeID = Releases::query()->select('releases.id', 'releases.name', 'releases.cnpj', 'releases.franchising_id', 'releases.imported',
                'releases.due_date', 'franchisings.id as franch_id', 'charges.id as charges_id' )
                ->leftJoin('franchisings', 'franchisings.id', 'releases.franchising_id')
                ->leftJoin('charges', 'charges.franchising_id','franchisings.id')
                ->where('releases.imported', 'Nao')
                ->where('releases.status_id', 3)
                ->get();

            foreach ($selectReleasesToAddChargeID as $itemChargeRelease) {
                $itemChargeRelease->charge_id = $itemChargeRelease->charges_id;
                $itemChargeRelease->imported = 'Sim';
                $itemChargeRelease->update();
            }

            $selectChargesToUpdateAmounts = Charges::query()->with('releases')->where('status_id', 9)->get();

            foreach ($selectChargesToUpdateAmounts as $itemUpdateAmount){
                $itemUpdateAmount->total_amount = $itemUpdateAmount->releases->sum('amount');
                $itemUpdateAmount->total_amount_corrected = $itemUpdateAmount->releases->sum('amount_corrected');
                $itemUpdateAmount->imported = 'Yes';
                $itemUpdateAmount->update();
            }

            return [
                'status' => 'success',
                'data' => $batch,
                'code' => 200,
                'message' => 'Importação feita com sucesso !'
            ];

        } catch (Exception $exception) {

            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao importar'
            ];
        }

    }

    public function export($filterData)
    {
        try{

            sleep(3);

            $batch = Bus::batch([
                new ExportReleasesJob($filterData),
            ])->dispatch();

            $addHistoricImportRelasesDB = auth()->user()->historicImportReleases()->create([
                'type' => 'Exportação',
                'date' => Carbon::now(),
                'quantity' => 0
            ]);

            return [
                'status' => 'success',
                'data' => $batch,
                'code' => 200,
                'message' => 'Exportação feita com sucesso !'
            ];

        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro ao exportar'
            ];
        }

    }

    public function historics($pageSize, $orderBy)
    {

        try {
            $importReleasesHistoricDB = ImportReleasesHistoric::query()->with('user');

            $importReleasesHistoricDB->orderBy($orderBy['column'], $orderBy['order']);

            if($pageSize) {
                $importReleasesHistoricDB = $importReleasesHistoricDB->paginate($pageSize);
            } else {
                $importReleasesHistoricDB = $importReleasesHistoricDB->get();
            }


            return [
                'status' => 'success',
                'data' => $importReleasesHistoricDB,
                'code' => 202
            ];
        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro no sistema'
            ];
        }
    }

    public function getReleasesbyHistoric($historic_id)
    {

        try {
            $ReleasesDB = Releases::query()->where('historic_id', $historic_id)->get();

//            $importReleasesHistoricDB->orderBy($orderBy['column'], $orderBy['order']);
//
//            if($pageSize) {
//                $importReleasesHistoricDB = $importReleasesHistoricDB->paginate($pageSize);
//            } else {
//                $importReleasesHistoricDB = $importReleasesHistoricDB->get();
//            }


            return [
                'status' => 'success',
                'data' => $ReleasesDB,
                'code' => 200
            ];
        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro no sistema'
            ];
        }
    }

    public function getReleasesByAgreement($agreement_id)
    {

        try {
            $ReleasesDB = Releases::query()->where('agreement_id', $agreement_id)->get();
            return [
                'status' => 'success',
                'data' => $ReleasesDB,
                'code' => 200
            ];
        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro no sistema'
            ];
        }
    }

    public function reprecificateReleases($request, $charge_id)
    {
        $releasesRequest = new ReleasesRequest();
        $requestValidated = $releasesRequest->validatePrecification($request);
        $mytime = Carbon::now();

        $selectFeesAutomaticByMonth = Fees::query()->findOrFail($requestValidated['fees_month']);
        $percentageByMonth = $selectFeesAutomaticByMonth->value / 100;

        $selectFeesAutomaticByYear = Fees::query()->findOrFail($requestValidated['fees_year']);
        $percentageByYear = $selectFeesAutomaticByYear->value / 100;

        try {
            $releasesReturnDB = Releases::query()->where('charge_id', $charge_id)->get();

            foreach ($releasesReturnDB as $itemRelease) {
                if ($mytime->diffInMonths($itemRelease->due_date) > '1') {
                    $itemRelease['amount_corrected'] = ($itemRelease['amount'] * $percentageByYear) + $itemRelease['amount'] + ($mytime->diffInMonths($itemRelease['due_date']) * $itemRelease['amount'] * $percentageByMonth);
                } else {
                    $itemRelease['amount_corrected'] = ($itemRelease['amount'] * $percentageByYear) + $itemRelease['amount'] + ($mytime->diffInDays($itemRelease['due_date']) * $itemRelease['amount'] * ($percentageByMonth / 30));
                }
                $itemRelease->update();
            }


            $feesDB = Charges::query()->with('releases')->findOrFail($charge_id);
            $feesDB->update([
                'total_amount' => $feesDB['releases']->sum('amount'),
                'total_amount_corrected' => $feesDB['releases']->sum('amount_corrected')
            ]);
            $feesDB->fresh();

            return [
                'status' => 'success',
                'data' => $feesDB,
                'code' => 200,
                'message' => 'Reprecificação feita com sucesso !'
            ];

        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 200,
                'message' => 'Erro no sistema'
            ];
        }
    }
}
