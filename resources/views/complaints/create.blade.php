<x-app-layout>
    <x-slot name="header">
        <div class="animate-fade-in">
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Submit a New Complaint</h2>
            <p class="mt-2 text-sm text-slate-500">Provide details about your grievance below to help us serve you better.</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 animate-slide-up">
            <div class="glass-card" x-data="{ step: {{ old('form_step', 1) }}, fileName: 'No file chosen' }" style="max-width:680px;margin:0 auto;">
                <div class="mb-8 grid grid-cols-3 gap-4 text-sm uppercase tracking-[0.24em] text-slate-500">
                    <button type="button" class="rounded-2xl px-4 py-3 transition-all duration-200" :class="step === 1 ? 'bg-portal-50 text-portal-900 shadow-sm' : 'bg-slate-100 hover:bg-slate-200'" @click="step = 1">Overview</button>
                    <button type="button" class="rounded-2xl px-4 py-3 transition-all duration-200" :class="step === 2 ? 'bg-portal-50 text-portal-900 shadow-sm' : 'bg-slate-100 hover:bg-slate-200'" @click="step = 2">Location</button>
                    <button type="button" class="rounded-2xl px-4 py-3 transition-all duration-200" :class="step === 3 ? 'bg-portal-50 text-portal-900 shadow-sm' : 'bg-slate-100 hover:bg-slate-200'" @click="step = 3">Contact</button>
                </div>

                <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    <input type="hidden" name="form_step" x-bind:value="step">

                    <div x-show="step === 1" x-cloak class="space-y-6">
                            <div style="display:flex;align-items:center;gap:10px;margin-bottom:1.2rem;padding-bottom:10px;border-bottom:1px solid rgba(255,255,255,0.08);">
                                <div style="width:32px;height:32px;background:rgba(59,130,246,0.15);border:1px solid rgba(59,130,246,0.25);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#93c5fd"> <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg></div>
                                <div>
                                    <h3 style="font-size:16px;font-weight:600;color:#e8f4ff;margin:0;">Complaint overview</h3>
                                    <p style="font-size:13px;color:rgba(255,255,255,0.45);margin-top:4px">Start with the essential details so the review team can understand your case quickly.</p>
                                </div>
                            </div>

                        <div class="space-y-6">
                            <div class="group">
                                <label for="title" class="form-label">Complaint title</label>
                                <input type="text" name="title" id="title" class="form-input @error('title') border-rose-300 ring-rose-200 @enderror" value="{{ old('title') }}" required placeholder="Brief summary of your grievance">
                                @error('title') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                            </div>

                            <div class="group">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id" class="form-input @error('category_id') border-rose-300 ring-rose-200 @enderror" required style="padding:10px 14px;">
                                    <option value="" disabled>Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                            </div>

                            <div class="group">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" rows="6" class="form-textarea @error('description') border-rose-300 ring-rose-200 @enderror" required placeholder="Describe the issue in detail...">{{ old('description') }}</textarea>
                                @error('description') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="group" style="display:block;border-radius:10px;padding:12px 14px;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);cursor:pointer;">
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-rose-100 text-rose-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    </span>
                                    <div>
                                        <p style="font-size:13px;font-weight:600;color:#e8f4ff;margin:0;">Mark as urgent</p>
                                        <p style="font-size:12px;color:rgba(255,255,255,0.45);margin-top:4px">Request faster processing for urgent matters.</p>
                                    </div>
                                </div>
                                <input type="checkbox" name="is_urgent" id="is_urgent" value="1" class="h-5 w-5 text-rose-600 border-slate-300 rounded focus:ring-rose-500" {{ old('is_urgent') ? 'checked' : '' }}>
                            </label>
                            <label class="group" style="display:block;border-radius:10px;padding:12px 14px;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);cursor:pointer;">
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-100 text-slate-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </span>
                                    <div>
                                        <p style="font-size:13px;font-weight:600;color:#e8f4ff;margin:0;">Submit anonymously</p>
                                        <p style="font-size:12px;color:rgba(255,255,255,0.45);margin-top:4px">Your identity will remain hidden during review.</p>
                                    </div>
                                </div>
                                <input type="checkbox" name="is_anonymous" id="is_anonymous" value="1" class="h-5 w-5 text-slate-600 border-slate-300 rounded focus:ring-slate-500" {{ old('is_anonymous') ? 'checked' : '' }}>
                            </label>
                        </div>
                    </div>

                    <div x-show="step === 2" x-cloak class="space-y-6">
                        <div style="display:flex;align-items:center;gap:10px;margin-bottom:1.2rem;padding-bottom:10px;border-bottom:1px solid rgba(255,255,255,0.08);">
                            <div style="width:32px;height:32px;background:rgba(59,130,246,0.15);border:1px solid rgba(59,130,246,0.25);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#93c5fd"> <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"/></svg></div>
                            <div>
                                <h3 style="font-size:16px;font-weight:600;color:#e8f4ff;margin:0;">Location details</h3>
                                <p style="font-size:13px;color:rgba(255,255,255,0.45);margin-top:4px">Help us route your complaint by providing the exact location.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="group">
                                <label for="block" class="form-label">Block</label>
                                <input type="text" name="block" id="block" class="form-input @error('block') border-rose-300 @enderror" value="{{ old('block') }}" placeholder="e.g. Block A">
                                @error('block') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                            </div>
                            <div class="group">
                                <label for="floor" class="form-label">Floor</label>
                                <input type="text" name="floor" id="floor" class="form-input @error('floor') border-rose-300 @enderror" value="{{ old('floor') }}" placeholder="e.g. 2nd Floor">
                                @error('floor') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                            </div>
                            <div class="group">
                                <label for="room_number" class="form-label">Room number</label>
                                <input type="text" name="room_number" id="room_number" class="form-input @error('room_number') border-rose-300 @enderror" value="{{ old('room_number') }}" placeholder="e.g. 204">
                                @error('room_number') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                            </div>
                            <div class="md:col-span-3 group">
                                <label for="area_location" class="form-label">Area / Landmark <span class="text-rose-500">*</span></label>
                                <input type="text" name="area_location" id="area_location" class="form-input @error('area_location') border-rose-300 ring-rose-200 @enderror" value="{{ old('area_location') }}" placeholder="Detailed location or landmark" required>
                                @error('area_location') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div x-show="step === 3" x-cloak class="space-y-6">
                        <div style="display:flex;align-items:center;gap:10px;margin-bottom:1.2rem;padding-bottom:10px;border-bottom:1px solid rgba(255,255,255,0.08);">
                            <div style="width:32px;height:32px;background:rgba(59,130,246,0.15);border:1px solid rgba(59,130,246,0.25);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#93c5fd"> <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 2a4 4 0 014 4v10a4 4 0 01-4 4H8l-4 4V6a4 4 0 014-4h8z"/></svg></div>
                            <div>
                                <h3 style="font-size:16px;font-weight:600;color:#e8f4ff;margin:0;">Contact details</h3>
                                <p style="font-size:13px;color:rgba(255,255,255,0.45);margin-top:4px">Add your preferred contact and optional evidence to speed up resolution.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="group">
                                <label for="contact_number" class="form-label">Contact number</label>
                                <input type="tel" name="contact_number" id="contact_number" class="form-input @error('contact_number') border-rose-300 ring-rose-200 @enderror" value="{{ old('contact_number') }}" placeholder="10-digit number" pattern="[0-9]{10}" maxlength="10" minlength="10" required>
                                @error('contact_number') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                            </div>
                            <div class="group">
                                <label for="availability_date" class="form-label">Availability date</label>
                                <input type="date" name="availability_date" id="availability_date" class="form-input @error('availability_date') border-rose-300 ring-rose-200 @enderror" value="{{ old('availability_date') }}" min="{{ date('Y-m-d') }}" required>
                                @error('availability_date') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                            </div>
                            <div class="group">
                                <label for="preferred_time_slot" class="form-label">Preferred time slot</label>
                                <select name="preferred_time_slot" id="preferred_time_slot" class="form-select @error('preferred_time_slot') border-rose-300 ring-rose-200 @enderror" required>
                                    <option value="" disabled>Select a slot</option>
                                    <option value="08:00 AM - 10:00 AM" {{ old('preferred_time_slot') == '08:00 AM - 10:00 AM' ? 'selected' : '' }}>08:00 AM - 10:00 AM</option>
                                    <option value="10:00 AM - 12:00 PM" {{ old('preferred_time_slot') == '10:00 AM - 12:00 PM' ? 'selected' : '' }}>10:00 AM - 12:00 PM</option>
                                    <option value="12:00 PM - 02:00 PM" {{ old('preferred_time_slot') == '12:00 PM - 02:00 PM' ? 'selected' : '' }}>12:00 PM - 02:00 PM</option>
                                    <option value="02:00 PM - 04:00 PM" {{ old('preferred_time_slot') == '02:00 PM - 04:00 PM' ? 'selected' : '' }}>02:00 PM - 04:00 PM</option>
                                    <option value="04:00 PM - 06:00 PM" {{ old('preferred_time_slot') == '04:00 PM - 06:00 PM' ? 'selected' : '' }}>04:00 PM - 06:00 PM</option>
                                </select>
                                @error('preferred_time_slot') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label for="image" class="form-label">Evidence image (optional)</label>
                            <div class="mt-2" style="border:2px dashed rgba(255,255,255,0.15);border-radius:10px;padding:2.5rem;text-align:center;background:rgba(255,255,255,0.03);cursor:pointer;transition:all .2s ease;" @mouseover="$el.style.borderColor='rgba(59,130,246,0.4)'; $el.style.background='rgba(59,130,246,0.05)'" @mouseout="$el.style.borderColor='rgba(255,255,255,0.15)'; $el.style.background='rgba(255,255,255,0.03)'" @click="$refs.imageInput.click()">
                                <div style="font-size:28px;color:rgba(255,255,255,0.2);margin-bottom:8px;">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4-4m0 0l4 4m-4-4v12"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 8V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-2"/></svg>
                                </div>
                                <div style="color:#3b82f6;font-size:13px;">Click to upload</div>
                                <p style="color:rgba(255,255,255,0.3);font-size:12px;margin-top:6px;">PNG, JPG or JPEG. Max 2MB.</p>
                                <p class="mt-3 text-xs text-slate-400" x-text="fileName" style="margin-top:8px;color:rgba(255,255,255,0.3);"></p>
                            </div>
                            <input id="image" x-ref="imageInput" name="image" type="file" class="hidden" accept="image/jpeg, image/png, image/jpg" x-on:change="fileName = $event.target.files.length ? $event.target.files[0].name : 'No file chosen'">
                            @error('image') <p class="mt-2 text-sm text-rose-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex flex-col gap-4 pt-6 border-t border-slate-100 sm:flex-row sm:justify-between sm:items-center">
                        <button type="button" @click="step = Math.max(step - 1, 1)" x-show="step > 1" x-cloak class="btn btn-secondary px-6">Back</button>
                        <div class="flex flex-col gap-3 sm:flex-row">
                            <button type="button" @click="step = Math.min(step + 1, 3)" x-show="step < 3" x-cloak class="btn btn-primary px-6">Continue</button>
                            <button type="submit" x-show="step === 3" x-cloak class="btn btn-primary px-8 py-3 shadow-lg shadow-portal-200">
                                Submit Complaint
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>