@extends('layouts.treasurer')
@section('title')
Dashboard
@endsection

@section('content')
<div class="container mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Treasurer Loans</h1>
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-400 rounded">
                {{ session('success') }}
            </div>
        @endif
        <ul class="space-y-4">
            @foreach ($loans as $loan)
            <li class="p-4 bg-white shadow-md rounded">
                <div class="flex justify-between">
                    <div>
                        <div><strong>Jumlah:</strong>Rp. {{ $loan->amount }}</div>
                        <div><strong>Status:</strong> {{ $loan->status }}</div>
                        <div><strong>Peminjam:</strong> {{ $loan->member->name }}</div>
                        <div><strong>Email:</strong> {{ $loan->member->email }}</div>
                        <div><strong>No Telepon:</strong> {{ $loan->member->phone_number }}</div>
                        <div>
                            <strong>Total pinjaman belum dibayar:</strong>
                            @if($loan->member->loans()->unpaid()->count() > 0)
                               Rp. {{ $loan->member->loans()->totalUnpaidAmount() }}
                            @else
                                Tidak ada
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <form action="{{ route('treasurer.loans.submit', $loan) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit to Chair</button>
                        </form>
                        <form action="{{ route('treasurer.loans.reject', $loan) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Reject</button>
                        </form>
                    </div>
                </div>
            </li>
        @endforeach
        </ul>
    </div>
</div>
@endsection