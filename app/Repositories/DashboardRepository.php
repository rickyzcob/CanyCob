<?php

namespace App\Repositories;

use App\Models\ChargeHistoric;
use App\Models\ProposalAccept;
use App\Models\Proposals;
use App\Models\User;
use Carbon\Carbon;
use \Illuminate\Support\Facades\DB;
use function Symfony\Component\Translation\t;

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
        $chargesDB = ChargeHistoric::select(
            'created_at as date',
            DB::raw("COUNT(id) as count"),
            DB::raw("MONTHNAME(created_at) as month_name"),
            DB::raw("DAY(created_at) as day"))
            ->whereType('Phone')

            ->whereYear('created_at', date('Y'))

            ->groupBy(DB::raw("day"))
            ->orderBy('month_name','DESC')
            ->get();
//            ->pluck('count', 'day');
//        dd($users);

        $return = [];

        foreach ($chargesDB as $key => $itemCharge){
            $return['day'][$key] = formatDate($itemCharge['date']) ;
            $return['count'][$key] = $itemCharge['count'];
        }

//        dd($return);
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

            DB::raw("COUNT(*) as count"),

//            DB::raw('(SELECT COUNT(DISTINCT id) FROM charge_historics WHERE type = "Phone" GROUP BY date) AS countPhone'),
//            DB::raw('(SELECT COUNT(*) FROM charge_historics WHERE type = "Email") AS countEmail'),
//            DB::raw('(SELECT COUNT(*) FROM charge_historics WHERE type = "WhatsApp") AS countWhatsApp'),

            DB::raw("MONTHNAME(created_at) as month_name"),
            DB::raw("DAY(created_at) as day"))

            ->whereBetween('datetime', [$date, $mytime])

            ->groupBy('datetime')
            ->orderBy('created_at','asc')
            ->get();
//            ->pluck('count', 'day');

        $chargesDB = json_decode($chargesDB,true);

        $return = [];

        foreach ($chargesDB as $key => $itemCharge){
            $return['totalPhone'][$itemCharge['day']] = 0;
            $return['totalEmail'][$itemCharge['day']] = 0;
//
            $return['day'][$itemCharge['day']] = formatDate($itemCharge['datetime']) ;
            if($itemCharge['type'] == 'Phone') {
                $return['totalPhone'][$itemCharge['day']] = $itemCharge['count'];
            }
//            $return['totalEmail'][$key] = $itemCharge['countEmail'] ? $itemCharge['countEmail'] : 0;
//            $return['totalWhatsapp'][$key] = $itemCharge['countWhatsApp'] ? $itemCharge['countWhatsApp'] : 0;

//            if($itemCharge['type'] = 'Phone'){
//
//                $return['totalPhone'] += 1;
//            }
//            if($itemCharge['type'] == 'Email'){
//                $return['totalEmail'][$key] += 1;
//            }
//
//            if ($itemCharge['type'] == 'WhatsApp'){
//                dd('caiu');
//                $return['totalWhatsapp'][$key] ++;
//            }
//            $return['teste'][] = $itemCharge['count'] ? $itemCharge['count'] : 0;
        }

//        dd($return);
        return $return;
    }

    public function getChargesByWhatsapp()
    {
        $chargesDB = ChargeHistoric::select(
            'created_at as date',
            DB::raw("COUNT(id) as count"),
            DB::raw("COUNT(Type) as countPhone"),
            DB::raw("MONTHNAME(created_at) as month_name"),
            DB::raw("DAY(created_at) as day"))
            ->whereType('Whatsapp')

            ->whereYear('created_at', date('Y'))

            ->groupBy(DB::raw("day"))
            ->orderBy('month_name','DESC')
            ->get();
//            ->pluck('count', 'day');
//        dd($users);

        $return = [];

        foreach ($chargesDB as $key => $itemCharge){
            $return['day'][$key] = formatDate($itemCharge['date']) ;
            $return['count'][$key] = $itemCharge['count'] ? $itemCharge['count'] : 0;
        }

//        dd($return);
        return $return;

    }

}
