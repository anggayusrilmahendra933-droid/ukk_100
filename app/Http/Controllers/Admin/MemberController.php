<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        // Hanya ambil user dengan role 'user' (Siswa)
        $members = User::where('role', 'user')->latest()->get();
        return view('admin.anggota.index', compact('members'));
    }

    public function edit(User $anggotum) // Laravel memplesetkan "anggota" menjadi "anggotum" untuk parameter tunggal
    {
        return view('admin.anggota.edit', ['member' => $anggotum]);
    }

    public function update(Request $request, User $anggotum)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $anggotum->id,
        ]);

        $anggotum->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(User $anggotum)
    {
        // Cegah penghapusan jika ada tanggungan peminjaman
        if ($anggotum->borrowings()->whereIn('status', ['borrowed', 'pending'])->count() > 0) {
            return back()->with('error', 'Gagal: Anggota ini masih memiliki peminjaman aktif atau pending.');
        }

        $anggotum->delete();
        return back()->with('success', 'Anggota berhasil dihapus.');
    }
}
