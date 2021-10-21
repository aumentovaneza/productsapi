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
        $url = base_path("database/data/users.csv");
        $userData = $this->readCSV($url);

        foreach($userData as $data){
          User::create([
             'name' => str_replace('"','',$data['name']),
             'email' => str_replace('"','',$data['email']),
             'password' => Hash::make(str_replace('"','',$data['password']))
          ]);
        }
    }
}
