<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Complaint;
use Carbon\Carbon;

class EscalateComplaints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'complaints:escalate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto escalate pending complaints that are older than 48 hours to superintendent officer';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $escalatedCount = Complaint::whereNotIn('status', ['Resolved', 'Rejected'])
            ->where('is_escalated', false)
            ->where('created_at', '<', Carbon::now()->subHours(48))
            ->update(['is_escalated' => true]);

        $this->info("Successfully escalated {$escalatedCount} complaints.");
    }
}
