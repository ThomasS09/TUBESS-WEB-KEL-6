<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Booking List</h3>
                        <a href="{{ route('bookings.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add New Booking
                        </a>
                    </div>

                    @if($bookings->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($bookings as $booking)
                                <div class="border rounded-lg p-4">
                                    <h4 class="font-medium">{{ $booking->service->name ?? '-' }}</h4>
                                    <p class="text-sm text-gray-600">Vehicle: {{ optional($booking->vehicle)->brand }} ({{ optional($booking->vehicle)->plate_number }})</p>
                                    <p class="text-sm text-gray-600">Date: {{ $booking->booking_time->format('d M Y H:i') }}</p>
                                    <p class="text-sm text-gray-600">Status: {{ ucfirst($booking->status) }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">You haven't made any bookings yet.</p>
                    @endif

                    @if($vehicles->count() > 0)
                        <div class="mt-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Your Vehicles</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($vehicles as $vehicle)
                                    <div class="border rounded-lg p-4">
                                        <h4 class="font-medium">{{ $vehicle->brand }} {{ $vehicle->model }}</h4>
                                        <p class="text-sm text-gray-600">Plate: {{ $vehicle->plate_number }}</p>
                                        <p class="text-sm text-gray-600">Color: {{ $vehicle->color }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
