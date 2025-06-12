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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Booking Information</h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Service</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $booking->service->name ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Vehicle</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $booking->vehicle ? $booking->vehicle->brand . ' (' . $booking->vehicle->plate_number . ')' : 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Date & Time</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $booking->booking_time->format('l, F d H Y:i') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Status</p>
                                    <p class="mt-1 text-sm text-gray-900">
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
                                    </p>
                                </div>
                                @if($booking->notes)
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Special Instructions</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $booking->notes }}</p>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Payment Information</h3>
                            @if($booking->transaction)
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Amount</p>
                                        <p class="mt-1 text-sm text-gray-900">Rp {{ number_format($booking->transaction->amount, 0, ',', '.') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Payment Status</p>
                                        <p class="mt-1 text-sm text-gray-900">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $booking->transaction->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ ucfirst($booking->transaction->payment_status) }}
                                            </span>
                                        </p>
                                    </div>
                                    @if($booking->transaction->payment_method)
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Payment Method</p>
                                        <p class="mt-1 text-sm text-gray-900">{{ ucfirst($booking->transaction->payment_method) }}</p>
                                    </div>
                                    @endif
                                </div>
                            @else
                                <p class="text-sm text-gray-500">No payment information available.</p>
                            @endif
                        </div>
                    </div>

                    <div class="flex justify-end mt-6 space-x-3">
                        @if($booking->status == 'pending')
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Edit Booking
                            </a>
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150" onclick="return confirm('Are you sure you want to cancel this booking?')">
                                    Cancel Booking
                                </button>
                            </form>
                        @endif
                        <a href="{{ route('bookings.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
