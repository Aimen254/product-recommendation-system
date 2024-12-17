<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'question_id',
        'answer',
        'order',
        'answer_type',
        'image_description'
    ];

    public function question(){
        return $this->belongsTo(Question::class);
    }
    public function logic(){
        return $this->hasOne(QuestionLogic::class,'selected_answer_id');
    }
}
