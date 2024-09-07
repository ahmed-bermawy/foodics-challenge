<?php

namespace App\Http\Controllers;

use App\Services\Report\ReportService;
use Illuminate\Http\Client\RequestException;

class Report extends Controller
{
    private ReportService $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function handleReport()
    {
        $this->reportService->handleReport();
        //try {
        //} catch (RequestException $e) {
        //    return response()->json(['message' => 'Failed to handle report'], 500);
        //}
    }
}