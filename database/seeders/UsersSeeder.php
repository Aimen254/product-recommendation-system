<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $superAdmin =  User::create([
            'uuid' => Str::uuid(),
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'superadmin@demo.com',
            'password' => bcrypt('12345678'),
        ]);

        $superAdmin->assignRole('Super Admin');
    }
}
