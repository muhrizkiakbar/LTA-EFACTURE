<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'id_erp' => '1', 
            'label' => 'LTA', 
            'description' => 'PT Laut Timur Ardiprima',
        ]);

        Company::create([
            'id_erp' => '2', 
            'label' => 'TAA', 
            'description' => 'PT Trijaya Adhiraja Abadi',
        ]);
    }
}
