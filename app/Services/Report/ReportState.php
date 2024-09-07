<?php

namespace App\Services\Report;


use App\Models\ReportStatus;
use App\Services\RevenueManager;
use Illuminate\Support\Facades\Http;

class ReportState implements ReportStateInterface
{

    public function handle(ReportStatus $reportStatus): void
    {
        $verificationId = $reportStatus->getVerificationId();
        $reportResponse = Http::post('https://revenue-reporting.com/reports', [
            'verification_id' => $verificationId,
            'total_revenue' => RevenueManager::calculateTotalRevenue(),
        ])->throw()->json();

        $reportStatus->updateReportResponse($reportResponse);
    }
}