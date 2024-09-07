<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'verification_response',
        'report_response',
        'confirm'
    ];

    protected $casts = [
        'confirm' => 'boolean'
    ];

    //public function getVerificationResponseAttribute($value)
    //{
    //    return json_decode($value, true);
    //}
    //
    //public function getReportResponseAttribute($value)
    //{
    //    return json_decode($value, true);
    //}

    public function createReportJobId($jobId)
    {
        return self::create(['job_id' => $jobId]);
    }

    public function getVerificationId()
    {
        return $this->verification_response['id'];
    }

    public function updateVerificationResponse($response): void
    {
        self::update(['verification_response' => $response]);
    }

    public function updateReportResponse($response): void
    {
        self::update(['report_response' => $response]);
    }

    public function getReportId()
    {
        return $this->report_response['id'];
    }

    public function updateReportConfirm(): void
    {
        self::update(['confirm' => 1]);
    }
}
