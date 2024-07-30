<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question',
        'options',
        'correct_ans',
        'created_at',
        'updated_at'
    ];

    public function quiz()
    {
        return $this->belongsTo(Question::class,);
    }
}
