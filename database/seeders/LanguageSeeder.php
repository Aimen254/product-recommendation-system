<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = ['en' => 'english',
                      'ar' => 'arabic',
                      'fr' => 'french',
                      'nl' => 'dutch',
                      'ur' => 'urdu',
                      'tr' => 'turkish',
                      'es' => 'spanish',
                      'th' => 'thai',
                      'sv' => 'swedish',
                      'ru' => 'russian'
    ];
    foreach($languages as $key => $language){
        Language::updateOrCreate([
            'key' => $key,
            'title' => $language
        ],[
            'uuid' => Str::uuid(),
            // 'account_id' => 1,
            'status' => 'active'
        ]);
    }
    }
}