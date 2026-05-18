<x-app-layout>
    <x-slot name="header">
        <div class="animate-fade-in">
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Submit a New Complaint</h2>
            <p class="mt-2 text-sm text-slate-500">Provide details about your grievance below to help us serve you better.</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 animate-slide-up">
            <div class="card bg-white p-8 md:p-10 shadow-xl shadow-slate-200/40 border-0 ring-1 ring-slate-100">
                <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                    @csrf
                    
                    <!-- Basic Details -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">Basic Details</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2 group">
                                <label for="title" class="form-label group-focus-within:text-indigo-600 transition-colors">Title</label>
                                <input type="text" name="title" id="title" class="form-input @error('title') border-rose-300 ring-rose-200 @enderror" value="{{ old('title') }}" required placeholder="Brief summary of your grievance">
                                @error('title') <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2 group">
                                <label for="category_id" class="form-label group-focus-within:text-indigo-600 transition-colors">Category</label>
                                <select name="category_id" id="category_id" class="form-select @error('category_id') border-rose-300 ring-rose-200 @enderror" required>
                                    <option value="" disabled selected>Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2 group">
                                <label for="description" class="form-label group-focus-within:text-indigo-600 transition-colors">Complaint Description</label>
                                <textarea name="description" id="description" rows="5" class="form-textarea @error('description') border-rose-300 ring-rose-200 @enderror" required placeholder="Describe your issue in detail...">{{ old('description') }}</textarea>
                                @error('description') <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Address & Location Details -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">Location Details</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="group">
                                <label for="block" class="form-label group-focus-within:text-indigo-600 transition-colors">Block</label>
                                <input type="text" name="block" id="block" class="form-input @error('block') border-rose-300 @enderror" value="{{ old('block') }}" placeholder="e.g. Block A">
                                @error('block') <p class="mt-1.5 text-sm text-rose-500">{{ $message }}</p> @enderror
                            </div>
                            <div class="group">
                                <label for="floor" class="form-label group-focus-within:text-indigo-600 transition-colors">Floor</label>
                                <input type="text" name="floor" id="floor" class="form-input @error('floor') border-rose-300 @enderror" value="{{ old('floor') }}" placeholder="e.g. 2nd Floor">
                                @error('floor') <p class="mt-1.5 text-sm text-rose-500">{{ $message }}</p> @enderror
                            </div>
                            <div class="group">
                                <label for="room_number" class="form-label group-focus-within:text-indigo-600 transition-colors">Room Number</label>
                                <input type="text" name="room_number" id="room_number" class="form-input @error('room_number') border-rose-300 @enderror" value="{{ old('room_number') }}" placeholder="e.g. 204">
                                @error('room_number') <p class="mt-1.5 text-sm text-rose-500">{{ $message }}</p> @enderror
                            </div>
                            <div class="md:col-span-3 group">
                                <label for="area_location" class="form-label group-focus-within:text-indigo-600 transition-colors">Area/Location <span class="text-rose-500">*</span></label>
                                <input type="text" name="area_location" id="area_location" class="form-input @error('area_location') border-rose-300 ring-rose-200 @enderror" value="{{ old('area_location') }}" placeholder="Detailed location or landmark" required>
                                @error('area_location') <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Contact & Availability -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">Contact & Availability</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="group">
                                <label for="contact_number" class="form-label group-focus-within:text-indigo-600 transition-colors">Contact Number <span class="text-rose-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    </div>
                                    <input type="tel" name="contact_number" id="contact_number" class="form-input pl-10 @error('contact_number') border-rose-300 ring-rose-200 @enderror" value="{{ old('contact_number') }}" placeholder="10-digit number" pattern="[0-9]{10}" maxlength="10" minlength="10" required>
                                </div>
                                @error('contact_number')
                                    <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>
                                @else
                                    <p class="mt-1.5 text-xs font-medium text-slate-400">Must be exactly 10 digits</p>
                                @enderror
                            </div>
                            <div class="group">
                                <label for="availability_date" class="form-label group-focus-within:text-indigo-600 transition-colors">Availability Date <span class="text-rose-500">*</span></label>
                                <input type="date" name="availability_date" id="availability_date" class="form-input @error('availability_date') border-rose-300 ring-rose-200 @enderror" value="{{ old('availability_date') }}" min="{{ date('Y-m-d') }}" required>
                                @error('availability_date') <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
                            </div>
                            <div class="group">
                                <label for="preferred_time_slot" class="form-label group-focus-within:text-indigo-600 transition-colors">Preferred Visit Time <span class="text-rose-500">*</span></label>
                                <select name="preferred_time_slot" id="preferred_time_slot" class="form-select @error('preferred_time_slot') border-rose-300 ring-rose-200 @enderror" required>
                                    <option value="" disabled selected>Select a time slot</option>
                                    <option value="08:00 AM - 10:00 AM" {{ old('preferred_time_slot') == '08:00 AM - 10:00 AM' ? 'selected' : '' }}>08:00 AM - 10:00 AM</option>
                                    <option value="10:00 AM - 12:00 PM" {{ old('preferred_time_slot') == '10:00 AM - 12:00 PM' ? 'selected' : '' }}>10:00 AM - 12:00 PM</option>
                                    <option value="12:00 PM - 02:00 PM" {{ old('preferred_time_slot') == '12:00 PM - 02:00 PM' ? 'selected' : '' }}>12:00 PM - 02:00 PM</option>
                                    <option value="02:00 PM - 04:00 PM" {{ old('preferred_time_slot') == '02:00 PM - 04:00 PM' ? 'selected' : '' }}>02:00 PM - 04:00 PM</option>
                                    <option value="04:00 PM - 06:00 PM" {{ old('preferred_time_slot') == '04:00 PM - 06:00 PM' ? 'selected' : '' }}>04:00 PM - 06:00 PM</option>
                                </select>
                                @error('preferred_time_slot') <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Additional Options -->
                    <div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Urgent -->
                            <label class="relative flex items-start gap-4 p-5 rounded-2xl border-2 border-slate-100 bg-white hover:border-rose-200 hover:bg-rose-50/30 cursor-pointer transition-all has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50/50 group">
                                <div class="flex items-center h-5 mt-1">
                                    <input type="checkbox" name="is_urgent" id="is_urgent" value="1" class="h-5 w-5 text-rose-600 border-slate-300 rounded focus:ring-rose-500 transition-colors" {{ old('is_urgent') ? 'checked' : '' }}>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <div class="w-6 h-6 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                        </div>
                                        <span class="text-sm font-bold text-slate-900 group-hover:text-rose-700 transition-colors">Mark as Urgent</span>
                                    </div>
                                    <p class="text-xs font-medium text-slate-500 leading-relaxed">Select this only for critical issues requiring immediate administrative attention.</p>
                                </div>
                            </label>

                            <!-- Anonymous -->
                            <label class="relative flex items-start gap-4 p-5 rounded-2xl border-2 border-slate-100 bg-white hover:border-slate-200 hover:bg-slate-50 cursor-pointer transition-all has-[:checked]:border-slate-500 has-[:checked]:bg-slate-50 group">
                                <div class="flex items-center h-5 mt-1">
                                    <input type="checkbox" name="is_anonymous" id="is_anonymous" value="1" class="h-5 w-5 text-slate-600 border-slate-300 rounded focus:ring-slate-500 transition-colors" {{ old('is_anonymous') ? 'checked' : '' }}>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <div class="w-6 h-6 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </div>
                                        <span class="text-sm font-bold text-slate-900 group-hover:text-slate-700 transition-colors">Submit Anonymously</span>
                                    </div>
                                    <p class="text-xs font-medium text-slate-500 leading-relaxed">Your identity will be hidden from administrators reviewing this complaint.</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div>
                        <label for="image" class="form-label">Image Upload (Optional)</label>
                        <div class="mt-2 flex justify-center px-6 pt-8 pb-8 border-2 border-slate-200 border-dashed rounded-2xl bg-slate-50/50 hover:bg-indigo-50/30 hover:border-indigo-400 transition-all group">
                            <div class="space-y-2 text-center">
                                <div class="mx-auto w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-sm border border-slate-100 group-hover:scale-110 transition-transform mb-4">
                                    <svg class="h-8 w-8 text-indigo-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="flex text-sm text-slate-600 justify-center">
                                    <label for="image" class="relative cursor-pointer bg-transparent rounded-md font-bold text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Click to upload</span>
                                        <input id="image" name="image" type="file" class="sr-only" accept="image/jpeg, image/png, image/jpg">
                                    </label>
                                    <p class="pl-1 font-medium">or drag and drop</p>
                                </div>
                                <p class="text-xs font-semibold text-slate-400">PNG, JPG up to 2MB</p>
                            </div>
                        </div>
                        @error('image') <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-8 border-t border-slate-100">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary px-6">Cancel</a>
                        <button type="submit" class="btn btn-primary px-8 py-3 text-base shadow-lg shadow-indigo-200">
                            Submit Complaint
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>