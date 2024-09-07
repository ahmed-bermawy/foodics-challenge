<?php

namespace App\Services\Report;

use App\Models\ReportStatus;
use Illuminate\Support\Facades\Http;

class ReportConfirmationState implements ReportStateInterface
{
    public function handle(ReportStatus $reportStatus): void
    {
        $reportId = $reportStatus->getReportId();
        Http::post('https://revenue-reporting.com/reports/confirm', [
            'report_id' => $reportId,
            'timestamp' => now()->timestamp,
        ])->throw()->json();
        $reportStatus->updateReportConfirm();
    }
}