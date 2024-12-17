<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $ids = explode(',', $row['category_id']);
        $account = getActiveAccount();
       return new Product([
            'uuid' => Str::uuid(),
            'account_id' => $account->id,
            'title' => $row['product_name'],
            'url' => $row['url'],
            'description' => $row['product_description'],
            'image' => 'storage/images/'.$row['image_name'],
            'code' => rand(10000, 99999),
        ]);
    }
}