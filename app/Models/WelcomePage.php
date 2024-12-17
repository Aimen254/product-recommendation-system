<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WelcomePage extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'project_id',
        'title',
        'description',
        'button_text',
        'image'
    ];
}
