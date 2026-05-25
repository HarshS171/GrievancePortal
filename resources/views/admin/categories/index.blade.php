<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fade-in">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Manage Categories</h2>
                <p class="mt-2 text-sm text-slate-500 font-medium">Add, edit, or remove complaint categories.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8" x-data="{ editingCategory: null, categoryName: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 animate-slide-up">
            <div style="display:grid;grid-template-columns:35% 65%;gap:1rem;">
                <!-- Left: Add New Category Form -->
                <div>
                    <div class="glass-card" style="position:sticky;top:24px;">
                        <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px;padding-bottom:10px;border-bottom:1px solid rgba(255,255,255,0.08)">
                            <div style="width:40px;height:40px;border-radius:8px;background:rgba(59,130,246,0.15);display:flex;align-items:center;justify-content:center;color:#93c5fd">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            </div>
                            <h3 style="font-size:16px;font-weight:600;color:#e8f4ff;margin:0">Add New Category</h3>
                        </div>
                        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="group">
                                <label for="name" class="block text-sm font-semibold" style="color:rgba(255,255,255,0.75);margin-bottom:6px">Category Name</label>
                                <input type="text" name="name" id="name" class="form-input w-full @error('name') border-rose-300 ring-rose-200 @enderror" placeholder="e.g., Electricity" required>
                                @error('name')
                                    <p class="mt-1.5 text-sm font-medium text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn-primary w-full py-2.5">Add Category</button>
                        </form>
                    </div>
                </div>

                <!-- Right: Category List -->
                <div>
                    <div class="glass-card p-0" style="overflow:hidden;">
                        <table style="width:100%;border-collapse:collapse;">
                            <thead style="background:rgba(255,255,255,0.05);border-bottom:1px solid rgba(255,255,255,0.1);">
                                <tr>
                                    <th style="padding:12px 16px;text-align:left;font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:rgba(255,255,255,0.4)">Name</th>
                                    <th style="padding:12px 16px;text-align:left;font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:rgba(255,255,255,0.4)">Complaints Count</th>
                                    <th style="padding:12px 16px;text-align:right;font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:rgba(255,255,255,0.4)">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr style="border-top:1px solid rgba(255,255,255,0.06)">
                                        <td style="padding:14px 16px;color:#e8f4ff;font-size:14px">{{ $category->name }}</td>
                                        <td style="padding:14px 16px;">
                                            <span style="background:rgba(59,130,246,0.12);color:#93c5fd;border:1px solid rgba(59,130,246,0.2);border-radius:20px;padding:2px 10px;font-size:12px">{{ $category->complaints_count }}</span>
                                        </td>
                                        <td style="padding:14px 16px;text-align:right;">
                                            <div style="display:flex;align-items:center;justify-content:flex-end;gap:8px;opacity:0;transition:opacity .2s" class="group-hover:opacity-100">
                                                <button type="button" @click="editingCategory = {{ $category->id }}; categoryName = '{{ addslashes($category->name) }}'" style="color:#93c5fd;background:transparent;border:none;font-weight:600;padding:6px;border-radius:6px">Edit</button>
                                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="color:#f87171;background:transparent;border:none;font-weight:600;padding:6px;border-radius:6px">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" style="padding:40px;text-align:center;color:rgba(255,255,255,0.45)">
                                            <div style="display:inline-flex;align-items:center;justify-content:center;width:64px;height:64px;border-radius:50%;background:rgba(255,255,255,0.02);margin:0 auto 12px;color:rgba(255,255,255,0.3)">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                            </div>
                                            <p>No categories found. Create one to get started.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Category Modal -->
        <div x-show="editingCategory !== null" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="editingCategory !== null" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 backdrop-blur-none" x-transition:enter-end="opacity-100 backdrop-blur-sm" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 backdrop-blur-sm" x-transition:leave-end="opacity-0 backdrop-blur-none" class="fixed inset-0 bg-slate-900/60 transition-all" @click="editingCategory = null" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="editingCategory !== null" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-100 ring-1 ring-slate-900/5">
                    <form :action="`/admin/categories/${editingCategory}`" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="bg-white px-6 pt-6 pb-6 sm:px-8 sm:pb-8">
                            <div class="sm:flex sm:items-start">
                                <div class="w-full">
                                    <h3 class="text-xl font-bold text-slate-900 tracking-tight mb-6" id="modal-title">Edit Category</h3>
                                    <div class="group">
                                        <label for="edit_name" class="block text-sm font-semibold text-slate-700 mb-1.5 group-focus-within:text-portal-700 transition-colors">Category Name</label>
                                        <input type="text" name="name" id="edit_name" x-model="categoryName" class="form-input w-full" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 px-6 py-4 sm:px-8 sm:flex sm:flex-row-reverse border-t border-slate-100 gap-3">
                            <button type="submit" class="btn btn-primary w-full sm:w-auto py-2.5 px-6 shadow-md shadow-portal-200">
                                Save Changes
                            </button>
                            <button type="button" @click="editingCategory = null" class="mt-3 sm:mt-0 btn btn-secondary w-full sm:w-auto py-2.5 px-6 border-slate-200 text-slate-600 hover:bg-slate-100 hover:text-slate-900">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
