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
        'report_response'
    ];

    protected $casts = [
        'verification_response' => 'array',
        'report_response' => 'array',
    ];
}
