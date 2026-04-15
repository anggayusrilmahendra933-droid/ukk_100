<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Fiksi', 'slug' => 'fiksi', 'description' => 'Buku-buku fiksi dan novel'],
            ['name' => 'Non-Fiksi', 'slug' => 'non-fiksi', 'description' => 'Buku-buku non-fiksi dan biografi'],
            ['name' => 'Pelajaran', 'slug' => 'pelajaran', 'description' => 'Buku-buku teks pelajaran sekolah'],
            ['name' => 'Referensi', 'slug' => 'referensi', 'description' => 'Kamus, ensiklopedia, dan buku referensi'],
            ['name' => 'Majalah', 'slug' => 'majalah', 'description' => 'Majalah dan terbitan berkala'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
