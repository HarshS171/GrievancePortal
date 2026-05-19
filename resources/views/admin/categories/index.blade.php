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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Add New Category Form -->
                <div class="md:col-span-1">
                    <div class="card bg-white p-6 sm:p-8 shadow-lg shadow-slate-200/40 border-0 ring-1 ring-slate-100 sticky top-6">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                            <div class="w-10 h-10 rounded-full bg-portal-50 text-portal-700 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 tracking-tight">Add New Category</h3>
                        </div>
                        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="group">
                                <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5 group-focus-within:text-portal-700 transition-colors">Category Name</label>
                                <input type="text" name="name" id="name" class="form-input w-full @error('name') border-rose-300 ring-rose-200 @enderror" placeholder="e.g., Electricity" required>
                                @error('name')
                                    <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-full py-2.5 shadow-lg shadow-portal-200">
                                Add Category
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Category List -->
                <div class="md:col-span-2">
                    <div class="card p-0 overflow-hidden bg-white shadow-lg shadow-slate-200/40 border-0 ring-1 ring-slate-100">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50/80">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Complaints Count</th>
                                    <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100">
                                @forelse($categories as $category)
                                    <tr class="hover:bg-slate-50/60 transition-colors group">
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="text-sm font-extrabold text-slate-900 group-hover:text-portal-700 transition-colors">{{ $category->name }}</div>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <span class="inline-flex items-center justify-center min-w-[2rem] px-2.5 py-1 rounded-md text-xs font-bold bg-portal-50 text-portal-700 border border-portal-100/60">
                                                {{ $category->complaints_count }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <button type="button" @click="editingCategory = {{ $category->id }}; categoryName = '{{ addslashes($category->name) }}'" class="text-portal-700 hover:text-portal-800 font-bold transition-colors p-2 rounded-lg hover:bg-portal-50">
                                                    Edit
                                                </button>
                                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold transition-colors p-2 rounded-lg hover:bg-rose-50">Delete</button>
                                                </form>
                                            </div>
                                            <div class="group-hover:hidden text-slate-400">
                                                <svg class="w-5 h-5 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/></svg>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center">
                                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 mb-4 shadow-inner border border-slate-100">
                                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                            </div>
                                            <p class="text-slate-500 font-medium">No categories found. Create one to get started.</p>
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
