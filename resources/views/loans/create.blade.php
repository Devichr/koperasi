<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Loan</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="container mx-auto">
        <h1>Create Loan</h1>
        @if (session('success'))
            <div>{{ session('success') }}</div>
        @endif
        <form action="{{ route('loans.store') }}" method="POST">
            @csrf
            <div>
                <label for="amount">Amount</label>
                <input type="text" name="amount" id="amount" required>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>