<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Doctrine\DBAL\Schema\Schema;
use App\Models\ProductProductSetup;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'account_id',
        'title',
        'description',
        'url',
        'image',
        'code',
        'impressions',
    ];
    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function productSetupValues(){
        return $this->hasMany(ProductSetupValue::class);
    }

    public function productSelectedValues() {
        return $this->hasMany(ProductSelectedValue::class);
    }
}
