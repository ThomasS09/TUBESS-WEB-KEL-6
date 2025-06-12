<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Statistics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Daily Bookings -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Daily Bookings (Last 30 Days)</h3>
                    <canvas id="dailyBookingsChart"></canvas>
                </div>
            </div>

            <!-- Service Popularity -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Service Popularity</h3>
                    <canvas id="servicePopularityChart"></canvas>
                </div>
            </div>

            <!-- Customer Growth -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Customer Growth</h3>
                    <canvas id="customerGrowthChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Daily Bookings Chart
        const dailyStats = @json($daily_stats);
        new Chart(document.getElementById('dailyBookingsChart'), {
            type: 'bar',
            data: {
                labels: dailyStats.map(item => new Date(item.date).toLocaleDateString()),
                datasets: [{
                    label: 'Number of Bookings',
                    data: dailyStats.map(item => item.total),
                    backgroundColor: 'rgba(59, 130, 246, 0.5)',
                    borderColor: 'rgb(59, 130, 246)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Service Popularity Chart
        const serviceData = @json($service_popularity);
        new Chart(document.getElementById('servicePopularityChart'), {
            type: 'pie',
            data: {
                labels: serviceData.map(item => item.name),
                datasets: [{
                    data: serviceData.map(item => item.bookings_count),
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.5)',
                        'rgba(16, 185, 129, 0.5)',
                        'rgba(245, 158, 11, 0.5)',
                        'rgba(239, 68, 68, 0.5)'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Customer Growth Chart
        const customerData = @json($customer_growth);
        new Chart(document.getElementById('customerGrowthChart'), {
            type: 'line',
            data: {
                labels: customerData.map(item => new Date(item.date).toLocaleDateString()),
                datasets: [{
                    label: 'New Customers',
                    data: customerData.map(item => item.total),
                    borderColor: 'rgb(59, 130, 246)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
    @endpush
</x-app-layout>