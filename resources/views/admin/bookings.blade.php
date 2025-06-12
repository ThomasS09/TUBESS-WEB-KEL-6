<x-app-layout>
    @section('title', 'Booking Masuk')

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @endpush

    <div class="container py-5">
        <h1 class="mb-4">Booking Masuk</h1>

        <!-- Filters -->
        <div class="mb-6 flex justify-between items-center">
            <div class="flex space-x-4">
                <select id="status-filter" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                <input type="date" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <input type="text" placeholder="Search..." class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Pelanggan</th>
                    <th>Layanan</th>
                    <th>Tanggal & Waktu</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop data booking --}}
                @foreach($bookings as $booking)
                <tr>
                    <td>#{{ $booking->id }}</td>
                    <td>
                        <div class="text-sm font-medium text-gray-900">{{ $booking->user->name }}</div>
                        <div class="text-sm text-gray-500">{{ $booking->user->email }}</div>
                    </td>
                    <td>
                        <div class="text-sm text-gray-900">{{ $booking->service->name }}</div>
                        <div class="text-sm text-gray-500">Rp {{ number_format($booking->service->price, 0, ',', '.') }}</div>
                    </td>
                    <td>
                        <div class="text-sm text-gray-900">{{ $booking->booking_time->format('d M Y') }}</div>
                        <div class="text-sm text-gray-500">{{ $booking->booking_time->format('H:i') }}</div>
                    </td>
                    <td>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $booking->status === 'completed' ? 'bg-green-100 text-green-800' : 
                               ($booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                               'bg-blue-100 text-blue-800') }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td class="text-sm font-medium">
                        <div class="flex space-x-3">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Lihat</a>
                            <a href="#" class="text-green-600 hover:text-green-900">Edit</a>
                            @if($booking->status === 'pending')
                            <form method="POST" action="{{ route('admin.bookings.status', $booking) }}" class="inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" class="text-red-600 hover:text-red-900">Batal</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $bookings->links() }}
        </div>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
    </div>
</x-app-layout>
