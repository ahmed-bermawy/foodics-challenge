<?php

namespace App\Services\Report;

use App\Models\ReportStatus;

interface ReportStateInterface
{
    public function handle(ReportStatus $reportStatus): void;
}