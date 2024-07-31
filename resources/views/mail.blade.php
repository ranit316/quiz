<!DOCTYPE html>
<html>
<head>
    <title>Daily Quiz Attempt Report</title>
</head>
<body>
    <h1>Daily Quiz Attempt Report for {{ $quiz->title }}</h1>
    <p>Date: {{ now()->toDateString() }}</p>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Quiz ID</th>
                <th>Attempted By</th>
                <th>Attempted At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attempts as $attempt)
                <tr>
                    <td>{{ $attempt->quiz_id }}</td>
                    <td>{{ $attempt->attempt_by }}</td>
                    <td>{{ $attempt->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
