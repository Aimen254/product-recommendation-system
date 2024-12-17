<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\TranslationLoader\LanguageLine;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $translations = [

            [
                'group' => 'welcome',
                'key' => 'logo',
                'text' => json_encode(['en' => 'Logo', 'fr' => 'Logo']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'welcome',
                'key' => 'title',
                'text' => json_encode(['en' => 'Title']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'welcome',
                'key' => 'description',
                'text' => json_encode(['en' => 'Description']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'welcome',
                'key' => 'button_text',
                'text' => json_encode(['en' => 'Botton Text']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'queation',
                'key' => 'add_questions',
                'text' => json_encode(['en' => 'Add Questions']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'queation',
                'key' => 'title',
                'text' => json_encode(['en' => 'Title']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'queation',
                'key' => 'secondry_title',
                'text' => json_encode(['en' => 'Secondry Title']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'queation',
                'key' => 'description',
                'text' => json_encode(['en' => 'Description']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'queation',
                'key' => 'optional',
                'text' => json_encode(['en' => 'Optional']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'product',
                'key' => 'add_product',
                'text' => json_encode(['en' => 'Add New Product']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'product',
                'key' => 'product_image',
                'text' => json_encode(['en' => 'Product Image']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'product',
                'key' => 'product_title',
                'text' => json_encode(['en' => 'Product Title']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'product',
                'key' => 'product_description',
                'text' => json_encode(['en' => 'Product Description']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'product',
                'key' => 'product_url',
                'text' => json_encode(['en' => 'Product url']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],

            [
                'group' => 'category',
                'key' => 'add_category',
                'text' => json_encode(['en' => 'Add New Category']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'category',
                'key' => 'category_title',
                'text' => json_encode(['en' => 'Category Title']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'category',
                'key' => 'category_secondary_title',
                'text' => json_encode(['en' => 'Category Secondary Title']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'category',
                'key' => 'category_description',
                'text' => json_encode(['en' => 'Category Description']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'category',
                'key' => 'select_products',
                'text' => json_encode(['en' => 'Select Products']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'advice',
                'key' => 'add_advice',
                'text' => json_encode(['en' => 'Add New Advice']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'advice',
                'key' => 'advice_title',
                'text' => json_encode(['en' => 'Advice Title']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'advice',
                'key' => 'advice_secondary_title',
                'text' => json_encode(['en' => 'Advice Secondary Title']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'advice',
                'key' => 'select_categories',
                'text' => json_encode(['en' => 'Select Categories']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'group' => 'project',
                'key' => 'view_project',
                'text' => json_encode(['en' => 'View Project']),
                'account_id' => 1,
                'created_at' => Carbon::now(),
            ],
        ];

        LanguageLine::insert($translations);
    }
}
