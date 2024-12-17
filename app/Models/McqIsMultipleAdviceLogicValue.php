<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McqIsMultipleAdviceLogicValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'advice_logic_id',
        'value_id',
    ];
    public function logic()
    {
        return $this->belongsTo(McqIsMultipleAdviceLogic::class);
    }
}
