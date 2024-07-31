<?php

namespace App\Console\Commands;

use App\Models\AttemptQuiz;
use Illuminate\Console\Command;
use App\Mail\QuizAttemptReport;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Throwable;
use Illuminate\Support\Facades\Log;

class SendQuizAttemptReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:quiz-attempts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $quizzes = Quiz::all();

        foreach ($quizzes as $quiz) {

            $author = User::where('id', $quiz->user_id)->first();
    
            $attempts = AttemptQuiz::select('quiz_id', 'attempt_by')
                ->where('quiz_id', $quiz->id)
                ->whereDate('created_at', now()->toDateString())
                ->get();

            if ($attempts->count() > 0) {
                try{
                    Mail::to($author->email)->send(new QuizAttemptReport($quiz, $attempts));
                } catch(Throwable $t){
                    Log::error('mail sending fail: ' . $t->getmessage());
                }
                
            }
        }

        $this->info('Daily quiz attempt reports sent successfully.');
    }
}
