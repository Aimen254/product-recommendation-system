<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoryImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $account = getActiveAccount();
        return new Category([
            'uuid' => Str::uuid(),
            'account_id' => $account->id,
            'title' => $row['category_title'],
            'secondary_title' => $row['category_title'],
            'description' => $row['category_description'],
        ]);
    }
}