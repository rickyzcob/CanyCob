<?php

namespace App\Exports;

use App\Models\Releases;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportReleases implements FromQuery, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    protected $filters;
    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function map($release): array
    {
        return [
            $release->name,
            $release->franchising->name,
            $release->cnpj,
            formatDate($release->due_date),
            formatMoney($release->amount)
        ];
    }

    public function headings():array
    {
        return [
            'Cobrança',
            'Unidade',
            'CNPJ',
            'Data Vencimento',
            'Valor'
        ];
    }

    public function query()
    {

        $ReleasesDB = Releases::query()->with('franchising');

        if (isset($this->filters['name']) && $this->filters['name'] != null) {
            $ReleasesDB->where('name', 'like', '%'.$this->filters['name'].'%');
            $ReleasesDB->orWhere('name', 'like', '%'.$this->filters['name'].'%');
        }

        if (isset($this->filters['cnpj']) && $this->filters['cnpj'] != null) {
            $ReleasesDB->where('cnpj', $this->filters['cnpj']);
        }

        if (isset($this->filters['date_start']) && $this->filters['date_start'] != null) {
            $ReleasesDB->where('due_date', '>=', $this->filters['date_start']);
        }

        if (isset($this->filters['date_end']) && $this->filters['date_end'] != null) {
            $ReleasesDB->where('due_date', '<=', $this->filters['date_end']);
        }

        return $ReleasesDB;

    }
}
