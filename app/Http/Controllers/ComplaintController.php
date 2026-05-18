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
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'block' => 'nullable|string|max:50',
            'floor' => 'nullable|string|max:50',
            'room_number' => 'nullable|string|max:50',
            'area_location' => 'required|string|max:255',
            'contact_number' => ['required', 'regex:/^[0-9]{10}$/'],
            'availability_date' => 'required|date|after_or_equal:today',
            'preferred_time_slot' => 'required|string'
        ], [
            'contact_number.required' => 'Contact number is required.',
            'contact_number.regex' => 'Contact number must be exactly 10 digits (numbers only).',
            'availability_date.after_or_equal' => 'Availability date cannot be a past date.',
            'preferred_time_slot.required' => 'Please select a preferred visit time slot.',
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
            'status' => 'Pending',
            'block' => $request->block,
            'floor' => $request->floor,
            'room_number' => $request->room_number,
            'area_location' => $request->area_location,
            'contact_number' => $request->contact_number,
            'preferred_time_slot' => $request->preferred_time_slot,
            'availability_date' => $request->availability_date,
            'is_urgent' => $request->has('is_urgent') ? true : false,
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
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'contact_number' => ['nullable', 'regex:/^[0-9]{10}$/'],
            'availability_date' => 'nullable|date',
            'preferred_time_slot' => 'nullable|string'
        ], [
            'contact_number.regex' => 'Contact number must be exactly 10 digits (numbers only).',
        ]);

        $data = [
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'block' => $request->block,
            'floor' => $request->floor,
            'room_number' => $request->room_number,
            'area_location' => $request->area_location,
            'contact_number' => $request->contact_number,
            'preferred_time_slot' => $request->preferred_time_slot,
            'availability_date' => $request->availability_date,
            'is_urgent' => $request->has('is_urgent') ? true : false,
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
