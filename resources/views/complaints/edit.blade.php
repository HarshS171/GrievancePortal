<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fade-in">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Edit Complaint</h2>
                <p class="mt-2 text-sm text-slate-500 font-medium">Update the details of your submitted grievance.</p>
            </div>
            <a href="{{ route('complaints.index') }}" class="btn btn-secondary inline-flex items-center gap-2 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 animate-slide-up">
            <div class="card bg-white p-8 sm:p-10 shadow-lg shadow-slate-200/40 border-0 ring-1 ring-slate-100">
                <form action="{{ route('complaints.update', $complaint->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-2 group-focus-within:text-portal-700 transition-colors">Title</label>
                        <input type="text" name="title" class="form-input w-full @error('title') border-rose-300 ring-rose-200 @enderror" value="{{ old('title', $complaint->title) }}" required>
                        @error('title')
                            <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-2 group-focus-within:text-portal-700 transition-colors">Category</label>
                        <select name="category_id" class="form-input w-full bg-white @error('category_id') border-rose-300 ring-rose-200 @enderror" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $complaint->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-2 group-focus-within:text-portal-700 transition-colors">Detailed Description</label>
                        <textarea name="description" rows="6" class="form-input w-full resize-y @error('description') border-rose-300 ring-rose-200 @enderror" required>{{ old('description', $complaint->description) }}</textarea>
                        @error('description')
                            <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-700 mb-2 group-focus-within:text-portal-700 transition-colors">Update Attachment (Optional)</label>
                        @if($complaint->image)
                            <div class="mb-4 p-4 bg-slate-50 border border-slate-200 rounded-xl">
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">Current Attachment</p>
                                <img src="{{ asset('storage/' . $complaint->image) }}" class="max-h-40 rounded-lg border border-slate-200 shadow-sm object-cover">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-input w-full file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-portal-50 file:text-portal-700 hover:file:bg-portal-100 cursor-pointer pt-2">
                    </div>

                    <div class="flex flex-col-reverse sm:flex-row items-center gap-4 pt-6 border-t border-slate-100">
                        <a href="{{ route('complaints.index') }}" class="btn btn-secondary w-full sm:w-auto text-center">Cancel</a>
                        <button type="submit" class="btn btn-primary w-full sm:w-auto px-8 py-3 shadow-lg shadow-portal-200">
                            Update Complaint
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>