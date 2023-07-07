<?php

namespace App\Repositories;

use App\Models\Agreements;
use App\Models\ChargeHistoric;
use App\Models\Charges;
use App\Models\ProposalAccept;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardRepository
{
    public function getProposalsByChart()
    {
        $users = ProposalAccept::select(
            'created_at as date',
            DB::raw("COUNT(id) as count"),
            DB::raw("MONTHNAME(created_at) as month_name"),
            DB::raw("DAY(created_at) as day"))

            ->whereYear('created_at', date('Y'))

            ->groupBy(DB::raw("day"))
            ->orderBy('month_name','DESC')
            ->get();
//            ->pluck('count', 'day');
//        dd($users);

        $return = [];

        foreach ($users as $key => $itemUser){
            $return['count'][$key] = 0;

            $return['day'][$key] = formatDate($itemUser['date']) ;
            $return['count'][$key] += 1;
        }

//        dd($return);
        return $return;

    }

    public function getChargesByPhone()
    {
            $date = \Carbon\Carbon::today()->subDays(10);
        $mytime = Carbon::now();

        $chargesDB = ChargeHistoric::select(
            'id',
            'datetime',
            'phone',
            'email',
            'created_at as date',
            'type as type',
            'tosum',

            DB::raw("COUNT(id) as count"),

//            DB::raw('(SELECT COUNT(DISTINCT id) FROM charge_historics WHERE type = "Phone" GROUP BY created_at) AS countPhone'),
//            DB::raw('(SELECT COUNT(*) FROM charge_historics WHERE type = "Email") AS countEmail'),
//            DB::raw('(SELECT COUNT(*) FROM charge_historics WHERE type = "WhatsApp") AS countWhatsApp'),

            DB::raw("MONTHNAME(created_at) as month_name"),
            DB::raw("DAY(created_at) as day"))
            ->where('type', 'phone')

            ->whereBetween('datetime', [$date, $mytime])

            ->groupBy('day')
            ->orderBy('created_at','asc')
            ->get();

        $chargesDB = json_decode($chargesDB,true);

        $return = [];

        if($chargesDB != null ){
            foreach ($chargesDB as $key => $itemCharge){

                $return['totalPhone'][$key] = 0;
                $return['day'][$key] = formatDate($itemCharge['datetime']) ;

                $return['totalPhone'][$key] += $itemCharge['count'];


            }
        } else {
            $return['totalPhone'] = 0;
            $return['day'] = 0;
        }

        return $return;

    }

    public function getChargesByMail()
    {
        $date = \Carbon\Carbon::today()->subDays(10);
        $mytime = Carbon::now();

        $chargesDB = ChargeHistoric::select(
            'id',
            'datetime',
            'phone',
            'email',
            'created_at as date',
            'type as type',
            'tosum',

            DB::raw("COUNT(id) as count"),

//            DB::raw('(SELECT COUNT(DISTINCT id) FROM charge_historics WHERE type = "Phone" GROUP BY created_at) AS countPhone'),
//            DB::raw('(SELECT COUNT(*) FROM charge_historics WHERE type = "Email") AS countEmail'),
//            DB::raw('(SELECT COUNT(*) FROM charge_historics WHERE type = "WhatsApp") AS countWhatsApp'),

            DB::raw("MONTHNAME(created_at) as month_name"),
            DB::raw("DAY(created_at) as day"))
            ->where('type', 'Email')

            ->whereBetween('datetime', [$date, $mytime])

            ->groupBy('day')
            ->orderBy('created_at','asc')
            ->get();

        $chargesDB = json_decode($chargesDB,true);

        $return = [];

        if($chargesDB != null ){
            foreach ($chargesDB as $key => $itemCharge){

                    $return['totalEmail'][$key] = 0;
                    $return['day'][$key] = formatDate($itemCharge['datetime']) ;

                    $return['totalEmail'][$key] += $itemCharge['count'];

            }
        } else {
            $return['totalEmail'] = 0;
            $return['day'] = 0;
        }

        return $return;
    }

    public function getChargesByWhatsapp()
    {
        $date = \Carbon\Carbon::today()->subDays(10);
        $mytime = Carbon::now();

        $chargesDB = ChargeHistoric::select(
            'id',
            'datetime',
            'phone',
            'email',
            'created_at as date',
            'type as type',
            'tosum',

            DB::raw("COUNT(id) as count"),

//            DB::raw('(SELECT COUNT(DISTINCT id) FROM charge_historics WHERE type = "Phone" GROUP BY created_at) AS countPhone'),
//            DB::raw('(SELECT COUNT(*) FROM charge_historics WHERE type = "Email") AS countEmail'),
//            DB::raw('(SELECT COUNT(*) FROM charge_historics WHERE type = "WhatsApp") AS countWhatsApp'),

            DB::raw("MONTHNAME(created_at) as month_name"),
            DB::raw("DAY(created_at) as day"))
            ->where('type', 'WhatsApp')

//            ->whereBetween('datetime', [$date, $mytime])

            ->groupBy('day')
            ->orderBy('created_at','asc')
            ->get();

        $chargesDB = json_decode($chargesDB,true);

        $return = [];

        if($chargesDB != null ){
            foreach ($chargesDB as $key => $itemCharge){
                $return['totalWhatsapp'][$key] = 0;
                $return['day'][$key] = formatDate($itemCharge['datetime']) ;

                $return['totalWhatsapp'][$key] += $itemCharge['count'];
            }
        } else {
            $return['totalWhatsapp'] = 0;
            $return['day'] = 0;
        }

        return $return;

    }

    public function getTotalValueCharges()
    {
        $chargeDB = Charges::query()->where('status_id', 9);

        if(auth()->user()->can('tenant_dashboard_view_panel_all') && auth()->user()->can('tenant_dashboard_view_panel_user')){
            $chargeDB = $chargeDB->sum('total_amount');
        }else if(auth()->user()->can('tenant_view_charges_user') && !auth()->user()->can('tenant_view_charges_all')) {
            $chargeDB->where('attendant_id', auth()->user()->id)->sum('total_amount');;
        } else if (auth()->user()->can('tenant_view_charges_all') && !auth()->user()->can('tenant_view_charges_user')) {
            $chargeDB = $chargeDB->sum('total_amount');
        }

        return formatMoney($chargeDB);
    }

    public function getTotalValueConference()
    {
        $chargeDB = Charges::query()->where('status_id', 17);

        if(auth()->user()->can('tenant_dashboard_view_panel_all') && auth()->user()->can('tenant_dashboard_view_panel_user')){
            $chargeDB = $chargeDB->sum('total_amount');
        }else if(auth()->user()->can('tenant_view_charges_user') && !auth()->user()->can('tenant_view_charges_all')) {
            $chargeDB->where('attendant_id', auth()->user()->id)->sum('total_amount');;
        } else if (auth()->user()->can('tenant_view_charges_all') && !auth()->user()->can('tenant_view_charges_user')) {
            $chargeDB = $chargeDB->sum('total_amount');
        }

        return formatMoney($chargeDB);
    }

    public function getTotalValueAgreement()
    {
        $agreementDB = Agreements::query();

        if(auth()->user()->can('tenant_dashboard_view_panel_all') && auth()->user()->can('tenant_dashboard_view_panel_user')){
            $agreementDB = $agreementDB->sum('agreements_amount');
        }else if(auth()->user()->can('tenant_view_charges_user') && !auth()->user()->can('tenant_view_charges_all')) {
            $agreementDB->where('attendant_id', auth()->user()->id)->sum('agreements_amount');;
        } else if (auth()->user()->can('tenant_view_charges_all') && !auth()->user()->can('tenant_view_charges_user')) {
            $agreementDB = $agreementDB->sum('agreements_amount');
        }

        return formatMoney($agreementDB);
    }

    public function getTotalHistoricsCharge()
    {
        $historicsChargeDB = ChargeHistoric::query()->with('charge');

        if(auth()->user()->can('tenant_dashboard_view_panel_all') && auth()->user()->can('tenant_dashboard_view_panel_user')){
            $historicsChargeDB = $historicsChargeDB->count();
        }else if(auth()->user()->can('tenant_view_charges_user') && !auth()->user()->can('tenant_view_charges_all')) {
            $historicsChargeDB->whereHas('charge', function ($query) {
                $query->where('attendant_id', auth()->user()->id)->count();
            });
        } else if (auth()->user()->can('tenant_view_charges_all') && !auth()->user()->can('tenant_view_charges_user')) {
            $historicsChargeDB = $historicsChargeDB->count();
        }


        return $historicsChargeDB;
    }

}
