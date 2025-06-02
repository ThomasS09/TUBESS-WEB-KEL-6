<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf
                        
                        <!-- Vehicle Selection -->
                        <div class="mb-4">
                            <label for="vehicle_id" class="block text-sm font-medium text-gray-700">Vehicle</label>
                            <select id="vehicle_id" name="vehicle_id" class="mt-1 block w-full rounded-md border-gray-300" required>
                                <option value="">Select your vehicle</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">
                                        {{ $vehicle->brand }} ({{ $vehicle->plate_number }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Service Selection -->
                        <div class="mb-4">
                            <label for="service_id" class="block text-sm font-medium text-gray-700">Service</label>
                            <select id="service_id" name="service_id" class="mt-1 block w-full rounded-md border-gray-300" required>
                                <option value="">Pilih Layanan</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" data-price="{{ $service->price }}">
                                        {{ $service->name }} - Rp {{ number_format($service->price, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Amount -->
                        <div class="mb-4">
                            <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                            <input type="text" id="amount" name="amount" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100" readonly>
                        </div>

                        <!-- Date & Time -->
                        <div class="mb-4">
                            <label for="booking_time" class="block text-sm font-medium text-gray-700">Date & Time</label>
                            <input type="datetime-local" id="booking_time" name="booking_time" class="mt-1 block w-full rounded-md border-gray-300" required>
                        </div>

                        <!-- Notes -->
                        <div class="mb-4">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Special Instructions (Optional)</label>
                            <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300"></textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="window.history.back()" class="px-4 py-2 bg-gray-500 text-white rounded-md">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Book Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const serviceSelect = document.getElementById('service_id');
            const amountInput = document.getElementById('amount');

            function updateAmount() {
                const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
                const price = selectedOption.getAttribute('data-price');
                
                if (price) {
                    amountInput.value = 'Rp ' + Number(price).toLocaleString('id-ID');
                } else {
                    amountInput.value = '';
                }
            }

            serviceSelect.addEventListener('change', updateAmount);
        });
    </script>
    @endpush
</x-app-layout>
