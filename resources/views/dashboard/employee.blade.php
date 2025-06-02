<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($upcomingSchedules->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($upcomingSchedules as $schedule)
                                <div class="border rounded-lg p-4">
                                    <h3 class="font-medium">Schedule for {{ $schedule->date->format('d M Y') }}</h3>
                                    <p>{{ $schedule->start_time }} - {{ $schedule->end_time }}</p>
                                    @if($schedule->notes)
                                        <p class="text-sm text-gray-600 mt-2">{{ $schedule->notes }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No upcoming schedules found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>