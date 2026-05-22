<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    protected function applySuperintendentEscalationScope($query)
    {
        $query->where(function ($query) {
            $query->where('is_escalated', true)
                ->orWhere(function ($query) {
                    $query->whereNotIn('status', ['Resolved', 'Rejected'])
                        ->where('created_at', '<', Carbon::now()->subHours(48));
                });
        });
    }

    public function dashboard()
    {
        $isSuperintendent = auth()->user()->role === 'superintendent';

        $totalComplaints = Complaint::when($isSuperintendent, function ($query) {
            $this->applySuperintendentEscalationScope($query);
        })->count();
        
        $pendingComplaints = Complaint::where('status', 'Pending')
            ->when($isSuperintendent, function ($query) {
                $this->applySuperintendentEscalationScope($query);
            })->count();
            
        $resolvedComplaints = Complaint::where('status', 'Resolved')
            ->when($isSuperintendent, function ($query) {
                $this->applySuperintendentEscalationScope($query);
            })->count();
            
        $totalUsers = User::where('role', 'user')->count();

        return view('admin.dashboard',
            compact(
                'totalComplaints',
                'pendingComplaints',
                'resolvedComplaints',
                'totalUsers'
            ));
    }

    protected function applyFilters(Request $request, $query)
    {
        if ($request->search) {
            $query->where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                      ->orWhere('id', $request->search);
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
    }

    public function complaints(Request $request)
    {
        $categories = Category::all();

        if (auth()->user()->role === 'superintendent') {
            $oneStarComplaints = Complaint::with(['user', 'category', 'feedback'])
                ->whereHas('feedback', function ($query) {
                    $query->where('rating', 1);
                });

            $overdueComplaints = Complaint::with(['user', 'category'])
                ->whereNotIn('status', ['Resolved', 'Rejected'])
                ->where('created_at', '<', Carbon::now()->subHours(48));

            $this->applyFilters($request, $oneStarComplaints);
            $this->applyFilters($request, $overdueComplaints);

            $oneStarComplaints = $oneStarComplaints->latest()->get();
            $overdueComplaints = $overdueComplaints->latest()->get();

            return view('admin.complaints', compact('oneStarComplaints', 'overdueComplaints', 'categories'));
        }

        $query = Complaint::with(['user', 'category']);
        $this->applyFilters($request, $query);

        $complaints = $query->latest()->get();

        return view('admin.complaints', compact('complaints', 'categories'));
    }

    public function show(Complaint $complaint)
    {
        return view('admin.show', compact('complaint'));
    }

    public function update(Request $request, Complaint $complaint)
    {
        $request->validate([ 'status' => 'required', 'admin_remark' => 'nullable|min:5' ]);
        $complaint->update([ 'status' => $request->status, 'admin_remark' => $request->admin_remark ]);
        return redirect()->route('admin.complaints')->with('success', 'Complaint updated successfully');
    }

    public function destroy(Complaint $complaint)
    {
        $complaint->delete();
        return redirect()->route('admin.complaints')->with('success', 'Complaint deleted successfully');
    }
}
