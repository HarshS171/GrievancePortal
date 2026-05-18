<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $isSuperintendent = auth()->user()->role === 'superintendent';

        $totalComplaints = Complaint::when($isSuperintendent, function ($query) {
            $query->where('is_escalated', true);
        })->count();
        
        $pendingComplaints = Complaint::where('status', 'Pending')
            ->when($isSuperintendent, function ($query) {
                $query->where('is_escalated', true);
            })->count();
            
        $resolvedComplaints = Complaint::where('status', 'Resolved')
            ->when($isSuperintendent, function ($query) {
                $query->where('is_escalated', true);
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

    public function complaints(Request $request)
    {
        $query = Complaint::with(['user', 'category']);

        if (auth()->user()->role === 'superintendent') {
            $query->where('is_escalated', true);
        }

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('id', $request->search);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $complaints = $query->latest()->get();
        $categories = \App\Models\Category::all();

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
