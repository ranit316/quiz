<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public $page = "question";
    public function create()
    {
        $page = $this->page;
        $quizzes = Quiz::where('user_id', auth()->user()->id)->get();
        return view('question.create', compact('page', 'quizzes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question' => 'required|string',
            'option1' => 'required|string',
            'option2' => 'required|string',
            'option3' => 'required|string',
            'option4' => 'required|string',
            'correct_answer' => 'required|in:option1,option2,option3,option4',
        ]);

        $options = [
            'option1' => $request->option1,
            'option2' => $request->option2,
            'option3' => $request->option3,
            'option4' => $request->option4,
        ];

        switch ($request->correct_answer) {
            case 'option1':
                $corr_ans = $request->option1;
                break;
            case 'option2':
                $corr_ans = $request->option2;
                break;
            case 'option3':
                $corr_ans = $request->option3;
                break;
            case 'option4':
                $corr_ans = $request->option4;
                break;
            default:
                $corr_ans = null;
                break;
        }

        //return $corr_ans;

        Question::create([
            'quiz_id' => $request->quiz_id,
            'question' => $request->question,
            'options' => json_encode($options),
            'correct_ans' => $corr_ans,
        ]);

        return redirect()->route('question.create')->with('success', 'Question added successfully.');
    }
}
