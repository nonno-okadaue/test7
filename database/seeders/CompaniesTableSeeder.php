<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Company::create([
            'company_name'=> 'フルーツ王国株式会社',
            'street_address'=> '東京都港区',
	        'representative_name'=> '山田',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Company::create([
            'company_name'=> '田舎の農業有限会社',
            'street_address'=> '青森県青森市',
	        'representative_name'=> '鈴木',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Company::create([
            'company_name'=> '株式会社炭酸',
            'street_address'=> '大阪府大阪市',
	        'representative_name'=> '佐藤',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
