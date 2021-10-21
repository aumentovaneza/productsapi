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
        $url = base_path("database/data/products.csv");

        $productData = $this->readCSV($url);

        foreach($productData as $data){
            Product::create([
                'sku' => str_replace(['"','/'],'',$data['sku']),
                'name' => str_replace(['"','/'],'',$data['name']),
            ]);
        }
    }
}
