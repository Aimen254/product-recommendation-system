<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Backend\ProductSetupController;

class ProductSetup extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'uuid',
        'account_id',
        'field',
        'value',
        'type',
        'validation',
        'is_list',
        'list_values',
    ];

    public function productSetupValues() {
        return $this->hasMany(ProductSetupValue::class);
    }

    public function productSelectedValues() {
        return $this->hasMany(ProductSelectedValue::class);
    }
}
