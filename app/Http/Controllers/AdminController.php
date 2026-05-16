<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalComplaints = Complaint::count();
        $pendingComplaints = Complaint::where('status', 'Pending')->count();
        $resolvedComplaints = Complaint::where('status', 'Resolved')->count();
        $totalUsers = User::where('role', 'citizen')->count();

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

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $complaints = $query->latest()->get();

        return view('admin.complaints', compact('complaints'));
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
