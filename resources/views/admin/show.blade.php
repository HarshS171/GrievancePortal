<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fade-in">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.complaints') }}" class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-slate-100 text-slate-500 hover:bg-slate-200 hover:text-slate-900 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </a>
                <div>
                    <div class="flex items-center gap-3">
                        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Complaint <span class="text-slate-400">#{{ str_pad($complaint->id, 5, '0', STR_PAD_LEFT) }}</span></h2>
                        @if($complaint->is_urgent)
                            <span style="background:rgba(239,68,68,0.12);color:#f87171;border:1px solid rgba(239,68,68,0.25);border-radius:20px;padding:3px 12px;font-size:11px;font-weight:600;letter-spacing:0.06em;margin-left:8px;display:inline-flex;align-items:center;">URGENT</span>
                        @endif
                        @if($complaint->is_escalated)
                            <span style="background:rgba(255,255,255,0.07);color:rgba(255,255,255,0.5);border:1px solid rgba(255,255,255,0.15);border-radius:20px;padding:3px 12px;font-size:11px;font-weight:600;letter-spacing:0.06em;margin-left:8px;">ESCALATED</span>
                        @endif
                        @if($complaint->status === 'Pending')
                            <span class="status-pending" style="margin-left:8px">Pending</span>
                        @elseif($complaint->status === 'In Progress')
                            <span class="status-inprogress" style="margin-left:8px">In Progress</span>
                        @elseif($complaint->status === 'Resolved')
                            <span class="status-resolved" style="margin-left:8px">Resolved</span>
                        @elseif($complaint->status === 'Rejected')
                            <span style="background:rgba(255,255,255,0.07);color:rgba(255,255,255,0.5);border:1px solid rgba(255,255,255,0.15);border-radius:20px;padding:3px 12px;font-size:11px;font-weight:600;letter-spacing:0.06em;margin-left:8px;">Rejected</span>
                        @else
                            <span style="background:rgba(255,255,255,0.07);color:rgba(255,255,255,0.5);border:1px solid rgba(255,255,255,0.15);border-radius:20px;padding:3px 12px;font-size:11px;font-weight:600;letter-spacing:0.06em;margin-left:8px;">{{ $complaint->status }}</span>
                        @endif
                    </div>
                    <p class="mt-2 text-sm text-slate-500 flex items-center gap-1.5 font-medium">
                        Submitted by
                        @if($complaint->is_anonymous)
                            <span class="italic text-slate-400 font-normal">Anonymous</span>
                            <span class="ml-1 px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200 uppercase tracking-wider">🕵️ Anonymous</span>
                        @else
                            <span class="font-bold text-slate-700">{{ $complaint->user->name }}</span>
                        @endif
                        on {{ $complaint->created_at->format('M d, Y \a\t h:i A') }}
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 animate-slide-up">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Column: Details -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="glass-card p-0">
                        <div style="padding:16px;border-bottom:1px solid rgba(255,255,255,0.08);display:flex;flex-direction:column;gap:8px;">
                            <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;">
                                <h3 style="font-size:20px;font-weight:600;color:#e8f4ff;margin:0;flex:1;">{{ $complaint->title }}</h3>
                                <div style="flex-shrink:0">
                                    <span style="display:inline-flex;align-items:center;gap:8px;padding:8px;border-radius:10px;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.05);color:#93c5fd">{{ $complaint->category->name ?? 'Uncategorized' }}</span>
                                </div>
                            </div>
                        </div>
                        <div style="padding:18px;">
                            <div style="color:rgba(255,255,255,0.65);line-height:1.6;font-size:14px"> <p class="whitespace-pre-line">{{ $complaint->description }}</p> </div>
                        </div>
                        @if($complaint->category && ($complaint->category->officer_name || $complaint->category->officer_phone))
                        <div style="padding:12px 18px;border-top:1px solid rgba(255,255,255,0.06);display:flex;gap:12px;align-items:center;color:rgba(255,255,255,0.85)">
                            <div style="font-weight:600;margin-right:8px">Assigned Officer:</div>
                            @if($complaint->category->officer_name)
                            <div style="display:flex;align-items:center;gap:8px;font-size:14px;color:rgba(255,255,255,0.8)">
                                {{ $complaint->category->officer_name }}
                            </div>
                            @endif
                            @if($complaint->category->officer_phone)
                            <div style="display:flex;align-items:center;gap:8px;font-size:14px;color:rgba(255,255,255,0.7)">
                                {{ $complaint->category->officer_phone }}
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>

                    <!-- Address and Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="glass-card">
                            <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px;">
                                <div style="width:32px;height:32px;border-radius:8px;background:rgba(59,130,246,0.15);display:flex;align-items:center;justify-content:center;color:#93c5fd">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                </div>
                                <h4 style="font-size:16px;font-weight:600;color:#e8f4ff;margin:0">Location Information</h4>
                            </div>
                            <div style="display:flex;flex-direction:column;gap:10px">
                                <div style="display:flex;justify-content:space-between;border-top:1px solid rgba(255,255,255,0.06);padding:10px 0;">
                                    <dt style="color:rgba(255,255,255,0.4)">Block</dt>
                                    <dd style="font-weight:700;color:#e8f4ff">{{ $complaint->block ?? 'N/A' }}</dd>
                                </div>
                                <div style="display:flex;justify-content:space-between;border-top:1px solid rgba(255,255,255,0.06);padding:10px 0;">
                                    <dt style="color:rgba(255,255,255,0.4)">Floor</dt>
                                    <dd style="font-weight:700;color:#e8f4ff">{{ $complaint->floor ?? 'N/A' }}</dd>
                                </div>
                                <div style="display:flex;justify-content:space-between;border-top:1px solid rgba(255,255,255,0.06);padding:10px 0;">
                                    <dt style="color:rgba(255,255,255,0.4)">Room Number</dt>
                                    <dd style="font-weight:700;color:#e8f4ff">{{ $complaint->room_number ?? 'N/A' }}</dd>
                                </div>
                                <div style="padding-top:8px;border-top:1px solid rgba(255,255,255,0.06);">
                                    <dt style="color:rgba(255,255,255,0.6);margin-bottom:6px">Area / Landmark</dt>
                                    <dd style="font-size:14px;font-weight:700;color:#e8f4ff">{{ $complaint->area_location ?? 'N/A' }}</dd>
                                </div>
                            </div>
                        </div>

                        <div class="glass-card">
                            <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px;">
                                <div style="width:32px;height:32px;border-radius:8px;background:rgba(52,211,153,0.12);display:flex;align-items:center;justify-content:center;color:#34d399">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                </div>
                                <h4 style="font-size:16px;font-weight:600;color:#e8f4ff;margin:0">Contact Details</h4>
                            </div>
                            <div style="display:flex;flex-direction:column;gap:10px">
                                <div style="display:flex;justify-content:space-between;border-top:1px solid rgba(255,255,255,0.06);padding:10px 0;">
                                    <dt style="color:rgba(255,255,255,0.4)">Contact No</dt>
                                    <dd style="font-weight:700;color:#e8f4ff">{{ $complaint->contact_number ?? 'N/A' }}</dd>
                                </div>
                                <div style="display:flex;justify-content:space-between;border-top:1px solid rgba(255,255,255,0.06);padding:10px 0;">
                                    <dt style="color:rgba(255,255,255,0.4)">Availability Date</dt>
                                    <dd style="font-weight:700;color:#e8f4ff">{{ $complaint->availability_date ? \Carbon\Carbon::parse($complaint->availability_date)->format('M d, Y') : 'N/A' }}</dd>
                                </div>
                                <div style="display:flex;justify-content:space-between;border-top:1px solid rgba(255,255,255,0.06);padding:10px 0;">
                                    <dt style="color:rgba(255,255,255,0.4)">Preferred Time</dt>
                                    <dd style="font-weight:700;color:#e8f4ff">{{ $complaint->preferred_time_slot ?? 'N/A' }}</dd>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($complaint->image)
                    <div class="card bg-white shadow-sm p-8 border-slate-200/60">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-slate-50 text-slate-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <h4 class="text-lg font-bold text-slate-900 tracking-tight">Attached Media</h4>
                        </div>
                        <div class="rounded-xl overflow-hidden border-2 border-dashed border-slate-200 bg-slate-50 flex justify-center p-2 group hover:border-portal-400 transition-colors">
                            <a href="{{ asset('storage/' . $complaint->image) }}" target="_blank" class="relative block rounded-lg overflow-hidden w-full">
                                <img src="{{ asset('storage/' . $complaint->image) }}" alt="Complaint Attachment" class="w-full h-auto object-contain max-h-[500px] rounded-lg">
                                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="btn bg-white text-slate-900 shadow-xl pointer-events-none">View Full Screen</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endif

                    <!-- Citizen Feedback Section -->
                    @if($complaint->feedback)
                    <div class="rounded-2xl p-8 bg-amber-50/50 border border-amber-200/50 shadow-sm">
                        <div class="flex items-start gap-5">
                            <div class="shrink-0">
                                <div class="w-14 h-14 rounded-full bg-gradient-to-br from-amber-400 to-amber-500 flex items-center justify-center text-white shadow-lg shadow-amber-200">
                                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-3 gap-2">
                                    <h4 class="text-lg font-extrabold text-amber-950">Citizen Feedback</h4>
                                    <div class="flex items-center gap-1 bg-white px-3 py-1.5 rounded-lg border border-amber-100 shadow-sm">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-5 h-5 {{ $i <= $complaint->feedback->rating ? 'text-amber-400' : 'text-slate-200' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @endfor
                                        <span class="ml-2 text-sm font-extrabold text-amber-600">{{ $complaint->feedback->rating }}.0</span>
                                    </div>
                                </div>
                                <div class="bg-white rounded-xl p-5 border border-amber-100 shadow-sm">
                                    <p class="text-amber-900 leading-relaxed italic">"{{ $complaint->feedback->comment }}"</p>
                                </div>
                                @if($complaint->feedback->work_image)
                                    <div class="mt-4 rounded-xl overflow-hidden border border-slate-200 bg-slate-50 shadow-sm">
                                        <img src="{{ asset('storage/' . $complaint->feedback->work_image) }}" alt="Work Image" class="w-full h-auto object-contain max-h-[420px]">
                                    </div>
                                @endif
                                <p class="mt-3 text-xs font-semibold text-amber-600/70">Submitted {{ $complaint->feedback->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                    @elseif($complaint->status === 'Resolved')
                    <div class="rounded-2xl p-8 bg-slate-50 border border-dashed border-slate-200 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center mb-3">
                            <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <p class="text-slate-500 font-medium italic">Citizen has not submitted feedback yet.</p>
                    </div>
                    @endif
                </div>

                <!-- Right Column: Admin Actions -->
                <div class="space-y-6">
                    <div>
                        <div class="glass-card" style="position:sticky;top:24px;">
                            <h3 style="font-size:16px;font-weight:600;color:#e8f4ff;margin:0 0 12px 0;padding-bottom:8px;border-bottom:1px solid rgba(255,255,255,0.06);">Update Status</h3>
                            <form action="{{ route('admin.complaints.update', $complaint) }}" method="POST" class="space-y-6">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label for="status" style="display:block;font-size:13px;font-weight:600;color:rgba(255,255,255,0.75);margin-bottom:6px">Current Status</label>
                                    <select name="status" id="status" class="form-input">
                                        <option value="Pending" {{ $complaint->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="In Progress" {{ $complaint->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="Resolved" {{ $complaint->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                        <option value="Rejected" {{ $complaint->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="admin_remark" style="display:block;font-size:13px;font-weight:600;color:rgba(255,255,255,0.75);margin-bottom:6px">Admin Remark (Optional)</label>
                                    <textarea name="admin_remark" id="admin_remark" rows="5" class="form-input @error('admin_remark') border-rose-300 ring-rose-200 @enderror" placeholder="Enter resolution details or remarks sent to citizen...">{{ $complaint->admin_remark }}</textarea>
                                    @error('admin_remark')
                                        <p class="mt-1.5 text-sm font-medium text-rose-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="btn-primary w-full py-3">Save Changes</button>
                            </form>
                        </div>

                        <div class="glass-card" style="margin-top:12px;background:rgba(239,68,68,0.06);border:1px solid rgba(239,68,68,0.25);">
                            <div style="display:flex;align-items:center;gap:12px;margin-bottom:8px;">
                                <div style="width:36px;height:36px;border-radius:50%;background:rgba(239,68,68,0.12);display:flex;align-items:center;justify-content:center;color:#f87171">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <h3 style="font-size:14px;font-weight:600;color:#f87171;margin:0">Danger Zone</h3>
                            </div>
                            <p style="color:rgba(248,113,113,0.9);margin-bottom:12px">Permanently delete this complaint from the system. This action cannot be undone and will remove all associated data.</p>
                            <form action="{{ route('admin.complaints.destroy', $complaint) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this complaint? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="width:100%;padding:10px;border-radius:8px;background:rgba(239,68,68,0.12);color:#f87171;border:1px solid rgba(239,68,68,0.25);font-weight:600">Delete Complaint</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>