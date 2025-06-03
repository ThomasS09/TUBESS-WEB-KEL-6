<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Upcoming Bookings -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Upcoming Bookings</h3>
                        @if($upcomingBookings->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @foreach($upcomingBookings as $booking)
                                <div class="border rounded-lg p-4 shadow-sm">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium text-gray-900">{{ $booking->service->name ?? 'N/A' }}</h4>
                                            <p class="text-sm text-gray-500">{{ $booking->vehicle ? $booking->vehicle->brand . ' (' . $booking->vehicle->plate_number . ')' : 'N/A' }}</p>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ str_replace('_', ' ', $booking->status) }}
                                        </span>
                                    </div>
                                    <div class="mt-4">
                                        <p class="text-sm text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $booking->booking_time->format('l, d F Y') }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $booking->booking_time->format('H:i') }}
                                        </p>
                                        <</h1>
                                    </div>
                                    <div class="mt-4 flex justify-end">
                                        <a href="{{ route('bookings.show', $booking->id) }}" class="text-sm text-blue-600 hover:text-blue-800">View Details</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">You don't have any upcoming bookings.</p>
                        @endif
                    </div>

                    <!-- Recent Bookings -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Recent Bookings</h3>
                            <a href="{{ route('bookings.index') }}" class="text-sm text-blue-600 hover:text-blue-800">View All</a>
                        </div>
                        @if($recentBookings && $recentBookings->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vehicle</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
@foreach($recentBookings as $booking)
<tr>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $booking->service->name ?? 'N/A' }}</td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->vehicle ? $booking->vehicle->brand . ' ' . $booking->vehicle->model : 'N/A' }}</td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->booking_time->format('d M Y H:i') }}</td>
    <td class="px-6 py-4 whitespace-nowrap">
        @php
            $statusClasses = [
                'pending' => 'bg-yellow-100 text-yellow-800',
                'confirmed' => 'bg-green-100 text-green-800',
                'in_progress' => 'bg-blue-100 text-blue-800',
                'completed' => 'bg-gray-100 text-gray-800',
                'cancelled' => 'bg-red-100 text-red-800',
            ];
        @endphp
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$booking->status] }}">
            {{ str_replace('_', ' ', $booking->status) }}
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <a href="{{ route('bookings.show', $booking->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
        @if($booking->status == 'pending')
            <a href="{{ route('bookings.edit', $booking->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
        @endif
    </td>
</tr>
@endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500">You don't have any booking history.</p>
                        @endif
                    </div>

                    <!-- Quick Actions -->
                    <div class="flex space-x-4">
                        <a href="{{ route('bookings.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            New Booking
                        </a>
                        <a href="{{ route('vehicles.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            My Vehicles
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
