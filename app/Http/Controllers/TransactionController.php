<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::whereHas('booking', function($query) {
                $query->where('user_id', Auth::id());
            })
            ->with(['booking.vehicle', 'booking.service'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        $this->authorize('view', $transaction);
        return view('transactions.show', compact('transaction'));
    }
}