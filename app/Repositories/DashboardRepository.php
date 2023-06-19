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
//        dd($chargesDB);

        $return = [];

        foreach ($chargesDB as $key => $itemCharge){
            $return['totalPhone'][$key] = 0;
            $return['day'][$key] = formatDate($itemCharge['datetime']) ;

            $return['totalPhone'][$key] += $itemCharge['count'];

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
//        dd($chargesDB);

        $return = [];

        foreach ($chargesDB as $key => $itemCharge){
            $return['totalEmail'][$key] = 0;
            $return['day'][$key] = formatDate($itemCharge['datetime']) ;

                $return['totalEmail'][$key] += $itemCharge['count'];

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
//        dd($chargesDB);

        $return = [];

        foreach ($chargesDB as $key => $itemCharge){
            $return['totalWhatsapp'][$key] = 0;
            $return['day'][$key] = null;
            $return['day'][$key] = formatDate($itemCharge['datetime']) ;

            $return['totalWhatsapp'][$key] += $itemCharge['count'];

        }

//        dd($return);

        return $return;

    }

}
