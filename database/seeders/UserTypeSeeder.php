<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserType::create([
            "name" => "Super Admin",
        ]);
        UserType::create([
            "name" => "Admin",
        ]);
        UserType::create([
            "name" => "User",
        ]);
    }
}
