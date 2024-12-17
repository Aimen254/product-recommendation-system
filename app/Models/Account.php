<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'max_users',
        'status'
    ];
    
    public function settings(){
        return $this->hasOne(Setting::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'account_users')->latest();
    }
}
