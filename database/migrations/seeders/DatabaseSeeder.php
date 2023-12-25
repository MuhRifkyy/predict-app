<?php

namespace Database\Seeders;

use App\Models\Sales;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        $data['csv']= fopen("database/seeders/sales.csv", "r");
        $data['csv']= fgetcsv($data['csv']);
        while (($data['csv'] = fgetcsv($data['csv'], 1000, ",")) !== FALSE) {
            $data['csv'] = array(
                'id' => $data['csv'][0],
                'nomorcdso' => $data['csv'][1],
                'tanggal_penjualan' => $data['csv'][2],
                'customer_id' => $data['csv'][3],
            );
            Sales::insert($data['csv']);
        }
        
    }
}
