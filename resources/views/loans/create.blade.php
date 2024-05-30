@extends('layouts.member')
@section('title')
    Member Page
@endsection
@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Apply for a Loan</h1>

    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-400 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('loans.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
            <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Loan Amount</label>
            <input type="number" name="amount" id="amount" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Apply</button>
        </div>
    </form>
</div>
@endsection