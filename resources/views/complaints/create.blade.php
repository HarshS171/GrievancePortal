<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900">Submit a New Complaint</h2>
        <p class="mt-1 text-sm text-gray-500">Provide details about your grievance below.</p>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="card bg-white p-8">
                <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    
                    <!-- Basic Details -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Basic Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-input" value="{{ old('title') }}" required placeholder="Brief summary of your grievance">
                                @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id" class="form-input" required>
                                    <option value="" disabled selected>Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="description" class="form-label">Complaint Description</label>
                                <textarea name="description" id="description" rows="4" class="form-input" required placeholder="Describe your issue in detail...">{{ old('description') }}</textarea>
                                @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Address & Location Details -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Full Address Section</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="block" class="form-label">Block</label>
                                <input type="text" name="block" id="block" class="form-input @error('block') border-red-500 @enderror" value="{{ old('block') }}" placeholder="e.g. Block A">
                                @error('block') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="floor" class="form-label">Floor</label>
                                <input type="text" name="floor" id="floor" class="form-input @error('floor') border-red-500 @enderror" value="{{ old('floor') }}" placeholder="e.g. 2nd Floor">
                                @error('floor') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="room_number" class="form-label">Room Number</label>
                                <input type="text" name="room_number" id="room_number" class="form-input @error('room_number') border-red-500 @enderror" value="{{ old('room_number') }}" placeholder="e.g. 204">
                                @error('room_number') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div class="md:col-span-3">
                                <label for="area_location" class="form-label">Area/Location <span class="text-red-500">*</span></label>
                                <input type="text" name="area_location" id="area_location" class="form-input @error('area_location') border-red-500 @enderror" value="{{ old('area_location') }}" placeholder="Detailed location or landmark" required>
                                @error('area_location') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Contact & Availability -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Contact & Availability</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="contact_number" class="form-label">Contact Number <span class="text-red-500">*</span></label>
                                <input type="tel" name="contact_number" id="contact_number" class="form-input @error('contact_number') border-red-500 @enderror" value="{{ old('contact_number') }}" placeholder="10-digit mobile number" pattern="[0-9]{10}" maxlength="10" minlength="10" required>
                                @error('contact_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @else
                                    <p class="mt-1 text-xs text-gray-400">Must be exactly 10 digits (e.g. 9876543210)</p>
                                @enderror
                            </div>
                            <div>
                                <label for="availability_date" class="form-label">Availability Date <span class="text-red-500">*</span></label>
                                <input type="date" name="availability_date" id="availability_date" class="form-input @error('availability_date') border-red-500 @enderror" value="{{ old('availability_date') }}" min="{{ date('Y-m-d') }}" required>
                                @error('availability_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="preferred_time_slot" class="form-label">Preferred Visit Time <span class="text-red-500">*</span></label>
                                <select name="preferred_time_slot" id="preferred_time_slot" class="form-input @error('preferred_time_slot') border-red-500 @enderror" required>
                                    <option value="" disabled selected>Select a time slot</option>
                                    <option value="08:00 AM - 10:00 AM" {{ old('preferred_time_slot') == '08:00 AM - 10:00 AM' ? 'selected' : '' }}>08:00 AM - 10:00 AM</option>
                                    <option value="10:00 AM - 12:00 PM" {{ old('preferred_time_slot') == '10:00 AM - 12:00 PM' ? 'selected' : '' }}>10:00 AM - 12:00 PM</option>
                                    <option value="12:00 PM - 02:00 PM" {{ old('preferred_time_slot') == '12:00 PM - 02:00 PM' ? 'selected' : '' }}>12:00 PM - 02:00 PM</option>
                                    <option value="02:00 PM - 04:00 PM" {{ old('preferred_time_slot') == '02:00 PM - 04:00 PM' ? 'selected' : '' }}>02:00 PM - 04:00 PM</option>
                                    <option value="04:00 PM - 06:00 PM" {{ old('preferred_time_slot') == '04:00 PM - 06:00 PM' ? 'selected' : '' }}>04:00 PM - 06:00 PM</option>
                                </select>
                                @error('preferred_time_slot') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Additional Options -->
                    <div>
                        <div class="flex items-center gap-3 bg-red-50 p-4 rounded-lg border border-red-100">
                            <input type="checkbox" name="is_urgent" id="is_urgent" value="1" class="h-5 w-5 text-red-600 border-red-300 rounded focus:ring-red-500" {{ old('is_urgent') ? 'checked' : '' }}>
                            <label for="is_urgent" class="text-sm font-bold text-red-800">
                                Emergency: Mark as urgent
                            </label>
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div>
                        <label for="image" class="form-label">Image Upload (Optional)</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-500 transition-colors">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="image" name="image" type="file" class="sr-only" accept="image/jpeg, image/png, image/jpg">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                            </div>
                        </div>
                        @error('image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">Cancel</a>
                        <button type="submit" class="btn btn-primary px-8 py-3 text-base">
                            Submit Complaint
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>