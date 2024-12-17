<?php

namespace App\Models;

use App\Models\Advice;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'account_id',
        'title',
        'secondary_title',
        'description',
        'impressions',
    ];
    public function products(){
        return $this->belongsToMany(Product::class);
    }
    
    public function advices(){
        return $this->belongsToMany(Advice::class);
    }
}
