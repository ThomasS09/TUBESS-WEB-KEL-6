<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Booking Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Booking Information</h3>
                        <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Service</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $booking->service->name }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Vehicle</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $booking->vehicle->brand }} ({{ $booking->vehicle->plate_number }})</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Date & Time</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $booking->booking_time->format('d M Y H:i') }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="mt-1">
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        {{ $booking->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                           ($booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                           'bg-blue-100 text-blue-800') }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </dd>
                            </div>

                            @if($booking->notes)
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Special Instructions</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $booking->notes }}</dd>
                            </div>
                            @endif
                        </dl>
                    </div>

                    <!-- Payment Information -->
                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Information</h3>
                        @if($booking->transaction)
                            <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Amount</dt>
                                    <dd class="mt-1 text-sm text-gray-900">Rp {{ number_format($booking->transaction->amount, 0, ',', '.') }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Payment Status</dt>
                                    <dd class="mt-1">
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            {{ $booking->transaction->status === 'paid' ? 
                                               'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($booking->transaction->status) }}
                                        </span>
                                    </dd>
                                </div>
                            </dl>
                        @else
                            <p class="text-sm text-gray-500">No payment information available.</p>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('bookings.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                            Back to List
                        </a>
                        
                        @if($booking->status === 'pending')
                            <a href="{{ route('bookings.edit', $booking) }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                Edit Booking
                            </a>
                            
                            <form method="POST" action="{{ route('bookings.destroy', $booking) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600" 
                                        onclick="return confirm('Are you sure you want to cancel this booking?')">
                                    Cancel Booking
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>