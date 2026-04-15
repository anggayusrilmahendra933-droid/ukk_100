<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'category_id' => 1,
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'publisher' => 'Bentang Pustaka',
                'year' => 2005,
                'isbn' => '979-3062-79-7',
                'stock' => 5,
                'description' => 'Kisah anak-anak Belitong',
            ],
            [
                'category_id' => 3,
                'title' => 'Pemrograman Web Fundamental',
                'author' => 'Budi Raharjo',
                'publisher' => 'Informatika',
                'year' => 2020,
                'isbn' => '978-623-7131',
                'stock' => 10,
                'description' => 'Pemrograman web PHP, HTML, CSS, JS',
            ],
            [
                'category_id' => 2,
                'title' => 'Sapiens',
                'author' => 'Yuval Noah Harari',
                'publisher' => 'KPG',
                'year' => 2011,
                'isbn' => '978-602-481-6',
                'stock' => 3,
                'description' => 'Sejarah singkat umat manusia',
            ],
            [
                'category_id' => 4,
                'title' => 'Kamus Besar Bahasa Indonesia',
                'author' => 'Kemdikbud',
                'publisher' => 'Balai Pustaka',
                'year' => 2018,
                'isbn' => '978-979-408',
                'stock' => 2,
                'description' => 'Kamus referensi KBBI',
            ]
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
