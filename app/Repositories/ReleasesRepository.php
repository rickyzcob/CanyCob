<?php

namespace App\Repositories;

use App\Jobs\ExportReleasesJob;
use App\Jobs\ImportReleasesJob;
use App\Models\ChargeAmountReleases;
use App\Models\Charges;
use App\Models\ChargeSchedule;
use App\Models\Fees;
use App\Models\ImportReleasesHistoric;
use App\Models\ProductSpecification;
use App\Models\Releases;
use App\Models\User;
use App\Requests\ReleasesRequest;
use App\Services\ReferenceService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use PHPUnit\Exception;
use function PHPUnit\Framework\isEmpty;

class ReleasesRepository
{
    public function index($filterData = null, $pageSize = null, $orderBy = null)
    {
        try {
            $ReleasesDB = Releases::query()->with('franchising', 'typeRelease');
            $ReleasesDB->where('tenant_id', Auth::user()->tenant->id);

            if (isset($filterData['name']) && $filterData['name'] != null) {
                $ReleasesDB->where('name', 'like', '%' .$filterData['name']. '%');

//                $ReleasesDB->whereHas('franchising', function ($query) use ($filterData){
//                    $query->where('name', 'like', '%'.$filterData['name'].'%');
//                });
            }

            if (isset($filterData['employer_number']) && $filterData['employer_number'] != null) {
                $ReleasesDB->where('employer_number', $filterData['employer_number']);
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
                'code' => 200
            ];
        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => 400,
                'message' => 'Erro no sistema'
            ];
        }
    }

    public function import($type_release_id, $file)
    {

        try {
            $referenceService = new ReferenceService();
            $mytime = Carbon::now();
            $tomorow = $mytime->addWeekday(1)->setTime(9, 00, 00);
            sleep(2);

            $batch = Bus::batch([
                new ImportReleasesJob($file),
            ])->dispatch();

            $selectImportedDinscinctReleasesDB = Releases::query()->select('releases.id', 'releases.tenant_id as tenant_id', 'releases.name', 'releases.employer_number',
                'releases.franchising_id', 'releases.due_date', 'releases.amount', 'releases.imported', 'franchisings.id as franch_id',
                'franchisings.attendant_id', 'franchisings.name as franch_name')
                ->leftJoin('franchisings', 'franchisings.employer_number', 'releases.employer_number')
                ->where('releases.franchising_id', null)
                ->where('releases.imported', 'Nao')
                ->where('releases.tenant_id', auth()->user()->tenant->id)
                ->where('releases.status_id', 3)
                ->orderBy('releases.id')
                ->groupBy('releases.employer_number')
                ->get();


            foreach ($selectImportedDinscinctReleasesDB as $itemFranchisingn) {

                $reference = $referenceService->getReference();
                $chargeDB = Charges::query()->where('franchising_id', $itemFranchisingn->franch_id)->first();

                if(!$chargeDB || $chargeDB->agreement == 1){
                    $createChargeForReleases = Charges::query()->create([
                        'franchising_id' => $itemFranchisingn->franch_id,
                        'attendant_id' => $itemFranchisingn->attendant_id,
                        'reference' => $reference,
                        'date_schedule' => $tomorow->addMinutes(30),
                        'status_id' => 9,
                        'total_amount' => 0,
                        'total_amount_corrected' => 0
                    ]);

                    ChargeSchedule::query()->create([
                        'user_id' => $itemFranchisingn->attendant_id,
                        'charge_id' => $createChargeForReleases->id,
                        'title' => $itemFranchisingn->franch_name,
                        'start' => $createChargeForReleases->date_schedule,
                    ]);

                    ChargeAmountReleases::query()->create([
                        'charge_id' => $createChargeForReleases->id,
                        'type_release_id' => $type_release_id,
                        'value' => 0
                    ]);
                }
                $this->setDateAndTimeSchedule();
                $this->setDateAndTimeChargeSchedule();
            }

            $selectFeesAutomaticByMonth = Fees::query()->whereStatus('Ativo')->where('automatic', 'Sim')->where('type', 'Month')->first();
            $percentageByMonth = $selectFeesAutomaticByMonth->value / 100;

            $selectFeesAutomaticByYear = Fees::query()->whereStatus('Ativo')->where('automatic', 'Sim')->where('type', 'Year')->first();
            $percentageByYear = $selectFeesAutomaticByYear->value / 100;

            $selectImportedReleasesDB = Releases::query()->select('releases.id', 'releases.name',  'releases.tenant_id', 'releases.employer_number', 'releases.franchising_id', 'releases.amount',
                'releases.amount_corrected', 'releases.due_date', 'franchisings.id as franch_id')
                ->leftJoin('franchisings', 'franchisings.employer_number', 'releases.employer_number')
                ->where('releases.franchising_id', null)
                ->where('releases.tenant_id', auth()->user()->tenant->id)
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

            $selectReleasesToAddChargeID = Releases::query()->select('releases.id', 'releases.name', 'releases.tenant_id', 'releases.employer_number', 'releases.franchising_id', 'releases.imported',
                'releases.due_date', 'franchisings.id as franch_id', 'charges.id as charges_id' )
                ->leftJoin('franchisings', 'franchisings.id', 'releases.franchising_id')
                ->leftJoin('charges', 'charges.franchising_id','franchisings.id')
                ->where('releases.imported', 'Nao')
                ->where('releases.tenant_id', auth()->user()->tenant->id)
                ->where('releases.status_id', 3)
                ->get();

            foreach ($selectReleasesToAddChargeID as $itemChargeRelease) {
                $itemChargeRelease->charge_id = $itemChargeRelease->charges_id;
                $itemChargeRelease->type_release_id = $type_release_id;
//                $itemChargeRelease->imported = 'Sim';
                $itemChargeRelease->update();
            }

            $selectChargesToUpdateAmounts = Charges::query()->with('releases')->where('status_id', 9 )->get();

            foreach ($selectChargesToUpdateAmounts as $itemUpdateAmount){

                $itemUpdateAmount->total_amount = $itemUpdateAmount->releases->sum('amount');
                $itemUpdateAmount->total_amount_corrected = $itemUpdateAmount->releases->sum('amount_corrected');
                $itemUpdateAmount->imported = 'Yes';
                $itemUpdateAmount->update();
            }

            $this->sumAmountReleasesByType($type_release_id);

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

    public function setDateAndTimeSchedule()
    {
        $mytime = Carbon::now();
        $tomorow = $mytime->addWeekday(1)->setTime(9, 00, 00);

        $usersDB = User::query()->whereStatus('Ativo')->get();

        foreach($usersDB as $itemUser) {
            $chargeScheduleDB = ChargeSchedule::query()->where('user_id', $itemUser->id)->where('imported', 'Não')->get();
            foreach($chargeScheduleDB as $itemChargeSchedule){
                $itemChargeSchedule->start = $tomorow->addMinutes(30);
                $itemChargeSchedule->imported = 'Sim';
                 $itemChargeSchedule->update();
            }
        }
    }

    public function setDateAndTimeChargeSchedule()
    {
        $mytime = Carbon::now();
        $tomorow = $mytime->addWeekday(1)->setTime(9, 00, 00);

        $chargesDB = Charges::query()->where('imported', 'Not')->update([
            'date_schedule' => $tomorow,
        ]);
    }

    public function sumAmountReleasesByType($type_release_id = null)
    {
        $chargesIDDB = Releases::query()->where('imported', 'Nao')->distinct('charge_id')->pluck('charge_id')->toArray();

        $chargeDB = Charges::query()->with('releases')->whereIn('id', $chargesIDDB)->get();

        $chargeAmountReleaseDB = ChargeAmountReleases::query()->where('type_release_id', $type_release_id)->get();

        if($chargeAmountReleaseDB->count() === 0) {
            foreach ($chargeDB as $itemCharge) {
                $releaseTeste =  Releases::query()->where('charge_id', $itemCharge->id)->where('type_release_id', $type_release_id)->sum('amount_corrected');
                ChargeAmountReleases::query()->create([
                    'charge_id' => $itemCharge->id,
                    'type_release_id' => $type_release_id,
                    'value' => $releaseTeste
                ]);
            }
        } else {
            foreach ($chargeAmountReleaseDB as $itemRelease) {
                $releaseTeste =  Releases::query()->where('charge_id', $itemRelease->charge_id)->where('type_release_id', $type_release_id)->sum('amount_corrected');

                    $itemRelease->charge_id = $itemRelease->charge_id;
                    $itemRelease->value = $releaseTeste;
                    $itemRelease->update();
            }
        }

        $releasesDB = Releases::query()->where('imported', 'Nao')->update([
            'imported' => 'Sim',
        ]);
    }
}
