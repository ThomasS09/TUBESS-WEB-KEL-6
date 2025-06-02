<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('bookings.update', $booking->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6 mt-4">
                            <!-- Vehicle (select) -->
                            <div>
                                <x-label for="vehicle_id" :value="__('Vehicle')" />
                                <select id="vehicle_id" name="vehicle_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                    <option value="" disabled>Select your vehicle</option>
                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}" {{ $booking->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                                            {{ $vehicle->brand }} ({{ $vehicle->plate_number }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('vehicle_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Service (dropdown) -->
                            <div>
                                <x-label for="service_id" :value="__('Service')" />
                                <select id="service_id" name="service_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                    <option value="">Pilih Layanan</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" data-price="{{ $service->price }}" {{ old('service_id', $booking->service_id ?? '') == $service->id ? 'selected' : '' }}>
                                            {{ $service->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Amount (readonly) -->
                            <div>
                                <x-label for="amount" :value="__('Amount')" />
                                <x-input id="amount" name="amount" type="text" class="block mt-1 w-full bg-gray-100" readonly value="{{ old('amount', isset($booking) ? ($booking->service ? 'Rp ' . number_format($booking->service->price, 0, ',', '.') : '') : '') }}" />
                            </div>

                            <!-- Date & Time -->
                            <div>
                                <x-label for="booking_time" :value="__('Date & Time')" />
                                <x-input id="booking_time" class="block mt-1 w-full" type="datetime-local" name="booking_time" value="{{ old('booking_time', $booking->booking_time->format('Y-m-d\TH:i')) }}" min="{{ now()->addHour()->format('Y-m-d\TH:i') }}" required />
                                @error('booking_time')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Notes -->
                            <div>
                                <x-label for="notes" :value="__('Special Instructions (Optional)')" />
                                <textarea id="notes" name="notes" rows="3" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('notes', $booking->notes) }}</textarea>
                                @error('notes')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <a href="{{ route('bookings.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Cancel</a>
                            <x-button class="ml-3">
                                {{ __('Update Booking') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateAmount() {
            const serviceSelect = document.getElementById('service_id');
            const amountInput = document.getElementById('amount');
            const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
            const price = selectedOption.getAttribute('data-price') || '';
            amountInput.value = price ? 'Rp ' + Number(price).toLocaleString('id-ID') : '';
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateAmount();
            document.getElementById('service_id').addEventListener('change', updateAmount);
        });
    </script>
</x-app-layout>
