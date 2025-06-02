<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Service Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Service Information</h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Name</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $service->name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Description</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $service->description }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Price</p>
                                    <p class="mt-1 text-sm text-gray-900">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Duration</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $service->duration_minutes }} minutes</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Recent Bookings</h3>
                            @if($service->bookings->count() > 0)
                                <div class="space-y-2">
                                    @foreach($service->bookings->take(3)->sortByDesc('booking_time') as $booking)
                                    <div class="border rounded p-3">
                                        <p class="text-sm font-medium">{{ $booking->vehicle->brand }} - {{ $booking->booking_time->format('d M Y H:i') }}</p>
                                        <p class="text-xs text-gray-500">Customer: {{ $booking->user->name }}</p>
                                        <p class="text-xs text-gray-500">Status: 
                                            <span class="{{ $booking->status == 'completed' ? 'text-green-600' : ($booking->status == 'cancelled' ? 'text-red-600' : 'text-blue-600') }}">
                                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                            </span>
                                        </p>
                                    </div>
                                    @endforeach
                                </div>
                                @if($service->bookings->count() > 3)
                                    <a href="{{ route('admin.bookings.index') }}" class="mt-2 inline-block