<?php

namespace App\Services\Report;

use App\Models\ReportStatus;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Client\RequestException;

class ReportService
{
    private ReportStatus $reportStatus;

    public function __construct(ReportStatus $reportStatus)
    {
        $this->reportStatus = $reportStatus;
    }

    /**
     * @throws RequestException
     */
    public function handleReport(): void
    {
        $jobId = Uuid::uuid4()->toString();
        $report = $this->reportStatus->createReportJobId($jobId);

        $this->handleReportState($report);
    }

    private function handleReportState($report): void
    {
        while (true) {
            $state = null;

            if (!$report->verification_response) {
                $state = new ReportVerificationState();
            } elseif (!$report->report_response) {
                $state = new ReportState();
            } elseif (!$report->confirm) {
                $state = new ReportConfirmationState();
            } else {
                break;
            }

            $state->handle($report);
        }
    }
}