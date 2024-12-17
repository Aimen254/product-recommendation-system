<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdviceLogicCondition extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'advice_logic_id',
        'question_id',
        'condition',
    ];

    public function options(){
        return $this->hasMany(AdviceLogicConditionOption::class);
    }
    public function question(){
        return $this->belongsTo(Question::class);
    }
}
