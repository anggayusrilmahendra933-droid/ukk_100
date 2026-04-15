# Perpustakaan Digital - Aplikasi Peminjaman Buku (UKK 2025/2026)

## Overview

Aplikasi Perpustakaan Sekolah Digital berbasis web untuk memudahkan siswa dan admin dalam peminjaman dan pendataan buku. Berjalan secara lokal (localhost) menggunakan Laragon.

**Project Type:** WEB (Full-stack Laravel)

## Keputusan Desain

| Keputusan | Pilihan |
|-----------|---------|
| Tema UI | Modern clean, warm tone (amber/orange/cream) |
| Auth | Self-register + Admin bisa tambah anggota |
| Kategori Buku | Ya, kategori sederhana |
| Maks Pinjam | Tidak ada batas |
| Durasi Pinjam | Maks 14 hari, siswa bisa custom |
| Denda | Tidak ada |

## Success Criteria

- [ ] Admin bisa login, CRUD buku, CRUD kategori, kelola anggota, kelola transaksi
- [ ] Siswa bisa register, login, pinjam buku (custom durasi max 14 hari), kembalikan buku
- [ ] Pencarian buku berdasarkan judul, pengarang, kategori
- [ ] UI modern warm tone dengan Bootstrap
- [ ] Database MySQL terhubung via Laragon

## Tech Stack

| Layer | Teknologi | Alasan |
|-------|-----------|--------|
| Backend | Laravel 12 | Diminta user, MVC, Eloquent ORM |
| Frontend | Blade + Bootstrap 5 | Diminta user, cepat untuk UKK |
| Database | MySQL | Diminta user, relational |
| Auth | Laravel Breeze | Simple auth scaffolding, cocok untuk 2 role |
| Dev Server | Laragon | Diminta user, all-in-one WAMP |

## ERD (Entity Relationship Diagram)

```
┌──────────────┐     ┌──────────────┐     ┌──────────────┐
│   users      │     │  categories  │     │    books      │
├──────────────┤     ├──────────────┤     ├──────────────┤
│ id (PK)      │     │ id (PK)      │     │ id (PK)      │
│ name         │     │ name         │     │ category_id  │──→ categories.id
│ email        │     │ slug         │     │ title        │
│ password     │     │ description  │     │ author       │
│ role         │     │ created_at   │     │ publisher    │
│ phone        │     │ updated_at   │     │ year         │
│ address      │     └──────────────┘     │ isbn         │
│ created_at   │                          │ stock        │
│ updated_at   │                          │ cover_image  │
└──────┬───────┘                          │ description  │
       │                                  │ created_at   │
       │                                  │ updated_at   │
       │         ┌──────────────┐         └──────┬───────┘
       │         │  borrowings  │                │
       │         ├──────────────┤                │
       └────────→│ user_id (FK) │                │
                 │ book_id (FK) │←───────────────┘
                 │ borrow_date  │
                 │ due_date     │
                 │ return_date  │
                 │ status       │  (borrowed / returned / overdue)
                 │ created_at   │
                 │ updated_at   │
                 └──────────────┘
```

## File Structure

```
ukk-perpustakaan/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── BookController.php
│   │   │   │   ├── CategoryController.php
│   │   │   │   ├── MemberController.php
│   │   │   │   └── BorrowingController.php
│   │   │   ├── User/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── BookController.php
│   │   │   │   └── BorrowingController.php
│   │   │   └── Auth/ (via Breeze)
│   │   └── Middleware/
│   │       └── RoleMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── Book.php
│       ├── Category.php
│       └── Borrowing.php
├── database/
│   ├── migrations/
│   │   ├── xxxx_create_users_table.php (modify)
│   │   ├── xxxx_create_categories_table.php
│   │   ├── xxxx_create_books_table.php
│   │   └── xxxx_create_borrowings_table.php
│   └── seeders/
│       ├── AdminSeeder.php
│       ├── CategorySeeder.php
│       └── BookSeeder.php
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php          (main layout)
│   │   ├── admin.blade.php        (admin sidebar layout)
│   │   └── partials/
│   │       ├── navbar.blade.php
│   │       ├── sidebar.blade.php
│   │       └── footer.blade.php
│   ├── auth/
│   │   ├── login.blade.php
│   │   └── register.blade.php
│   ├── admin/
│   │   ├── dashboard.blade.php
│   │   ├── books/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── edit.blade.php
│   │   │   └── show.blade.php
│   │   ├── categories/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── edit.blade.php
│   │   ├── members/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── edit.blade.php
│   │   │   └── show.blade.php
│   │   └── borrowings/
│   │       ├── index.blade.php
│   │       └── show.blade.php
│   └── user/
│       ├── dashboard.blade.php
│       ├── books/
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       └── borrowings/
│           ├── index.blade.php
│           └── create.blade.php
├── routes/
│   └── web.php
└── public/
    ├── css/
    │   └── custom.css             (warm tone overrides)
    └── images/
        └── covers/                (book cover uploads)
```

