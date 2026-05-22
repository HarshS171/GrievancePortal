<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\Feedback;


class FeedbackController extends Controller
{
    public function create(Complaint $complaint)
    {
        if ($complaint->status != 'Resolved' || $complaint->feedback) {
            return redirect()->route('complaints.index')->with('error', 'Feedback is only allowed once for resolved complaints.');
        }
        return view('feedback.create', compact('complaint'));
    }

    public function store(Request $request, Complaint $complaint)
    {
        if ($complaint->status != 'Resolved' || $complaint->feedback) {
            return redirect()->route('complaints.index')->with('error', 'Feedback is only allowed once for resolved complaints.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|min:5',
            'work_image' => 'nullable|image|max:4096'
        ]);

        $feedbackData = [
            'complaint_id' => $complaint->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ];

        if ($request->hasFile('work_image')) {
            $feedbackData['work_image'] = $request->file('work_image')->store('feedback', 'public');
        }

        $feedback = Feedback::create($feedbackData);

        if ($feedback->rating === 1) {
            $complaint->update(['is_escalated' => true]);
        }

        return redirect()->route('complaints.index')->with('success', 'Feedback submitted successfully');
    }
}
