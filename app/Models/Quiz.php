<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'time_limit',
        'created_at',
        'updated_at'
    ];

    public function question()
    {
        return $this->hasMany(Question::class, 'quiz_id','id');
    }
}
