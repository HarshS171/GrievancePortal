<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Complaint Analytics</h2>
                <p class="mt-1 text-sm text-gray-500">Visual insights into the grievance system performance.</p>
            </div>
            <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Last updated: {{ now()->format('M d, Y h:i A') }}</span>
        </div>
    </x-slot>

    {{-- Chart.js CDN --}}
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    @endpush

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- KPI Summary Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="card bg-white p-6 shadow-sm border border-gray-100">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Total Complaints</p>
                    <p class="text-4xl font-extrabold text-gray-900">{{ $total }}</p>
                    <p class="mt-2 text-xs text-gray-400">All time submissions</p>
                </div>
                <div class="card bg-white p-6 shadow-sm border border-gray-100">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Resolution Rate</p>
                    <p class="text-4xl font-extrabold text-green-600">{{ $resolutionRate }}%</p>
                    <p class="mt-2 text-xs text-gray-400">Resolved out of total</p>
                </div>
                <div class="card bg-white p-6 shadow-sm border border-gray-100">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Avg Resolution Time</p>
                    <p class="text-4xl font-extrabold text-indigo-600">{{ $avgResolutionTime }}<span class="text-xl font-semibold text-indigo-400"> days</span></p>
                    <p class="mt-2 text-xs text-gray-400">From submission to resolved</p>
                </div>
                <div class="card bg-white p-6 shadow-sm border border-gray-100">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Top Category</p>
                    <p class="text-2xl font-extrabold text-amber-600 leading-tight mt-1">{{ $mostCommonCategory['name'] ?? 'N/A' }}</p>
                    <p class="mt-2 text-xs text-gray-400">{{ $mostCommonCategory['count'] ?? 0 }} complaints filed</p>
                </div>
            </div>

            {{-- Line Chart: Complaints over last 30 days --}}
            <div class="card bg-white p-6 shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-1">Complaints Over Last 30 Days</h3>
                <p class="text-sm text-gray-500 mb-6">Daily submission trend</p>
                <div class="relative h-64">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>

            {{-- Bar + Pie Charts side by side --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Bar Chart: Complaints per Category --}}
                <div class="card bg-white p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Complaints by Category</h3>
                    <p class="text-sm text-gray-500 mb-6">Most common complaint types</p>
                    <div class="relative h-72">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>

                {{-- Pie Chart: Status Distribution --}}
                <div class="card bg-white p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Status Distribution</h3>
                    <p class="text-sm text-gray-500 mb-6">Breakdown of complaint statuses</p>
                    <div class="relative h-72 flex items-center justify-center">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Status breakdown table --}}
            <div class="card bg-white p-0 overflow-hidden shadow-sm border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900">Status Breakdown</h3>
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Count</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Percentage</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Progress</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($statusCounts as $status => $count)
                        @php
                            $pct = $total > 0 ? round(($count / $total) * 100, 1) : 0;
                            $color = match($status) {
                                'Resolved' => 'bg-green-500',
                                'In Progress' => 'bg-blue-500',
                                'Pending' => 'bg-amber-400',
                                default => 'bg-gray-400'
                            };
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                @if($status === 'Resolved')
                                    <span class="badge badge-resolved">{{ $status }}</span>
                                @elseif($status === 'In Progress')
                                    <span class="badge badge-in-progress">{{ $status }}</span>
                                @elseif($status === 'Pending')
                                    <span class="badge badge-pending">{{ $status }}</span>
                                @else
                                    <span class="badge bg-gray-100 text-gray-800">{{ $status }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-gray-900">{{ $count }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $pct }}%</td>
                            <td class="px-6 py-4 w-48">
                                <div class="w-full bg-gray-100 rounded-full h-2">
                                    <div class="{{ $color }} h-2 rounded-full" style="width: {{ $pct }}%"></div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        const palette = [
            '#6366f1','#8b5cf6','#ec4899','#f59e0b','#10b981',
            '#3b82f6','#ef4444','#14b8a6','#f97316','#84cc16'
        ];

        // --- Line Chart ---
        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: @json($lineLabels->values()),
                datasets: [{
                    label: 'Complaints',
                    data: @json($lineData->values()),
                    borderColor: '#6366f1',
                    backgroundColor: 'rgba(99,102,241,0.08)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#6366f1',
                    pointRadius: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f3f4f6' } },
                    x: { grid: { display: false } }
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
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f3f4f6' } },
                    x: { grid: { display: false }, ticks: { maxRotation: 30 } }
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
                    backgroundColor: statuses.map(s => statusColors[s] || '#9ca3af'),
                    borderWidth: 3,
                    borderColor: '#ffffff',
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { padding: 16, font: { size: 13 } } }
                },
                cutout: '60%'
            }
        });
    </script>
</x-app-layout>
