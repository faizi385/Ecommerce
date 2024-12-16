<?php

namespace Database\Seeders;

use DiscountCodesSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Seed the categories table.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Men'],
            ['name' => 'Women'],
            ['name' => 'Kids'],
        ];

        DB::table('categories')->insert($categories);

        $this->call(DiscountCodesSeeder::class);
    }
}
