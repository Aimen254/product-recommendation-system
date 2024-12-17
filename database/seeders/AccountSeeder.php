<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Account::create([
            'uuid' => Str::uuid(),
            'name' => 'Brabantzorg',
            'max_users' => '2',
            'status' => 'active'
        ]);
    }
}
