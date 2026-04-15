<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBorrowingController extends Controller
{
    public function index()
    {
        // Tampilkan buku yang sedang diajukan (pending) atau dipinjam (borrowed)
        $borrowings = Borrowing::with('book')
            ->where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'borrowed'])
            ->latest()
            ->get();
            
        return view('user.peminjaman.index', compact('borrowings'));
    }

    public function store(Request $request, Book $book)
    {
        // 1. Cek apakah stok masih ada
        if ($book->stock < 1) {
            return back()->with('error', 'Maaf, stok buku ini sedang habis.');
        }

        // 2. Cek apakah siswa masih meminjam atau dalam status pending untuk buku yang sama
        $existing = Borrowing::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->whereIn('status', ['pending', 'borrowed'])
            ->exists();

        if ($existing) {
            return back()->with('error', 'Anda masih meminjam atau sedang mengajukan peminjaman untuk buku ini.');
        }

        // 3. Buat pengajuan baru
        Borrowing::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'status' => 'pending',
            // borrow_date dan due_date belum diisi sampai disetujui admin
        ]);

        return redirect()->route('user.peminjaman')->with('success', 'Pengajuan peminjaman berhasil dikirim. Menunggu persetujuan admin.');
    }

    public function history()
    {
        // Tampilkan buku yang sudah dikembalikan (returned) atau ditolak (rejected)
        $history = Borrowing::with('book')
            ->where('user_id', Auth::id())
            ->whereIn('status', ['returned', 'rejected'])
            ->latest()
            ->get();
            
        return view('user.riwayat.index', compact('history'));
    }
}
