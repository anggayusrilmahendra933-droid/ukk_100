<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\BorrowingController as AdminBorrowingController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\UserBookController;
use App\Http\Controllers\User\UserBorrowingController;

/*
|--------------------------------------------------------------------------
| Homepage
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Authentication Pages
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin Area
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Kelola Kategori & Buku
    Route::resource('kategori', CategoryController::class);
    Route::resource('buku', BookController::class);
    
    // Kelola Anggota
    Route::resource('anggota', MemberController::class)->except(['create', 'store', 'show']);
    
    // Peminjaman & Laporan
    Route::get('/peminjaman', [AdminBorrowingController::class, 'index'])->name('peminjaman.index');
    Route::post('/peminjaman/{borrowing}/approve', [AdminBorrowingController::class, 'approve'])->name('peminjaman.approve');
    Route::post('/peminjaman/{borrowing}/return', [AdminBorrowingController::class, 'returnBook'])->name('peminjaman.return');
    Route::post('/peminjaman/{borrowing}/reject', [AdminBorrowingController::class, 'reject'])->name('peminjaman.reject');
    
    Route::get('/laporan', [AdminBorrowingController::class, 'laporan'])->name('laporan');
});

/*
|--------------------------------------------------------------------------
| User / Siswa Area
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    
    // Koleksi & Peminjaman
    Route::get('/buku', [UserBookController::class, 'index'])->name('buku');
    Route::post('/buku/{book}/pinjam', [UserBorrowingController::class, 'store'])->name('buku.pinjam');
    
    Route::get('/peminjaman', [UserBorrowingController::class, 'index'])->name('peminjaman');
    Route::get('/riwayat', [UserBorrowingController::class, 'history'])->name('riwayat');
});