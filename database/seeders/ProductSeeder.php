<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Traits\FileReaderTrait;

class ProductSeeder extends Seeder
{
    use FileReaderTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();

        // Get the data to be seeded to the table
        $url = base_path("database/data/products.csv");
        $productData = $this->readCSV($url);


        foreach($productData as $data){
            // The seeded data needs to be cleaned
            Product::create([
                'sku' => str_replace(['"','/'],'',$data['sku']),
                'name' => str_replace(['"','/'],'',$data['name']),
            ]);
        }
    }
}
