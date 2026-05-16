<x-app-layout>
    <x-slot name="header"><h2>Submit a New Complaint</h2></x-slot>

    <div class="section">
        <div class="container-narrow">
            <div class="card">
                <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-input" value="{{ old('title') }}" required placeholder="Brief summary of your grievance">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select" required>
                            <option value="" disabled selected>Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Detailed Description</label>
                        <textarea name="description" rows="5" class="form-textarea" required placeholder="Describe your issue in detail...">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Attachment (Optional)</label>
                        <input type="file" name="image" class="form-input">
                        <p class="form-help">Accepted: JPG, PNG, JPEG. Max 2MB.</p>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Submit Complaint</button>
                        <a href="{{ route('complaints.index') }}" class="text-link text-muted" style="text-decoration: none;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>