<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    
    public function dashboard()
    {
        $todayBookings = Booking::whereDate('booking_time', Carbon::today())->count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $totalRevenue = Transaction::where('status', 'paid')->sum('amount');
        $totalServices = Service::count();
        $recentBookings = Booking::with(['user', 'vehicle', 'service'])
            ->latest()
            ->take(5)
            ->get();
    
        return view('dashboard.admin', compact(
            'todayBookings',
            'pendingBookings',
            'totalRevenue',
            'totalServices',
            'recentBookings'
        ));
    }

    // Manajemen Layanan
    public function services()
    {
        $services = Service::withCount('bookings')->orderBy('name')->get();
        return view('admin.services', compact('services'));
    }

    public function storeService(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1'
        ]);

        Service::create($request->all());
        return redirect()->route('admin.services')->with('success', 'Layanan berhasil ditambahkan');
    }

    public function updateService(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1'
        ]);

        $service->update($request->all());
        return redirect()->route('admin.services')->with('success', 'Layanan berhasil diupdate');
    }

    public function deleteService(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services')->with('success', 'Layanan berhasil dihapus');
    }

    // Manajemen Booking
   

    public function updateBookingStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled'
        ]);

        $booking->update(['status' => $request->status]);

        if ($request->status === 'completed') {
            $booking->transaction()->update(['status' => 'paid']);
        }

        return back()->with('success', 'Status booking berhasil diupdate');
    }

    // Laporan
    public function reports()
    {
        $data = [
            'monthly_revenue' => Transaction::where('status', 'paid')
                ->selectRaw('MONTH(created_at) as month, SUM(amount) as total')
                ->groupBy('month')
                ->orderBy('month')
                ->get(),
            'service_stats' => Service::withCount(['bookings' => function($query) {
                $query->whereHas('transaction', function($q) {
                    $q->where('status', 'paid');
                });
            }])->get(),
            'daily_bookings' => Booking::whereMonth('created_at', Carbon::now()->month)
                ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
                ->groupBy('date')
                ->orderBy('date')
                ->get()
        ];

        return view('admin.reports', $data);
    }

    // Statistik
    public function statistics()
    {
        $data = [
            'daily_stats' => Booking::selectRaw('DATE(created_at) as date, COUNT(*) as total')
                ->groupBy('date')
                ->orderBy('date', 'DESC')
                ->limit(30)
                ->get(),
            'service_popularity' => Service::withCount('bookings')
                ->orderBy('bookings_count', 'desc')
                ->get(),
            'customer_growth' => User::where('role', 'customer')
                ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
                ->groupBy('date')
                ->orderBy('date', 'DESC')
                ->limit(30)
                ->get()
        ];

        return view('admin.statistics', $data);
    }
}