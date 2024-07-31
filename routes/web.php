<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [QuizController::class, 'index'])->name('quiz.index');
Route::get('/admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'postlogin'])->name('admin.login');
Route::get('/admin/register', [AuthController::class, 'register'])->name('admin.register');
Route::post('/admin/register', [AuthController::class, 'store'])->name('admin.register');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/quiz', [QuizController::class, 'quiz'])->name('quiz');
    Route::get('/admin/quiz/create', [QuizController::class, 'create'])->name('quizzes.create');
    Route::post('/admin/quiz/store', [QuizController::class, 'store'])->name('quizzes.store');
    Route::get('/admin/question', [QuestionController::class, 'create'])->name('question.create');
    Route::post('admin/store', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('quizzes/{quiz}/questions', [QuizController::class, 'getQuestions']);
    Route::post('quizzes/{quiz}/submit', [QuizController::class, 'submitQuiz']);
    Route::get('/admin/logout', [AuthController::class, 'adminlogout'])->name('admin.logout');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
