<?php

namespace App\Http\Controllers;

use App\Models\AttemptQuiz;
use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Models\Question;

class QuizController extends Controller
{
    public $page = "quiz";
    public function index()
    {
        $page = $this->page;
        $quizzes = Quiz::has('question')->get();
        return view('quiz.index', compact('page', 'quizzes'));
    }

    public function quiz()
    {
        $page = $this->page;
        $quizzes = Quiz::where('user_id', auth()->user()->id)->get();
        return view('quiz.quiz', compact('page', 'quizzes'));
    }

    public function create()
    {
        $page = $this->page;
        return view('quiz.insert', compact('page'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'time_limit' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $store = Quiz::create($data);
        if ($store) {
            return redirect()->route('quiz')->with('success', 'Your data Successfully added');
        } else {
            return redirect()->back()->with('failure', 'Please Provide Correct data');
        }
    }

    public function getQuestions($quizId)
    {
        //return $quizId;
        $quiz = Quiz::with('question')->where('id', $quizId)->first();
        return response()->json([
            'questions' => $quiz->question,
            'duration' => $quiz->time_limit,
        ]);
    }

    public function submitQuiz(Request $request, $quizId)
    {

        $quiz = Quiz::with('question')->findOrFail($quizId);
        $questions = $quiz->question;
        $answers = json_decode($request->input('answers'), true);
        $score = 0;
        foreach ($questions as $index => $question) {

            if (isset($answers[$index]) && $question->correct_ans == $answers[$index]) {
                $score++;
            }
        }
        $data = AttemptQuiz::create([
            'quiz_id' => $quizId,
            'attempt_by' => auth()->user()->id,
        ]);
        return response()->json(['score' => $score]);
    }
}
