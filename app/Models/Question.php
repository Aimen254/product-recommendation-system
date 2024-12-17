<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'project_id',
        'title',
        'secondary_title',
        'description',
        'order',
        'question_type',
        'choice',
        'is_multiple',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function replicateQuestion()
    {
        $clone = $this->replicate();
        $clone->uuid = Str::uuid();
        $clone->created_at = \Carbon\Carbon::now();
        $clone->push();
        foreach ($this->answers as $answer) {
            if ($answer->answer_type == "mcqs") {
                $imageDescription = $answer->image_description ? $answer->image_description : NULL;
                $answerType = $answer->answer_type ? $answer->answer_type : null;
                $answer = $answer->answer ? $answer->answer : null;
                $clone->answers()->create([
                    'answer' => $answer, 
                    'uuid' => Str::uuid(), 
                    'image_description' => $imageDescription, 
                    'answer_type' => $answerType
                ]);
            } else {
                $originalPath = storage_path('app/public/images/' . $answer->answer);
                $newFileName = 'cloned_' . $answer->answer;
                if (Storage::exists('public/images/' . $newFileName)) {
                    $newFileName = 'cloned_' . time() . '_' . $answer->answer;
                }
                Storage::copy('public/images/' . $answer->answer, 'public/images/' . $newFileName);
                $imageDescription = $answer->image_description ? $answer->image_description : NULL;
                $answerType = $answer->answer_type ? $answer->answer_type : null;
                $clone->answers()->create([
                    'answer' => $newFileName, 
                    'uuid' => Str::uuid(), 
                    'image_description' => $imageDescription, 
                    'answer_type' => $answerType
                ]);
            }
        }
        $clone->save();

        return $clone;
    }
}
