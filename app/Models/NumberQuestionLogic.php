<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumberQuestionLogic extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'next_question_id',
        'firstValue',
        'secondValue',
        'firstOperator',
        'selected_question_id',
    ];

}