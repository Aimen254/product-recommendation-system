<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSetupValue extends Model
{
    use HasFactory;
    
    public function product() {
        return $this->belongsTo(Product::class);
    }
    
    public function productSetup() {
        return $this->belongsTo(ProductSetup::class);
    }
    public function productSelectedValues() {
        return $this->hasMany(ProductSelectedValue::class);
    }
}
