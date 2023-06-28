<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'company_id' => '1',
            'product_name' =>'おいしいりんごジュース',
            'price' => '120',
            'stock' => '100',
            'comment' => '期間限定商品です',
            'img_path' => 'juice_orange.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Product::create([
            'company_id' => '1',
            'product_name' =>'おいしいぶどうジュース',
            'price' => '120',
            'stock' => '100',
            'comment' => '定番商品です',
            'img_path' => 'drink_grape_juice.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Product::create([
            'company_id' => '1',
            'product_name' =>'おいしいみかんジュース',
            'price' => '120',
            'stock' => '100',
            'comment' => '定番商品です',
            'img_path' => 'juice_orange.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Product::create([
            'company_id' => '2',
            'product_name' =>'農家のりんごジュース',
            'price' => '120',
            'stock' => '100',
            'comment' => '期間限定商品です',
            'img_path' => 'juice_orange.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Product::create([
            'company_id' => '2',
            'product_name' =>'農家のぶどうジュース',
            'price' => '120',
            'stock' => '100',
            'comment' => '期間限定商品です',
            'img_path' => 'drink_grape_juice.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Product::create([
            'company_id' => '2',
            'product_name' =>'農家のみかんジュース',
            'price' => '120',
            'stock' => '100',
            'comment' => '期間限定商品です',
            'img_path' => 'drink_grape_juice.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Product::create([
            'company_id' => '3',
            'product_name' =>'コーラ',
            'price' => '120',
            'stock' => '100',
            'comment' => '定番商品です',
            'img_path' => 'drink_grape_juice.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Product::create([
            'company_id' => '3',
            'product_name' =>'サイダー',
            'price' => '120',
            'stock' => '100',
            'comment' => '定番商品です',
            'img_path' => 'drink_grape_juice.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Product::create([
            'company_id' => '3',
            'product_name' =>'ジンジャエール',
            'price' => '120',
            'stock' => '100',
            'comment' => '定番商品です',
            'img_path' => 'drink_grape_juice.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Product::create([
            'company_id' => '3',
            'product_name' =>'ソーダ',
            'price' => '120',
            'stock' => '100',
            'comment' => '定番商品です',
            'img_path' =>'drink_grape_juice.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
