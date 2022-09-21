<?php

namespace Database\Seeders;

use App\Models\Finance\AccountType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountType::create([
            "name" => "Assets"
        ]);
        AccountType::create([
            "name" => "Liabilities"
        ]);
        AccountType::create([
            "name" => "Equity"
        ]);
        AccountType::create([
            "name" => "Revenue"
        ]);
        AccountType::create([
            "name" => "Expense"
        ]);
    }
}
