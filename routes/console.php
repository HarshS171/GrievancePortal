<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

use App\Models\Complaint;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    Complaint::whereNotIn('status', ['Resolved', 'Rejected'])
        ->where('is_escalated', false)
        ->where('created_at', '<', Carbon::now()->subHours(48))
        ->update(['is_escalated' => true]);
})->hourly();
