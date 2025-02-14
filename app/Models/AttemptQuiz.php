<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttemptQuiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'attempt_by',
        'created_at',
        'updated_at'
    ];
}
