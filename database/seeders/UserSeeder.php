<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                "name" => "owner",
                "username" => "owner",
                "role" => "owner",
                "password" => bcrypt('123123123'),
                "auth_token" => base64_encode("owner")
            ],
            [
                "name" => "employee",
                "username" => "employee",
                "role" => "employee",
                "password" => bcrypt('123123123'),
                "auth_token" => base64_encode("employee")
            ]
        ]);
    }
}
