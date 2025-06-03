@extends('layouts.app') {{-- Pastikan layout utama sudah ada --}}

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h2 class="text-2xl font-semibold mb-4">Employee Dashboard</h2>

    <div class="bg-white rounded-xl shadow p-6">
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-1">Today's Work</h3>
            @if($todaySchedules->isEmpty())
                <p class="text-gray-600">No work scheduled for today.</p>
            @else
                <ul class="list-disc pl-6 text-gray-800">
                    @foreach($todaySchedules as $schedule)
                        <li>{{ $schedule->start_time }} - {{ $schedule->end_time }} ({{ $schedule->description }})</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-1">Upcoming Schedules</h3>
            @if($upcomingSchedules->isEmpty())
                <p class="text-gray-600">You don't have any upcoming schedules.</p>
            @else
                <ul class="list-disc pl-6 text-gray-800">
                    @foreach($upcomingSchedules as $schedule)
                        <li>{{ $schedule->date }}: {{ $schedule->start_time }} - {{ $schedule->end_time }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="flex space-x-3">
            <a href="{{ route('employee.today-work') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">TODAY'S WORK</a>
            <a href="{{ route('work-schedules.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">ADD SCHEDULE</a>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('employee.edit', Auth::user()->id) }}" class="btn btn-warning">Edit Data Karyawan</a>
    </div>
</div>
@endsection
