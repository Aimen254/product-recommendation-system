<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'page',
        'general_background',
        'image',
        'font',
        'title_color',
        'description_color',
        'button_background_color',
        'button_text_color',
        'default_advice'
    ];
}
