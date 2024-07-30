<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quizzes =
            [
                [
                    'user_id' => 1,
                    'title' => "sports-quiz",
                    'description' => "All about quiz Question",
                    'time_limit' => 5,

                ]
            ];

        foreach ($quizzes as $quizz) {
            Quiz::create($quizz);
        }
    }
}
