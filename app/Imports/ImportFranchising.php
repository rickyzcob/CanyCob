<?php

namespace App\Imports;

use App\Models\Franchisings;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportFranchising implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Franchisings([
            //
        ]);
    }
}