## Task Breakdown

### Phase 1: Foundation (P0)

- [ ] **T1: Setup Laravel Project**
  - `composer create-project laravel/laravel .` di folder `ukk-perpustakaan`
  - Configure `.env` → DB_DATABASE=ukk_perpustakaan, DB_USERNAME=root, DB_PASSWORD=
  - Verify: `php artisan serve` → halaman welcome muncul

- [ ] **T2: Install Dependencies**
  - `composer require laravel/breeze --dev` → `php artisan breeze:install blade`
  - `npm install` → `npm install bootstrap @popperjs/core`
  - Configure `vite.config.js` untuk Bootstrap
  - Verify: Login/Register page muncul

- [ ] **T3: Database & Migrations**
  - Buat database `ukk_perpustakaan` di MySQL (Laragon auto-create)
  - Modifikasi `users` migration → tambah `role` (enum: admin/user), `phone`, `address`
  - Buat migration: `categories`, `books`, `borrowings`
  - `php artisan migrate`
  - Verify: Semua tabel terbuat di MySQL

- [ ] **T4: Models & Relationships**
  - `User` → hasMany(Borrowing), role accessor
  - `Category` → hasMany(Book)
  - `Book` → belongsTo(Category), hasMany(Borrowing)
  - `Borrowing` → belongsTo(User), belongsTo(Book), status scope
  - Verify: `php artisan tinker` → relasi bekerja

- [ ] **T5: Seeders**
  - `AdminSeeder` → 1 admin default (admin@perpustakaan.com / password)
  - `CategorySeeder` → 5 kategori (Fiksi, Non-Fiksi, Pelajaran, Referensi, Majalah)
  - `BookSeeder` → 10 buku sample
  - `php artisan db:seed`
  - Verify: Data muncul di database

### Phase 2: Auth & Middleware (P0)

- [ ] **T6: Role Middleware**
  - Buat `RoleMiddleware.php` → cek `auth()->user()->role`
  - Register di `bootstrap/app.php`
  - Redirect admin → `/admin/dashboard`, user → `/user/dashboard`
  - Verify: Admin tidak bisa akses halaman user & sebaliknya

- [ ] **T7: Custom Auth Flow**
  - Modifikasi register → tambah field phone & address
  - Default role = 'user' saat self-register
  - Post-login redirect berdasarkan role
  - Verify: Register sebagai user → redirect ke user dashboard

### Phase 3: Layout & UI (P1)

- [ ] **T8: Bootstrap Setup & Warm Tone Theme**
  - Setup Bootstrap 5 via Vite (import di `app.js` & `app.css`)
  - Buat `custom.css` → warm tone palette:
    - Primary: `#E67E22` (warm orange)
    - Secondary: `#F39C12` (amber)
    - Background: `#FFF8F0` (warm cream)
    - Sidebar: `#2C1810` (dark warm brown)
    - Accent: `#D35400` (deep orange)
    - Text: `#3E2723` (warm dark brown)
  - Verify: Warna warm tone teraplikasi

- [ ] **T9: Admin Layout**
  - `admin.blade.php` → sidebar + topbar layout
  - `sidebar.blade.php` → menu: Dashboard, Buku, Kategori, Anggota, Transaksi
  - Responsive sidebar (collapse di mobile)
  - Verify: Sidebar navigasi berfungsi

- [ ] **T10: User Layout**
  - `app.blade.php` → navbar layout untuk user
  - `navbar.blade.php` → menu: Dashboard, Katalog Buku, Peminjaman Saya
  - Verify: Navigasi user berfungsi

- [ ] **T11: Auth Pages Styling**
  - Style login & register pages dengan warm tone
  - Card centered, warm gradient background
  - Verify: Login/Register tampil modern & warm

### Phase 4: Admin Features (P1)

- [ ] **T12: Admin Dashboard**
  - Stats cards: Total Buku, Total Anggota, Peminjaman Aktif, Buku Tersedia
  - Tabel peminjaman terbaru (5 terakhir)
  - Verify: Dashboard menampilkan data akurat

- [ ] **T13: CRUD Buku**
  - `BookController@index` → list dengan search & filter kategori
  - `BookController@create/store` → form tambah buku + upload cover
  - `BookController@edit/update` → form edit
  - `BookController@destroy` → soft delete (cek ada peminjaman aktif)
  - Verify: CRUD buku lengkap berfungsi

