{{-- Form Jadwal Kerja dengan UI sederhana --}}
<div class="max-w-xl mx-auto mt-10 bg-white rounded-lg shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6 text-indigo-700 text-center">Tambah Jadwal Kerja</h2>
    <form method="POST" action="{{ route('work-schedules.store') }}">
        @csrf

        <div class="mb-4">
            <x-label for="start_time" :value="__('Start Time')" />
            <x-input id="start_time" class="block mt-1 w-full" type="time" name="start_time" required />
            @error('start_time')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <x-label for="end_time" :value="__('End Time')" />
            <x-input id="end_time" class="block mt-1 w-full" type="time" name="end_time" required />
            @error('end_time')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <x-label for="employee_id" :value="__('Employee')" />
            <select id="employee_id" name="employee_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                <option value="">Pilih Karyawan</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
            @error('employee_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <x-label for="notes" :value="__('Notes (Optional)')" />
            <textarea id="notes" name="notes" rows="3" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
        </div>

        <div class="flex justify-end">
            <x-button type="submit" class="bg-indigo-600 hover:bg-indigo-700">
                {{ __('Save Schedule') }}
            </x-button>
        </div>
    </form>
</div>