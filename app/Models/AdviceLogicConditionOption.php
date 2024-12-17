<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdviceLogicConditionOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'advice_logic_condition_id',
        'answer_id',
        'operator',
        'value',
    ];
}
