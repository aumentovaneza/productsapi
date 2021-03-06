<?php

namespace Database\Seeders;

use App\Models\Purchase;
use Illuminate\Database\Seeder;
use App\Traits\FileReaderTrait;

class PurchaseSeeder extends Seeder
{
    use FileReaderTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Purchase::truncate();

        // Get the data to be seeded to the table
        $url = base_path("database/data/purchased.csv");
        $purchaseData = $this->readCSV($url);

        foreach($purchaseData as $data){

            // The seeded data needs to be cleaned
            Purchase::create([
                'user_id' =>  str_replace(['"','/'],'',$data['user_id']),
                'product_sku' =>  str_replace(['"','/'],'',$data['product_sku']),
            ]);
        }
    }

}
