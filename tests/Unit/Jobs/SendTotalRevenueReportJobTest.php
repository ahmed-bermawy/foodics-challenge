<?php

namespace Tests\Unit\Jobs;

use App\Jobs\SendTotalRevenueReportJob;
use App\Models\Product;
use App\Models\ReportStatus;
use App\Services\Report\ReportService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SendTotalRevenueReportJobTest extends TestCase
{
    use DatabaseTransactions;
    public function test_handle()
    {
        Http::fake([
            '*revenue-verifier.com' => Http::response(['id' => 1]),
            '*revenue-reporting.com/reports' => Http::response(['id' => 2]),
            '*revenue-reporting.com/reports/confirm' => Http::response([]),
        ]);

        $reportStatus = new ReportStatus();
        $reportService = new ReportService($reportStatus);

        $job = new SendTotalRevenueReportJob();
        $job->handle($reportService);

        Http::assertSentCount(3);
    }
}
