<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GiftCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['giftCategoryTitle' => 'Birthday', 'publishStatus'=>1],
            ['giftCategoryTitle' => 'Anniversary','publishStatus'=>1],
            ['giftCategoryTitle' => 'Christmas','publishStatus'=>1],
            ['giftCategoryTitle' => 'Wedding','publishStatus'=>1],
            ['giftCategoryTitle' => 'New Year','publishStatus'=>1],


        ];

        DB::table('gift_categories')->insert($categories);
    }
}
