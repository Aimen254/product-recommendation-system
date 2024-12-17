<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectResponse extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'uuid',
        'advice_id',
        'finished'
    ];

    public function project(){
        return $this->belongsTo(Project::class);
    }
    public function answers(){
        return  $this->hasMany(ProjectResponseAnswer::class);
    }
    public function advice(){
        return $this->belongsTo(Advice::class);
    }
}
