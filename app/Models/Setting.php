<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'account_id',
        'company_name',
        'logo',
        'favicon',
        'custom_domain',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($model) {
            if (!$model->uuid) {
                // only set a UUID on first creation and if not already set
                $model->uuid = Str::uuid();
            }
        });
    }
}
