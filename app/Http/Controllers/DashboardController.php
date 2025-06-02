<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\WorkSchedule;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Service;


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
        // Statistik utama
        $todayBookings = Booking::whereDate('booking_time', Carbon::today())->count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $totalServices = Service::count();

        // Ambil 5 booking terbaru
        $recentBookings = Booking::with(['user', 'vehicle', 'service'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.admin', compact(
            'todayBookings',
            'pendingBookings',
            'totalServices',
            'recentBookings'
        ));
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