- [ ] **T14: CRUD Kategori**
  - `CategoryController` → index, create, store, edit, update, destroy
  - Validasi: nama unik, tidak bisa hapus jika ada buku
  - Verify: CRUD kategori berfungsi

- [ ] **T15: Kelola Anggota**
  - `MemberController@index` → list anggota (role=user)
  - `MemberController@create/store` → admin tambah anggota baru
  - `MemberController@edit/update` → edit data anggota
  - `MemberController@destroy` → hapus (cek peminjaman aktif)
  - `MemberController@show` → detail + riwayat peminjaman
  - Verify: CRUD anggota berfungsi

- [ ] **T16: Kelola Transaksi (Admin)**
  - `BorrowingController@index` → list semua peminjaman, filter status
  - `BorrowingController@show` → detail peminjaman
  - Admin bisa konfirmasi pengembalian buku (update status + return_date)
  - Update stok buku otomatis (+1 saat kembali)
  - Verify: Flow peminjaman-pengembalian dari sisi admin berfungsi

### Phase 5: User Features (P2)

- [ ] **T17: User Dashboard**
  - Welcome card + jumlah buku dipinjam saat ini
  - List buku yang sedang dipinjam (dengan sisa hari)
  - Quick link ke katalog buku
  - Verify: Dashboard menampilkan data user yang login

- [ ] **T18: Katalog Buku (User)**
  - Grid/list view buku yang tersedia (stok > 0)
  - Search by judul, pengarang
  - Filter by kategori
  - Detail buku → info lengkap + tombol pinjam
  - Verify: User bisa browse & search buku

- [ ] **T19: Peminjaman Buku (User)**
  - Form pinjam: pilih tanggal kembali (max 14 hari dari sekarang)
  - Slider/date picker untuk durasi custom
  - Validasi: stok tersedia, tanggal valid
  - Auto kurangi stok buku (-1)
  - Verify: User bisa pinjam buku, stok berkurang

- [ ] **T20: Riwayat Peminjaman (User)**
  - List semua peminjaman user (aktif & selesai)
  - Status badge: Dipinjam (kuning), Dikembalikan (hijau), Terlambat (merah)
  - Verify: Riwayat tampil dengan status yang benar

### Phase 6: Search & Polish (P2)

- [ ] **T21: Pencarian untuk Kondisi Tertentu**
  - Admin: search buku, anggota, transaksi by keyword
  - User: search katalog by judul/pengarang/kategori
  - Filter transaksi by status (borrowed/returned/overdue)
  - Verify: Semua pencarian berfungsi akurat

- [ ] **T22: UI Polish & Responsive**
  - Pastikan semua halaman responsive (mobile-friendly)
  - Tambah animasi subtle (hover effects, transitions)
  - Flash messages untuk success/error
  - Confirm dialog untuk delete actions
  - Verify: UI consistent, responsive, warm tone

## Routes Overview

```php
// Auth (via Breeze)
GET|POST  /login
GET|POST  /register
POST      /logout

// Admin Routes (middleware: auth, role:admin)
GET       /admin/dashboard

GET       /admin/books
GET       /admin/books/create
POST      /admin/books
GET       /admin/books/{book}
GET       /admin/books/{book}/edit
PUT       /admin/books/{book}
DELETE    /admin/books/{book}

GET       /admin/categories
GET       /admin/categories/create
POST      /admin/categories
GET       /admin/categories/{category}/edit
PUT       /admin/categories/{category}
DELETE    /admin/categories/{category}

GET       /admin/members
GET       /admin/members/create
POST      /admin/members
GET       /admin/members/{member}
GET       /admin/members/{member}/edit
PUT       /admin/members/{member}
DELETE    /admin/members/{member}

GET       /admin/borrowings
GET       /admin/borrowings/{borrowing}
PUT       /admin/borrowings/{borrowing}/return

// User Routes (middleware: auth, role:user)
GET       /user/dashboard
GET       /user/books
GET       /user/books/{book}
POST      /user/borrowings
GET       /user/borrowings
```

## Phase X: Verification

- [ ] `php artisan migrate:fresh --seed` → no errors
- [ ] Login sebagai admin → akses semua menu admin
- [ ] Login sebagai user → akses katalog & peminjaman
- [ ] CRUD buku lengkap (create, read, update, delete)
- [ ] CRUD kategori lengkap
- [ ] CRUD anggota lengkap
- [ ] Flow pinjam buku → cek stok berkurang
- [ ] Flow kembalikan buku → cek stok bertambah
- [ ] Pencarian berfungsi di semua halaman
- [ ] UI responsive & warm tone konsisten
- [ ] Export database `.sql`
