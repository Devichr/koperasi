@extends('layouts.member')
@section('title')
Dashboard
@endsection

@section('content')
        <h1 class="text-2xl font-bold mb-6">Dashboard</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Card Simpanan -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Simpanan</h2>
                <p class="text-2xl font-bold text-gray-800 mb-4">Rp. 0</p>
            </div>
            <!-- Card Pinjaman -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Pinjaman</h2>
                <p class="text-2xl font-bold text-gray-800 mb-4">Rp. {{ number_format($loans, 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="flex gap-6 justify-center items-center">
            <div onclick="location.href='{{ route('loans.create') }}'" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-full min-w-36 max-w-36 min-h-48 max-h-48 justify-center items-center">
            <img src="{{asset('asset/images/loan_12139783.png')}}" class="mt-5 h-20 w-24">
            <button  class="mt-2">Lakukan Pinjaman</button>
            </div>
            <div onclick="location.href='#'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full max-w-36 min-h-48 max-h-48 min-w-36 justify-center items-center">
                <img src="{{asset('asset/images/saving-money_9876425.png')}}" class="mt-5 h-20 w-24">
                <button  class="mt-2">Lakukan Penyimpanan</button>
            </div>
            <div onclick="location.href='#'" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full max-w-36 min-h-48 max-h-48 min-w-36 justify-center items-center">
                    <img src="{{asset('asset/images/accounts_4839441.png')}}" class="mt-5 h-20 w-24">
                    <button  class="mt-2">Bayar Pinjaman</button>
                    </div>
            </div>
    </div>
@endsection
