<?php

namespace App\Jobs;

use App\Exports\ExportReleases;
use Illuminate\Bus\Queueable;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportReleasesJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $filters;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filterData)
    {
        $this->filters = $filterData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new ExportReleases($this->filters))->store('export/lancamentos.xlsx');
    }
}
