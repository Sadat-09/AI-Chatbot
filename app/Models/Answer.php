<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    protected $fillable = ['question_id','content', 'is_ai_generated'];
    
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //
}
