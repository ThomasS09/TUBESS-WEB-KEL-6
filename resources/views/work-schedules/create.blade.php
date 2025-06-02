@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md transition transform hover:scale-[1.01] duration-300">
        <h2 class="text-center text-xl font-semibold text-indigo-600 mb-6">Tambah Jadwal Kerja</h2>

        @if ($errors->any())
            <div class="mb-4 text-sm text-red-600">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('work-schedules.store') }}" class="space-y-4">
            @csrf

            <div>
                <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                <input type="time" name="start_time" id="start_time"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition">
            </div>

            <div>
                <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                <input type="time" name="end_time" id="end_time"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition">
            </div>

            <div>
                <label for="employee_id" class="block text-sm font-medium text-gray-700">Employee</label>
                <select name="employee_id" id="employee_id"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition">
                    <option disabled selected>Pilih Karyawan</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700">Notes (Optional)</label>
                <textarea name="notes" id="notes" rows="3"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition"></textarea>
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg shadow hover:bg-indigo-700 transition">
                    Simpan Jadwal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
