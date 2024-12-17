<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Advice;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AdviceImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $account = getActiveAccount();
        return new Advice([
            'uuid' => Str::uuid(),
            'account_id' => $account->id,
            'title' => $row['advices_title'],
            'secondary_title' => $row['advices_title'],
        ]);
    }
}