<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionLogic extends Model
{
    use HasFactory;
    protected $fillable = [
        'selected_answer_id',
        'answer',
        'question_id',
        'next_question_id',
        'question',
    ];
}
