<x-app-layout>
    @section('title', 'Booking Masuk')

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @endpush

    <div class="container py-5">
        <h1 class="mb-4">Booking Masuk</h1>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Pelanggan</th>
                    <th>Layanan</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop data booking --}}
                <tr>
                    <td>1</td>
                    <td>Ahmad</td>
                    <td>Cuci Eksterior</td>
                    <td>2025-06-05</td>
                    <td>10:00</td>
                    <td>Pending</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-success">Setujui</a>
                        <a href="#" class="btn btn-sm btn-danger">Tolak</a>
                    </td>
                </tr>
            </tbody>
        </table>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
    </div>
</x-app-layout>
