<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treasurer Loans</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="container mx-auto">
        <h1>Treasurer Loans</h1>
        @if (session('success'))
            <div>{{ session('success') }}</div>
        @endif
        <ul>
            @foreach ($loans as $loan)
                <li>
                    {{ $loan->amount }} - {{ $loan->status }}
                    <form action="{{ route('treasurer.loans.submit', $loan) }}" method="POST">
                        @csrf
                        <button type="submit">Submit to Chair</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
