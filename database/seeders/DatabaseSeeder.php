<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            RolesAndPermissionsSeeder::class,
            UsersSeeder::class,
            GoogleFontsSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            AdviceSeeder::class,
            AccountSeeder::class,
            LanguageSeeder::class,
            TranslationSeeder::class,
            
        ]);
    }
}
