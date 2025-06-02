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
        // Make sure you're using the correct column name
        $upcomingSchedules = WorkSchedule::where('employee_id', Auth::id())
            ->whereDate('date', '>=', now())
            ->orderBy('date', 'asc')
            ->get();

        return view('dashboard.employee', compact('upcomingSchedules'));
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