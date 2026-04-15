<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->latest()->get();
        return view('admin.buku.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.buku.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|digits:4',
            'isbn' => 'nullable|string|max:50|unique:books',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('cover_image');

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        Book::create($data);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit(Book $buku)
    {
        $categories = Category::all();
        return view('admin.buku.edit', compact('buku', 'categories'));
    }

    public function update(Request $request, Book $buku)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|digits:4',
            'isbn' => 'nullable|string|max:50|unique:books,isbn,' . $buku->id,
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('cover_image');

        if ($request->hasFile('cover_image')) {
            // Hapus gambar lama
            if ($buku->cover_image) {
                Storage::disk('public')->delete($buku->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $buku->update($data);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy(Book $buku)
    {
        if ($buku->borrowings()->whereIn('status', ['borrowed', 'pending'])->count() > 0) {
            return back()->with('error', 'Gagal: Buku ini sedang dipinjam atau dalam pengajuan.');
        }

        if ($buku->cover_image) {
            Storage::disk('public')->delete($buku->cover_image);
        }

        $buku->delete();

        return back()->with('success', 'Buku berhasil dihapus');
    }
}
