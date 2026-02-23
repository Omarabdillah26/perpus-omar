<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Book;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Teknologi', 'slug' => 'teknologi'],
            ['name' => 'Bisnis', 'slug' => 'bisnis'],
            ['name' => 'Fiksi', 'slug' => 'fiksi'],
            ['name' => 'Sains', 'slug' => 'sains'],
            ['name' => 'Psikologi', 'slug' => 'psikologi'],
        ];

        foreach ($categories as $cat) {
            $category = Category::updateOrCreate(['slug' => $cat['slug']], $cat);

            if ($cat['name'] == 'Teknologi') {
                Book::updateOrCreate(
                ['isbn' => '978-1234567890'],
                [
                    'title' => 'Mastering Laravel 11',
                    'author' => 'Omar Al-Khattab',
                    'description' => 'Panduan lengkap menguasai Laravel 11 dari dasar hingga mahir.',
                    'cover_image' => 'images/books/MASTERING LARAVDEL.jpg',
                    'status' => 'available',
                    'category_id' => $category->id,
                ]
                );
                Book::updateOrCreate(
                ['isbn' => '978-0132350884'],
                [
                    'title' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
                    'author' => 'Robert C. Martin',
                    'description' => 'Prinsip-prinsip menulis kode yang bersih dan mudah dipelihara.',
                    'cover_image' => 'images/books/CLEANCODE.jpg',
                    'status' => 'available',
                    'category_id' => $category->id,
                ]
                );
            }

            if ($cat['name'] == 'Fiksi') {
                Book::updateOrCreate(
                ['isbn' => '978-0062315007'],
                [
                    'title' => 'The Alchemist',
                    'author' => 'Paulo Coelho',
                    'description' => 'Perjalanan seorang anak gembala mengejar mimpinya.',
                    'cover_image' => 'images/books/THEALCHEMIST.jpeg',
                    'status' => 'borrowed',
                    'category_id' => $category->id,
                ]
                );
            }

            if ($cat['name'] == 'Psikologi') {
                Book::updateOrCreate(
                ['isbn' => '978-0735211292'],
                [
                    'title' => 'Atomic Habits',
                    'author' => 'James Clear',
                    'description' => 'Sistem yang terbukti untuk membangun kebiasaan baik dan menghilangkan kebiasaan buruk.',
                    'cover_image' => 'images/books/ATOMICHABIT.jpg',
                    'status' => 'available',
                    'category_id' => $category->id,
                ]
                );
            }
        }
    }
}
