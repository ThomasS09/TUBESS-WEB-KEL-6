<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\WorkSchedule;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        switch($user->role) {
            case 'admin':
                return $this->adminDashboard();
            case 'employee':
                return $this->employeeDashboard();
            default:
                return $this->customerDashboard();
        }
    }

    public function adminDashboard()
    {
        return view('dashboard.admin');
    }

    public function employeeDashboard()
{
    $user = Auth::user();
    $today = now()->toDateString();

    $todaySchedules = WorkSchedule::where('employee_id', $user->id)
        ->whereDate('date', $today)
        ->orderBy('date') // Ganti 'start_time' dengan kolom yang ada, misal 'date'
        ->get();

    $upcomingSchedules = WorkSchedule::where('employee_id', $user->id)
        ->whereDate('date', '>', $today)
        ->orderBy('date')
        ->limit(5)
        ->get();

    return view('dashboard.employee', compact('todaySchedules', 'upcomingSchedules'));
}

    public function customerDashboard()
    {
        $upcomingBookings = Booking::where('user_id', Auth::id())
            ->where('status', '!=', 'completed')
            ->orderBy('booking_time', 'asc')
            ->get();

        $recentBookings = Booking::where('user_id', Auth::id())
            ->orderBy('booking_time', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.customer', compact('upcomingBookings', 'recentBookings'));
    }
}