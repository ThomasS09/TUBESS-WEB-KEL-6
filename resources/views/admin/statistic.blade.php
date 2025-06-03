<x-app-layout>
    @section('title', 'Statistik Paket Carwash')
    
    @section('content')
    <div class="container py-4">
    <h1 class="mb-4">Statistik Paket Carwash</h1>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Paket</h5>
                    <p class="card-text fs-3"></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Paket Aktif</h5>
                    <p class="card-text fs-3"></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Paket Tidak Aktif</h5>
                    <p class="card-text fs-3"></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Omzet (Rp)</h5>
                    <p class="card-text fs-3">Rp {{ number_format(555, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart.js --}}
    <div class="card">
        <div class="card-header">Distribusi Paket Carwash Berdasarkan Status</div>
        <div class="card-body">
            <canvas id="statusChart" height="100"></canvas>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Aktif', 'Tidak Aktif'],
            datasets: [{
                label: 'Jumlah Paket',
                backgroundColor: ['#198754', '#6c757d'],
                hoverOffset: 30
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
</script>
@endsection

</x-app-layout>