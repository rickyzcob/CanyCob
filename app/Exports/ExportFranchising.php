<?php

namespace App\Exports;

use App\Models\Franchisings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportFranchising implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Franchisings::all();
    }
}
