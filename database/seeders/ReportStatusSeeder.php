<?php

namespace Database\Seeders;

use App\Models\ReportStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportStatusSeeder extends Seeder
{
    public function run(): void
    {
        ReportStatus::create([
            'job_id' => 'job_0',
            'verification_response' => null,
            'report_response' => null,
            'confirm' => false,
        ]);

        ReportStatus::create([
            'job_id' => 'job_1',
            'verification_response' => json_encode([
                'id' => 'ver_1',
                'status' => 'completed',
                'timestamp' => '2024-09-07T12:00:00Z'
            ]),
            'report_response' => null,
            'confirm' => false,
        ]);

        ReportStatus::create([
            'job_id' => 'job_2',
            'verification_response' => json_encode([
                'id' => 'ver_2',
                'status' => 'pending',
                'timestamp' => '2024-09-07T13:00:00Z'
            ]),
            'report_response' => json_encode([
                'id' => 'rep_2',
                'total_revenue' => 2000,
                'currency' => 'EUR'
            ]),
            'confirm' => false,
        ]);

        ReportStatus::create([
            'job_id' => 'job_3',
            'verification_response' => json_encode([
                'id' => 'ver_3',
                'status' => 'failed',
                'timestamp' => '2024-09-07T14:00:00Z'
            ]),
            'report_response' => json_encode([
                'id' => 'rep_3',
                'total_revenue' => 3000,
                'currency' => 'GBP'
            ]),
            'confirm' => true,
        ]);
    }
}
