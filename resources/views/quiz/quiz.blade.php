@extends('layout.app')
@section('title', $page)
@section('content')

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    @if (session('failure'))
        <div class="alert alert-success mt-3">
            {{ session('failure') }}
        </div>
    @endif

    <div class="container mt-4">
        <!-- Create Quiz Button -->
        <div class="mb-4 text-end">
            <a href="{{ route('quizzes.create') }}" class="btn btn-primary">Create Quiz</a>
        </div>

        <div class="row">
            @foreach ($quizzes as $quiz)
                <div class="col-md-4">
                    <div class="dashboard-item">
                        <h5>{{ $quiz->title }}</h5>
                        <p>{{ $quiz->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
