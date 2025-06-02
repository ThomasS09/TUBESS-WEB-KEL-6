<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['booking.service'])
            ->when(Auth::user()->role === 'customer', function($query) {
                return $query->whereHas('booking', function($q) {
                    $q->where('user_id', Auth::id());
                });
            })
            ->latest()
            ->paginate(10);

        return view('transactions.index', compact('transactions'));
    }
}