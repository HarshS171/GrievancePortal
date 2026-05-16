<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $query = Complaint::where('user_id', auth()->id())->with('category');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $complaints = $query->latest()->get();

        return view('complaints.index', compact('complaints'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('complaints.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|min:10',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('complaints', 'public');
        }

        Complaint::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'status' => 'Pending'
        ]);

        return redirect()->route('complaints.index')->with('success', 'Complaint submitted successfully');
    }

    public function show(Complaint $complaint)
    {
        if ($complaint->user_id != auth()->id()) {
            abort(403);
        }
        return view('complaints.show', compact('complaint'));
    }

    public function edit(Complaint $complaint)
    {
        if ($complaint->user_id != auth()->id()) {
            abort(403);
        }

        $categories = Category::all();
        return view('complaints.edit', compact('complaint', 'categories'));
    }

    public function update(Request $request, Complaint $complaint)
    {
        if ($complaint->user_id != auth()->id()) {
            abort(403);
        }
        
        $request->validate([
            'title' => 'required|min:5',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|min:10',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $data = [
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('complaints', 'public');
        }

        $complaint->update($data);

        return redirect()->route('complaints.index')->with('success', 'Complaint updated');
    }

    public function destroy(Complaint $complaint)
    {
        if ($complaint->user_id != auth()->id()) {
            abort(403);
        }
        $complaint->delete();
        return redirect()->route('complaints.index')->with('success', 'Complaint deleted');
    }
}
