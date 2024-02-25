<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // カテゴリーデータを挿入
        $categories = [
            ['category' => 'バックエンド'],
            ['category' => 'フロントエンド'],
            ['category' => 'インフラ'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert($category);
        }
    }
}
