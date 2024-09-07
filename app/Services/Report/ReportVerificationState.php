<?php

namespace App\Services\Report;

use App\Models\ReportStatus;
use Illuminate\Support\Facades\Http;

class ReportVerificationState implements ReportStateInterface
{

    public function handle(ReportStatus $reportStatus): void
    {
        $verificationResponse = Http::post('https://revenue-verifier.com')->throw()->json();

        $reportStatus->updateVerificationResponse($verificationResponse);
    }
}