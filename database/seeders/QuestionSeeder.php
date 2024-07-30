<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions =
            [
                [
                    'quiz_id' => 1,
                    'question' => "Which country won the FIFA World Cup in 2018?",
                    'options' => json_encode([
                        'option1' => 'Brazil',
                        'option2' => 'Germany',
                        'option3' => 'France',
                        'option4' => 'Argentina',
                    ]),
                    'correct_ans' => "France",
                ],
                [
                    'quiz_id' => 1,
                    'question' => "In which sport would you perform a 'slam dunk'?",
                    'options' => json_encode([
                        'option1' => 'Baseball',
                        'option2' => 'Tennis',
                        'option3' => 'Basketball',
                        'option4' => 'Soccer',
                    ]),
                    'correct_ans' => "Basketball",
                ],
                [
                    'quiz_id' => 1,
                    'question' => "Which tennis player has won the most Grand Slam singles titles as of 2024?",
                    'options' => json_encode([
                        'option1' => 'Roger Federer',
                        'option2' => 'Rafael Nadal',
                        'option3' => 'Serena Williams',
                        'option4' => 'Novak Djokovic',
                    ]),
                    'correct_ans' => "Novak Djokovic",
                ],
                [
                    'quiz_id' => 1,
                    'question' => "What is the maximum score you can achieve in a single frame of ten-pin bowling?",
                    'options' => json_encode([
                        'option1' => '200',
                        'option2' => '300',
                        'option3' => '100',
                        'option4' => '150',
                    ]),
                    'correct_ans' => "300",
                ],
                [
                    'quiz_id' => 1,
                    'question' => "Which country is known for the sport of sumo wrestling?",
                    'options' => json_encode([
                        'option1' => 'China',
                        'option2' => 'Japan',
                        'option3' => 'South Korea',
                        'option4' => 'Mongolia',
                    ]),
                    'correct_ans' => "Japan",
                ],
                [
                    'quiz_id' => 1,
                    'question' => "Who holds the record for the most home runs in a single MLB season?",
                    'options' => json_encode([
                        'option1' => 'Babe Ruth',
                        'option2' => 'Barry Bonds',
                        'option3' => 'Hank Aaron',
                        'option4' => 'Sammy Sosa',
                    ]),
                    'correct_ans' => "Barry Bonds",
                ],
                [
                    'quiz_id' => 1,
                    'question' => "In which sport would you use a 'puck'?",
                    'options' => json_encode([
                        'option1' => 'Ice Hockey',
                        'option2' => 'Field Hockey',
                        'option3' => 'Lacrosse',
                        'option4' => 'Soccer',
                    ]),
                    'correct_ans' => "Ice Hockey",
                ],
                [
                    'quiz_id' => 1,
                    'question' => "Which NFL team won the Super Bowl in the 2022 season?",
                    'options' => json_encode([
                        'option1' => 'Kansas City Chiefs',
                        'option2' => 'Philadelphia Eagles',
                        'option3' => 'San Francisco 49ers',
                        'option4' => 'New England Patriots',
                    ]),
                    'correct_ans' => "Kansas City Chiefs",
                ],
                [
                    'quiz_id' => 1,
                    'question' => "Which athlete is known for the 'impossible angle' goal in soccer during the 2017 Champions League final?",
                    'options' => json_encode([
                        'option1' => 'Lionel Messi',
                        'option2' => 'Cristiano Ronaldo',
                        'option3' => 'Mohamed Salah',
                        'option4' => 'Kylian Mbappé',
                    ]),
                    'correct_ans' => "Cristiano Ronaldo",
                ],
                [
                    'quiz_id' => 1,
                    'question' => "In which sport would you compete in a 'decathlon'?",
                    'options' => json_encode([
                        'option1' => 'Swimming',
                        'option2' => 'Athletics',
                        'option3' => 'Cycling',
                        'option4' => 'Gymnastics',
                    ]),
                    'correct_ans' => "Athletics",
                ],
            ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}
