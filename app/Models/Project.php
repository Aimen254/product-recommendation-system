<?php

namespace App\Models;

use App\Models\Style;
use App\Models\Account;
use App\Models\Question;
use App\Models\WelcomePage;
use App\Models\ProjectSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'account_id',
        'title',
        'description',
        'image',
    ];

    public function welcomePage()
    {
        return $this->hasOne(WelcomePage::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    public function projectSetting()
    {
        return $this->hasOne(ProjectSetting::class);
    }

    public function getDefaultAdvice(){
      return $this->projectSetting()->where([
            'key' => 'default_advice'
        ]);
    }
}
