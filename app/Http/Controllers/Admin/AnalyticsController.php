<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        $isSuperintendent = auth()->check() && auth()->user()->role === 'superintendent';

        // --- Bar Chart: Complaints per category ---
        $complaintsPerCategory = Category::withCount(['complaints' => function ($query) use ($isSuperintendent) {
            if ($isSuperintendent) $query->where('is_escalated', true);
        }])->get()
            ->map(fn($c) => ['name' => $c->name, 'count' => $c->complaints_count]);

        // --- Pie Chart: Status Distribution ---
        $statusCounts = Complaint::when($isSuperintendent, function($q) { $q->where('is_escalated', true); })
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $total = $statusCounts->sum();
        $resolved = $statusCounts->get('Resolved', 0);
        $resolutionRate = $total > 0 ? round(($resolved / $total) * 100, 1) : 0;

        // --- Line Graph: Complaints per day (last 30 days) ---
        $last30Days = collect();
        for ($i = 29; $i >= 0; $i--) {
            $last30Days->push(Carbon::now()->subDays($i)->format('Y-m-d'));
        }

        $complaintsByDay = Complaint::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as total')
            )
            ->when($isSuperintendent, function($q) { $q->where('is_escalated', true); })
            ->where('created_at', '>=', Carbon::now()->subDays(29)->startOfDay())
            ->groupBy('date')
            ->pluck('total', 'date');

        $lineLabels = $last30Days->map(fn($d) => Carbon::parse($d)->format('M d'));
        $lineData   = $last30Days->map(fn($d) => $complaintsByDay->get($d, 0));

        // --- Avg Resolution Time (days) ---
        $avgResolutionTime = Complaint::where('status', 'Resolved')
            ->when($isSuperintendent, function($q) { $q->where('is_escalated', true); })
            ->selectRaw('AVG(JULIANDAY(updated_at) - JULIANDAY(created_at)) as avg_days')
            ->value('avg_days');
        $avgResolutionTime = $avgResolutionTime ? round($avgResolutionTime, 1) : 'N/A';

        // --- Most common category ---
        $mostCommonCategory = $complaintsPerCategory->sortByDesc('count')->first();

        return view('admin.analytics', compact(
            'complaintsPerCategory',
            'statusCounts',
            'resolutionRate',
            'lineLabels',
            'lineData',
            'avgResolutionTime',
            'mostCommonCategory',
            'total'
        ));
    }
}
