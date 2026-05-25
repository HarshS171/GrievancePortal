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
                <div class="glass-card">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                        <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:rgba(255,255,255,0.4);font-weight:600">Total</div>
                        <div style="width:40px;height:40px;border-radius:8px;background:rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.25)">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                    </div>
                    <div style="font-size:32px;font-weight:700;color:#e8f4ff">{{ $total }}</div>
                    <div style="margin-top:6px;font-size:12px;color:rgba(255,255,255,0.4)">All time submissions</div>
                </div>
                <div class="glass-card">
                    <div class="flex items-center justify-between mb-4">
                        <p style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:rgba(255,255,255,0.4);font-weight:600">Resolution</p>
                        <div style="width:40px;height:40px;border-radius:8px;background:rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.25)">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <div style="font-size:32px;font-weight:700;color:#34d399">{{ $resolutionRate }}%</div>
                    <div style="margin-top:6px;font-size:12px;color:rgba(255,255,255,0.4)">Resolved out of total</div>
                </div>
                <div class="glass-card">
                    <div class="flex items-center justify-between mb-4">
                        <p style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:rgba(255,255,255,0.4);font-weight:600">Avg Time</p>
                        <div style="width:40px;height:40px;border-radius:8px;background:rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.25)">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <div style="font-size:32px;font-weight:700;color:#3b82f6">{{ $avgResolutionTime }}<span style="font-size:18px;font-weight:600;color:#60a5fa;margin-left:8px;">days</span></div>
                    <div style="margin-top:6px;font-size:12px;color:rgba(255,255,255,0.4)">From submission to resolved</div>
                </div>
                <div class="glass-card">
                    <div class="flex items-center justify-between mb-4">
                        <p style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:rgba(255,255,255,0.4);font-weight:600">Top Category</p>
                        <div style="width:40px;height:40px;border-radius:8px;background:rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.25)">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        </div>
                    </div>
                    <div style="font-size:20px;font-weight:600;color:#fbbf24;">{{ $mostCommonCategory['name'] ?? 'N/A' }}</div>
                    <div style="margin-top:6px;font-size:12px;color:rgba(255,255,255,0.4)">{{ $mostCommonCategory['count'] ?? 0 }} complaints filed</div>
                </div>
            </div>

            {{-- Line Chart: Complaints over last 30 days --}}
            <div class="glass-card">
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
                <div class="glass-card">
                    <div class="mb-8">
                        <h3 class="text-xl font-extrabold text-slate-900 tracking-tight">Complaints by Category</h3>
                        <p class="mt-1 text-sm font-medium text-slate-500">Most common complaint types across the system</p>
                    </div>
                    <div class="relative h-[300px] w-full">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>

                {{-- Pie Chart: Status Distribution --}}
                <div class="glass-card">
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
            <div class="glass-card p-0">
                <div style="padding:12px 16px;border-bottom:1px solid rgba(255,255,255,0.08)">
                    <h3 style="font-size:16px;font-weight:600;color:#e8f4ff;margin:0">Status Breakdown</h3>
                </div>
                <table style="width:100%;border-collapse:collapse;">
                    <thead style="background:rgba(255,255,255,0.05);border-bottom:1px solid rgba(255,255,255,0.1);">
                        <tr>
                            <th style="padding:12px 16px;text-align:left;font-size:11px;text-transform:uppercase;color:rgba(255,255,255,0.4)">Status</th>
                            <th style="padding:12px 16px;text-align:left;font-size:11px;text-transform:uppercase;color:rgba(255,255,255,0.4)">Count</th>
                            <th style="padding:12px 16px;text-align:left;font-size:11px;text-transform:uppercase;color:rgba(255,255,255,0.4)">Percentage</th>
                            <th style="padding:12px 16px;text-align:left;font-size:11px;text-transform:uppercase;color:rgba(255,255,255,0.4)">Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($statusCounts as $status => $count)
                        @php
                            $pct = $total > 0 ? round(($count / $total) * 100, 1) : 0;
                        @endphp
                        <tr style="border-top:1px solid rgba(255,255,255,0.06)">
                            <td style="padding:12px 16px;">
                                @if($status === 'Resolved')
                                    <span class="status-resolved">{{ $status }}</span>
                                @elseif($status === 'In Progress')
                                    <span class="status-inprogress">{{ $status }}</span>
                                @elseif($status === 'Pending')
                                    <span class="status-pending">{{ $status }}</span>
                                @else
                                    <span style="background:rgba(255,255,255,0.07);color:rgba(255,255,255,0.5);border:1px solid rgba(255,255,255,0.15);border-radius:20px;padding:3px 12px;font-size:11px;font-weight:600">{{ $status }}</span>
                                @endif
                            </td>
                            <td style="padding:12px 16px;font-size:14px;font-weight:700;color:#e8f4ff">{{ $count }}</td>
                            <td style="padding:12px 16px;font-size:13px;color:rgba(255,255,255,0.4)">{{ $pct }}%</td>
                            <td style="padding:12px 16px;width:320px;">
                                <div style="width:100%;background:rgba(255,255,255,0.06);border-radius:999px;height:10px;overflow:hidden;border:1px solid rgba(255,255,255,0.06)">
                                    <div style="height:10px;border-radius:999px;background:{{ $status === 'Resolved' ? '#34d399' : ($status === 'In Progress' ? '#6366f1' : ($status === 'Pending' ? '#fbbf24' : '#94a3b8')) }};width:{{ $pct }}%"></div>
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

        Chart.defaults.font.family = "'Outfit', sans-serif";
        Chart.defaults.color = 'rgba(255,255,255,0.6)';
        Chart.defaults.plugins.legend.labels.color = 'rgba(255,255,255,0.6)';
        Chart.defaults.scales = Chart.defaults.scales || {};
        Chart.defaults.scales.x = Chart.defaults.scales.x || {};
        Chart.defaults.scales.y = Chart.defaults.scales.y || {};
        Chart.defaults.scales.x.ticks = Chart.defaults.scales.x.ticks || {};
        Chart.defaults.scales.y.ticks = Chart.defaults.scales.y.ticks || {};
        Chart.defaults.scales.x.ticks.color = 'rgba(255,255,255,0.35)';
        Chart.defaults.scales.y.ticks.color = 'rgba(255,255,255,0.35)';
        Chart.defaults.scales.x.grid = Chart.defaults.scales.x.grid || {};
        Chart.defaults.scales.y.grid = Chart.defaults.scales.y.grid || {};
        Chart.defaults.scales.x.grid.color = 'rgba(255,255,255,0.05)';
        Chart.defaults.scales.y.grid.color = 'rgba(255,255,255,0.05)';
        Chart.defaults.datasets = Chart.defaults.datasets || {};
        Chart.defaults.datasets.line = Chart.defaults.datasets.line || {};
        Chart.defaults.datasets.line.borderColor = '#3b82f6';
        Chart.defaults.datasets.line.backgroundColor = 'rgba(59,130,246,0.1)';
        Chart.defaults.datasets.bar = Chart.defaults.datasets.bar || {};
        Chart.defaults.datasets.bar.backgroundColor = '#3b82f6';

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
