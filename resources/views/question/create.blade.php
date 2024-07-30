@extends('layout.app')
@section('title', 'Create Question')
@section('content')

<div class="container mt-4">
    <h2>Create New Question</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form method="POST" action="{{ route('questions.store') }}">
        @csrf
        <div class="mb-3">
            <label for="quiz_id" class="form-label">Select Quiz</label>
            <select class="form-control @error('quiz_id') is-invalid @enderror" id="quiz_id" name="quiz_id" required>
                <option value="">Choose...</option>
                @foreach($quizzes as $quiz)
                    <option value="{{ $quiz->id }}" {{ old('quiz_id') == $quiz->id ? 'selected' : '' }}>{{ $quiz->title }}</option>
                @endforeach
            </select>
            @error('quiz_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="question" class="form-label">Question</label>
            <input type="text" class="form-control @error('question') is-invalid @enderror" id="question" name="question" value="{{ old('question') }}" required>
            @error('question')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="option1" class="form-label">Option 1</label>
            <input type="text" class="form-control @error('option1') is-invalid @enderror" id="option1" name="option1" value="{{ old('option1') }}" required>
            @error('option1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="option2" class="form-label">Option 2</label>
            <input type="text" class="form-control @error('option2') is-invalid @enderror" id="option2" name="option2" value="{{ old('option2') }}" required>
            @error('option2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="option3" class="form-label">Option 3</label>
            <input type="text" class="form-control @error('option3') is-invalid @enderror" id="option3" name="option3" value="{{ old('option3') }}" required>
            @error('option3')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="option4" class="form-label">Option 4</label>
            <input type="text" class="form-control @error('option4') is-invalid @enderror" id="option4" name="option4" value="{{ old('option4') }}" required>
            @error('option4')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="correct_answer" class="form-label">Correct Answer</label>
            <select class="form-control @error('correct_answer') is-invalid @enderror" id="correct_answer" name="correct_answer" required>
                <option value="">Choose...</option>
                <option value="option1" {{ old('correct_answer') == 'option1' ? 'selected' : '' }}>Option 1</option>
                <option value="option2" {{ old('correct_answer') == 'option2' ? 'selected' : '' }}>Option 2</option>
                <option value="option3" {{ old('correct_answer') == 'option3' ? 'selected' : '' }}>Option 3</option>
                <option value="option4" {{ old('correct_answer') == 'option4' ? 'selected' : '' }}>Option 4</option>
            </select>
            @error('correct_answer')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save Question</button>
    </form>
</div>

@endsection
