<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advice extends Model
{
    use HasFactory;
    protected $table = 'advices';
    protected $fillable = [
        'uuid',
        'account_id',
        'title',
        'secondary_title',
        'impressions',
    ];
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
