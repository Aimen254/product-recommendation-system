<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectResponseAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_response_id',
        'answer_id',
        'answer',
        'question_id',
        'question',
        'uuid',
        'project_id' // using in joins in SurveyController for getting the product
    ];
}
