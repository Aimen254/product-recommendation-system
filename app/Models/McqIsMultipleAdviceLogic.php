<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McqIsMultipleAdviceLogic extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id',
        'project_id',
        'question_id',
        'answer_id',
        'product_setup_id',
    ];

    public function values()
    {
        return $this->hasMany(McqIsMultipleAdviceLogicValue::class, 'advice_logic_id');
    }
}
