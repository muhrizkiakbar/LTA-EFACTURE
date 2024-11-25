<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branch = [
            [
                'title' => 'Balikpapan',
                'bplId' => '3'
            ],[
                'title' => 'Samarinda',
                'bplId' => '4'
            ],[
                'title' => 'Banjarmasin',
                'bplId' => '5'
            ],[
                'title' => 'Palangkaraya',
                'bplId' => '6'
            ],[
                'title' => 'Tarakan',
                'bplId' => '8'
            ],[
                'title' => 'Berau',
                'bplId' => '4',
            ],[
                'title' => 'Sampit',
                'bplId' => '9'
            ]
        ];
        foreach ($branch as $item) {
            Branch::create([
                'title' => $item['title'],
                'bplId' => $item['bplId']
            ]);
        }
    }
}
