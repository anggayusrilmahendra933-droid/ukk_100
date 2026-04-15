<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $stats = [
            'sedang_dipinjam' => Borrowing::where('user_id', $userId)->where('status', 'borrowed')->count(),
            'total_selesai'   => Borrowing::where('user_id', $userId)->where('status', 'returned')->count(),
            'terlambat'       => Borrowing::where('user_id', $userId)
                                ->where('status', 'borrowed')
                                ->where('due_date', '<', now()->format('Y-m-d'))
                                ->count(),
        ];

        $pinjamanAktif = Borrowing::with('book')
                            ->where('user_id', $userId)
                            ->whereIn('status', ['pending', 'borrowed'])
                            ->latest()
                            ->take(5)
                            ->get();

        return view('user.dashboard', compact('stats', 'pinjamanAktif'));
    }
}