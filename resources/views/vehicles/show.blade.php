<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vehicle Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Vehicle Information</h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Brand</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $vehicle->brand }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Model</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $vehicle->model }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Plate Number</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $vehicle->plate_number }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Color</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $vehicle->color }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Recent Bookings</h3>
                            @if($vehicle->bookings->count() > 0)
                                <div class="space-y-2">
                                    @foreach($vehicle->bookings->take(3) as $booking)
                                    <div class="border rounded p-3">
                                        <p class="text-sm font-medium">{{ $booking->service->name }} - {{ $booking->booking_time->format('d M Y H:i') }}</p>
                                        <p class="text-xs text-gray-500">Status: 
                                            <span class="{{ $booking->status == 'completed' ? 'text-green-600' : ($booking->status == 'cancelled' ? 'text-red-600' : 'text-blue-600') }}">
                                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                            </span>
                                        </p>
                                    </div>
                                    @endforeach
                                </div>
                                @if($vehicle->bookings->count() > 3)
                                    <a href="{{ route('bookings.index') }}" class="mt-2 inline-block text-sm text-blue-600 hover:text-blue-800">View all bookings for this vehicle</a>
                                @endif
                            @else
                                <p class="text-sm text-gray-500">No bookings yet for this vehicle.</p>
                            @endif
                        </div>
                    </div>

                    <div class="flex justify-end mt-6 space-x-3">
                        <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Edit Vehicle
                        </a>
                        <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150" onclick="return confirm('Are you sure you want to delete this vehicle?')">
                                Delete Vehicle
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>