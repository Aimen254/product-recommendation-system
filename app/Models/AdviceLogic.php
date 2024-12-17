<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdviceLogic extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'project_id',
        'advice_id',
    ];

    public function conditions(){
        return $this->hasMany(AdviceLogicCondition::class);
    }
    public function advice(){
        return $this->belongsTo(Advice::class);
    }
}
