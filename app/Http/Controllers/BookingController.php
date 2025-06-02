<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\Service;
use App\Models\Transaction; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())->get();
        $vehicles = Vehicle::where('user_id', Auth::id())->get();
        return view('bookings.index', compact('bookings', 'vehicles'));
    }

    public function create()
    {
        $vehicles = Vehicle::where('user_id', Auth::id())->get();
        $services = Service::all();
        return view('bookings.create', compact('vehicles', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'service_id' => 'required|exists:services,id',
            'booking_time' => 'required|date|after:now',
            'notes' => 'nullable|string'
        ]);

        $service = Service::findOrFail($request->service_id);
        
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $request->vehicle_id,
            'service_id' => $request->service_id,
            'booking_time' => $request->booking_time,
            'notes' => $request->notes,
            'status' => 'pending'
        ]);

        // Buat transaksi secara otomatis
        Transaction::create([
            'booking_id' => $booking->id,
            'amount' => $service->price,
            'status' => 'pending'
        ]);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking created successfully.');
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        $booking->load(['vehicle', 'service', 'transaction']);
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $this->authorize('update', $booking);

        if ($booking->status != 'pending') {
            return redirect()->route('bookings.index')->with('error', 'Only pending bookings can be modified.');
        }

        $vehicles = Vehicle::where('user_id', Auth::id())->get();
        $services = Service::all();
        return view('bookings.edit', compact('booking', 'vehicles', 'services'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'service_id' => 'required|exists:services,id',
            'booking_time' => 'required|date|after:now',
            'notes' => 'nullable|string',
        ]);

        $booking->update([
            'vehicle_id' => $request->vehicle_id,
            'service_id' => $request->service_id,
            'booking_time' => $request->booking_time,
            'notes' => $request->notes,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);

        if ($booking->status != 'pending') {
            return redirect()->route('bookings.index')->with('error', 'Only pending bookings can be cancelled.');
        }

        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking cancelled successfully.');
    }

    // Admin
    public function adminIndex()
    {
        $bookings = Booking::orderBy('booking_time', 'desc')->paginate(10);
        return view('bookings.admin-index', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',
        ]);

        $booking->update(['status' => $request->status]);

        if ($request->status == 'completed' && $booking->transaction) {
            $booking->transaction->update(['payment_status' => 'paid']);
        }

        return back()->with('success', 'Booking status updated.');
    }

    // Employee
    public function employeeTodayWork()
    {
        $todayWork = Booking::whereDate('booking_time', today())
            ->where(function ($query) {
                $query->where('status', 'confirmed')
                      ->orWhere('status', 'in_progress');
            })
            ->orderBy('booking_time')
            ->paginate(10);

        return view('bookings.employee-today', ['bookings' => $todayWork]);
    }

    public function complete(Booking $booking)
    {
        $booking->update(['status' => 'completed']);
        $booking->transaction->update(['payment_status' => 'paid']);

        return back()->with('success', 'Booking marked as completed.');
    }
}
