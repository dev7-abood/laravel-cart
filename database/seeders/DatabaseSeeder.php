<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Product::factory(2)->create();
        \App\Models\ProductCategory::factory(2)->create();
        \App\Models\Coupon::factory(2)->create();

        $cats = \App\Models\ProductCategory::all();
        $products = \App\Models\Product::all();
        foreach ($cats as $cat){
            foreach ($products as $product){
                DB::table('product_category_product')
                    ->insert(['product_id' => $product->id, 'p_category_id' => $cat->id]);
            }
        }

    }
}
