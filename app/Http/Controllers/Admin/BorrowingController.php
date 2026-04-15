<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Book;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        // Tampilkan semua peminjaman
        $borrowings = Borrowing::with(['user', 'book'])->latest()->get();
        return view('admin.peminjaman.index', compact('borrowings'));
    }

    public function approve(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'pending') {
            return back()->with('error', 'Hanya pengajuan dengan status pending yang dapat disetujui.');
        }

        $book = $borrowing->book;
        if ($book->stock < 1) {
            return back()->with('error', 'Gagal menyetujui: Stok buku ini sedang kosong.');
        }

        // Kurangi stok buku
        $book->decrement('stock');

        // Setujui peminjaman (status -> borrowed, assign borrow_date hari ini, due_date 14 hari)
        $borrowing->update([
            'status' => 'borrowed',
            'borrow_date' => now(),
            'due_date' => now()->addDays(14),
        ]);

        return back()->with('success', 'Peminjaman berhasil disetujui. Stok buku otomatis berkurang.');
    }

    public function reject(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'pending') {
            return back()->with('error', 'Hanya dapat menolak pengajuan pending.');
        }

        $borrowing->update(['status' => 'rejected']);

        return back()->with('success', 'Pengajuan peminjaman berhasil ditolak.');
    }

    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'borrowed') {
            return back()->with('error', 'Hanya buku yang sedang dipinjam yang dapat dikembalikan.');
        }

        // Tambah stok buku kembali
        $borrowing->book->increment('stock');

        $borrowing->update([
            'status' => 'returned',
            'return_date' => now(),
        ]);

        return back()->with('success', 'Pengembalian buku berhasil. Stok buku sudah kembali bertambah.');
    }

    public function laporan()
    {
        $borrowings = Borrowing::with(['user', 'book'])->orderBy('created_at', 'desc')->get();
        return view('admin.laporan.index', compact('borrowings'));
    }
}
