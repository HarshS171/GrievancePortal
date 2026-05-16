<x-app-layout>
    <x-slot name="header">
        <h2 style="margin-bottom: 0;">{{ __('Edit Complaint') }}</h2>
    </x-slot>

    <div class="section-py">
        <div class="container" style="max-width: 800px;">
            <div class="card">
                <form action="{{ route('complaints.update', $complaint->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="label">Title</label>
                        <input type="text" name="title" class="input" value="{{ old('title', $complaint->title) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="label">Category</label>
                        <select name="category_id" class="select" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $complaint->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="label">Detailed Description</label>
                        <textarea name="description" rows="6" class="textarea" required>{{ old('description', $complaint->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="label">Update Attachment (Optional)</label>
                        @if($complaint->image)
                            <div style="margin-bottom: 12px;">
                                <p style="font-size: 0.75rem; color: var(--text-muted); margin-bottom: 4px;">Current Attachment:</p>
                                <img src="{{ asset('storage/' . $complaint->image) }}" style="max-height: 120px; border-radius: var(--radius-sm); border: 1px solid var(--border);">
                            </div>
                        @endif
                        <input type="file" name="image" class="input" style="padding: 8px;">
                    </div>

                    <div style="margin-top: 32px; display: flex; align-items: center; gap: 16px;">
                        <button type="submit" class="btn btn-primary">
                            Update Complaint
                        </button>
                        <a href="{{ route('complaints.index') }}" style="font-size: 0.875rem; color: var(--text-muted); text-decoration: none;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>