<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Traits\FileReaderTrait;

class UserSeeder extends Seeder
{
    use FileReaderTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        // Get the data to be seeded to the table
        $url = base_path("database/data/users.csv");
        $userData = $this->readCSV($url);

        foreach($userData as $data){

            // The seeded data needs to be cleaned
            User::create([
             'name' => str_replace('"','',$data['name']),
             'email' => str_replace('"','',$data['email']),
             'password' => Hash::make(str_replace('"','',$data['password']))
          ]);
        }
    }
}
