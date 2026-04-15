<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_buku' => Book::sum('stock'),
            'judul_buku' => Book::count(),
            'total_anggota' => User::where('role', 'user')->count(),
            'peminjaman_aktif' => Borrowing::where('status', 'borrowed')->count(),
            'menunggu_persetujuan' => Borrowing::where('status', 'pending')->count(),
        ];

        $pendingBorrowings = Borrowing::with(['user', 'book'])
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'pendingBorrowings'));
    }
}