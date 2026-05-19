<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fade-in">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Complaint Analytics</h2>
                <p class="mt-2 text-sm text-slate-500 font-medium">Visual insights into the grievance system performance.</p>
            </div>
            <div class="flex items-center gap-2 px-3 py-1.5 bg-slate-100 rounded-lg border border-slate-200">
                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                <span class="text-xs font-bold text-slate-600 uppercase tracking-widest">Live &bull; {{ now()->format('M d, Y') }}</span>
            </div>
        </div>
    </x-slot>

    {{-- Chart.js CDN --}}
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    @endpush

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8 animate-slide-up">

            {{-- KPI Summary Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="card bg-white p-6 sm:p-8 shadow-lg shadow-slate-200/40 border-0 ring-1 ring-slate-100 hover:ring-portal-100 hover:-translate-y-1 transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-xs font-extrabold text-slate-500 uppercase tracking-wider group-hover:text-portal-700 transition-colors">Total</p>
                        <div class="w-10 h-10 rounded-xl bg-portal-50 text-portal-700 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                    </div>
                    <p class="text-4xl font-black text-slate-900 tracking-tight">{{ $total }}</p>
                    <p class="mt-2 text-sm font-medium text-slate-500">All time submissions</p>
                </div>
                <div class="card bg-white p-6 sm:p-8 shadow-lg shadow-slate-200/40 border-0 ring-1 ring-slate-100 hover:ring-emerald-100 hover:-translate-y-1 transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-xs font-extrabold text-slate-500 uppercase tracking-wider group-hover:text-emerald-600 transition-colors">Resolution</p>
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <p class="text-4xl font-black text-emerald-600 tracking-tight">{{ $resolutionRate }}%</p>
                    <p class="mt-2 text-sm font-medium text-slate-500">Resolved out of total</p>
                </div>
                <div class="card bg-white p-6 sm:p-8 shadow-lg shadow-slate-200/40 border-0 ring-1 ring-slate-100 hover:ring-blue-100 hover:-translate-y-1 transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-xs font-extrabold text-slate-500 uppercase tracking-wider group-hover:text-blue-600 transition-colors">Avg Time</p>
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <p class="text-4xl font-black text-blue-600 tracking-tight">{{ $avgResolutionTime }}<span class="text-xl font-bold text-blue-400 ml-1">days</span></p>
                    <p class="mt-2 text-sm font-medium text-slate-500">From submission to resolved</p>
                </div>
                <div class="card bg-white p-6 sm:p-8 shadow-lg shadow-slate-200/40 border-0 ring-1 ring-slate-100 hover:ring-amber-100 hover:-translate-y-1 transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-xs font-extrabold text-slate-500 uppercase tracking-wider group-hover:text-amber-600 transition-colors">Top Category</p>
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        </div>
                    </div>
                    <p class="text-2xl font-black text-amber-600 tracking-tight leading-tight truncate">{{ $mostCommonCategory['name'] ?? 'N/A' }}</p>
                    <p class="mt-2 text-sm font-medium text-slate-500">{{ $mostCommonCategory['count'] ?? 0 }} complaints filed</p>
                </div>
            </div>

            {{-- Line Chart: Complaints over last 30 days --}}
            <div class="card bg-white p-6 sm:p-8 shadow-lg shadow-slate-200/40 border-0 ring-1 ring-slate-100">
                <div class="mb-8">
                    <h3 class="text-xl font-extrabold text-slate-900 tracking-tight">Complaints Over Last 30 Days</h3>
                    <p class="mt-1 text-sm font-medium text-slate-500">Daily submission trend and volume</p>
                </div>
                <div class="relative h-[300px] w-full">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>

            {{-- Bar + Pie Charts side by side --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                {{-- Bar Chart: Complaints per Category --}}
                <div class="card bg-white p-6 sm:p-8 shadow-lg shadow-slate-200/40 border-0 ring-1 ring-slate-100">
                    <div class="mb-8">
                        <h3 class="text-xl font-extrabold text-slate-900 tracking-tight">Complaints by Category</h3>
                        <p class="mt-1 text-sm font-medium text-slate-500">Most common complaint types across the system</p>
                    </div>
                    <div class="relative h-[300px] w-full">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>

                {{-- Pie Chart: Status Distribution --}}
                <div class="card bg-white p-6 sm:p-8 shadow-lg shadow-slate-200/40 border-0 ring-1 ring-slate-100">
                    <div class="mb-8">
                        <h3 class="text-xl font-extrabold text-slate-900 tracking-tight">Status Distribution</h3>
                        <p class="mt-1 text-sm font-medium text-slate-500">Breakdown of current complaint statuses</p>
                    </div>
                    <div class="relative h-[300px] w-full flex items-center justify-center">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Status breakdown table --}}
            <div class="card bg-white p-0 overflow-hidden shadow-lg shadow-slate-200/40 border-0 ring-1 ring-slate-100">
                <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-xl font-extrabold text-slate-900 tracking-tight">Status Breakdown</h3>
                </div>
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50/80">
                        <tr>
                            <th class="px-8 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="px-8 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Count</th>
                            <th class="px-8 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Percentage</th>
                            <th class="px-8 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Progress</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100">
                        @foreach($statusCounts as $status => $count)
                        @php
                            $pct = $total > 0 ? round(($count / $total) * 100, 1) : 0;
                            $color = match($status) {
                                'Resolved' => 'bg-emerald-500 shadow-emerald-200',
                                'In Progress' => 'bg-blue-500 shadow-blue-200',
                                'Pending' => 'bg-amber-400 shadow-amber-200',
                                default => 'bg-slate-400 shadow-slate-200'
                            };
                        @endphp
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-8 py-5">
                                @if($status === 'Resolved')
                                    <span class="badge badge-resolved">{{ $status }}</span>
                                @elseif($status === 'In Progress')
                                    <span class="badge badge-in-progress">{{ $status }}</span>
                                @elseif($status === 'Pending')
                                    <span class="badge badge-pending">{{ $status }}</span>
                                @else
                                    <span class="badge bg-slate-100 text-slate-800 border-slate-200">{{ $status }}</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-sm font-extrabold text-slate-900">{{ $count }}</td>
                            <td class="px-8 py-5 text-sm font-bold text-slate-500">{{ $pct }}%</td>
                            <td class="px-8 py-5 w-64">
                                <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden border border-slate-200/60">
                                    <div class="{{ $color }} h-2.5 rounded-full shadow-lg transition-all duration-1000 ease-out" style="width: {{ $pct }}%"></div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        const palette = [
            '#1e3a8a','#1d4ed8','#2563eb','#10b981','#f59e0b',
            '#0ea5e9','#ef4444','#14b8a6','#64748b','#059669'
        ];

        Chart.defaults.font.family = "'Inter', sans-serif";
        Chart.defaults.color = '#64748b';
        Chart.defaults.scale.grid.color = '#f1f5f9';

        // --- Line Chart ---
        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: @json($lineLabels->values()),
                datasets: [{
                    label: 'Complaints',
                    data: @json($lineData->values()),
                    borderColor: '#1e40af',
                    backgroundColor: (context) => {
                        const ctx = context.chart.ctx;
                        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
                        gradient.addColorStop(0, 'rgba(30,64,175,0.25)');
                        gradient.addColorStop(1, 'rgba(30,64,175,0)');
                        return gradient;
                    },
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#1e40af',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { padding: 12, cornerRadius: 8, titleFont: { size: 14, weight: 'bold' } } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1, padding: 10 } },
                    x: { grid: { display: false }, ticks: { padding: 10 } }
                }
            }
        });

        // --- Bar Chart ---
        const catLabels = @json($complaintsPerCategory->pluck('name')->values());
        const catData   = @json($complaintsPerCategory->pluck('count')->values());

        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: catLabels,
                datasets: [{
                    label: 'Complaints',
                    data: catData,
                    backgroundColor: palette.slice(0, catLabels.length),
                    borderRadius: 8,
                    borderSkipped: false,
                    barPercentage: 0.6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { padding: 12, cornerRadius: 8 } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1, padding: 10 } },
                    x: { grid: { display: false }, ticks: { maxRotation: 45, minRotation: 0, padding: 10 } }
                }
            }
        });

        // --- Pie Chart ---
        const statuses = @json($statusCounts->keys()->values());
        const statusData = @json($statusCounts->values());
        const statusColors = {
            'Pending': '#f59e0b',
            'In Progress': '#3b82f6',
            'Resolved': '#10b981',
            'Rejected': '#ef4444',
        };

        new Chart(document.getElementById('pieChart'), {
            type: 'doughnut',
            data: {
                labels: statuses,
                datasets: [{
                    data: statusData,
                    backgroundColor: statuses.map(s => statusColors[s] || '#94a3b8'),
                    borderWidth: 4,
                    borderColor: '#ffffff',
                    hoverOffset: 12,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'right', labels: { padding: 20, font: { size: 13, weight: '600' }, usePointStyle: true, pointStyle: 'circle' } },
                    tooltip: { padding: 12, cornerRadius: 8 }
                },
                cutout: '70%',
                layout: { padding: 20 }
            }
        });
    </script>
    @endpush
</x-app-layout>
