<?php

namespace App\Http\Controllers;

use App\Models\WorkSchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkScheduleController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $employees = User::where('role', 'employee')->get();
        
        $upcomingSchedules = WorkSchedule::with('employee')
            ->when($user->role === 'employee', function($query) use ($user) {
                $query->where('employee_id', $user->id);
            })
            ->whereDate('date', '>=', now())
            ->orderBy('date', 'asc')
            ->get();

        return view('work-schedules.index', compact('employees', 'upcomingSchedules'));
    }

    public function create()
    {
        $employees = User::where('role', 'employee')->get();
        return view('work-schedules.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'notes' => 'nullable|string',
        ]);

        WorkSchedule::create([
            'employee_id' => $request->employee_id,
            'date' => now()->toDateString(), // Menggunakan tanggal hari ini
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'notes' => $request->notes,
        ]);

        return redirect()->route('work-schedules.index')
            ->with('success', 'Jadwal kerja berhasil ditambahkan.');
    }

    public function show(WorkSchedule $workSchedule)
    {
        $this->authorize('view', $workSchedule);
        return view('work-schedules.show', compact('workSchedule'));
    }

    public function edit(WorkSchedule $workSchedule)
    {
        $this->authorize('update', $workSchedule);
        return view('work-schedules.edit', compact('workSchedule'));
    }

    public function update(Request $request, WorkSchedule $workSchedule)
    {
        $this->authorize('update', $workSchedule);
        
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $workSchedule->update($request->all());
        return redirect()->route('work-schedules.index')->with('success', 'Work schedule updated successfully.');
    }

    public function destroy(WorkSchedule $workSchedule)
    {
        $this->authorize('delete', $workSchedule);
        $workSchedule->delete();
        return redirect()->route('work-schedules.index')->with('success', 'Work schedule deleted successfully.');
    }
}