<?php

namespace App\Imports;

use App\Models\Releases;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ImportReleases implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Releases([
            'name' => $row['name'],
            'tenant_id' => Auth::user()->tenant->id,
            'cnpj' => $row['cnpj'],
            'status_id' => 3,
            'due_date' => $row['due_date'],
            'amount' => $row['amount'],
        ]);
    }

    public function chunkSize(): int
    {
        return 5000;
    }


}
