@extends('layouts.member')

@section('title', 'Data Pinjaman')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Data Pinjaman</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('loans.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="beban_keluarga" class="block text-gray-700 text-sm font-bold mb-2">Beban Keluarga yang Ditanggung</label>
            <input type="text" name="beban_keluarga" id="beban_keluarga" value="{{ old('beban_keluarga') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4 flex gap-5">
            <div class="w-1/2">
                <label for="hutang_lain" class="block text-gray-700 text-sm font-bold mb-2">Hutang Lainnya yang Masih Ditanggung</label>
                <input type="text" name="hutang_lain" id="hutang_lain" readonly value=" {{ $user->loans->where('status','approved')->count() }} Hutang lain  " class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="w-1/2">
                <label for="hutang_lain" class="block text-gray-700 text-sm font-bold mb-2">Hutang Lainnya yang ditanggung dalam rupiah</label>
                <input type="text" name="hutang_lain" id="hutang_lain" readonly value="Rp. {{ $user->loans->where('status','approved')->sum('amount') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
        </div>

        <div class="mb-4">
            <label for="penanggung_jawab" class="block text-gray-700 text-sm font-bold mb-2">Penanggung Jawab Pinjaman</label>
            <input type="text" name="penanggung_jawab" id="penanggung_jawab" value="{{ $user->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="gaji_penanggung_jawab" class="block text-gray-700 text-sm font-bold mb-2">Gaji Penanggung Jawab</label>
            <input type="text" name="gaji_penanggung_jawab" id="gaji_penanggung_jawab" value="{{ $user->gaji_perbulan }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="pekerjaan_penanggung_jawab" class="block text-gray-700 text-sm font-bold mb-2">Pekerjaan Penanggung Jawab</label>
            <input type="text" name="pekerjaan_penanggung_jawab" id="pekerjaan_penanggung_jawab" value="{{ $user->pekerjaan }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
<div class="mb-4">
    <label for="ktp" class="block text-gray-700 text-sm font-bold mb-2">KTP</label>
    @if($user->ktp)
        <div class="mb-2">
            <a href="{{ asset($user->ktp) }}" target="_blank" class="text-blue-500 hover:underline">Lihat KTP yang sudah diunggah</a>
            <input type="hidden" name="existing_ktp" value="{{ $user->ktp }}">
        </div>
    @endif
    <input type="file" name="ktp" id="ktp" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
</div>

<div class="mb-4">
    <label for="kk" class="block text-gray-700 text-sm font-bold mb-2">KK</label>
    @if($user->kk)
        <div class="mb-2">
            <a href="{{ asset($user->kk) }}" target="_blank" class="text-blue-500 hover:underline">Lihat KK yang sudah diunggah</a>
            <input type="hidden" name="existing_kk" value="{{ $user->kk }}">
        </div>
    @endif
    <input type="file" name="kk" id="kk" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
</div>

<div class="mb-4">
    <label for="slip_gaji" class="block text-gray-700 text-sm font-bold mb-2">Slip Gaji</label>
    @if($user->slip_gaji)
        <div class="mb-2">
            <a href="{{ asset($user->slip_gaji) }}" target="_blank" class="text-blue-500 hover:underline">Lihat Slip Gaji yang sudah diunggah</a>
            <input type="hidden" name="existing_slip_gaji" value="{{ $user->slip_gaji }}">
        </div>
    @endif
    <input type="file" name="slip_gaji" id="slip_gaji" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
</div>

        <div class="mb-4">
            <label for="alasan_meminjam" class="block text-gray-700 text-sm font-bold mb-2">Alasan Meminjam</label>
            <textarea name="alasan_meminjam" id="alasan_meminjam" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('alasan_meminjam') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="nominal_peminjaman" class="block text-gray-700 text-sm font-bold mb-2">Nominal Peminjaman</label>
            <input type="text" name="nominal_peminjaman" id="nominal_peminjaman" value="{{ old('nominal_peminjaman') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="pengajuan_bulan" class="block text-gray-700 text-sm font-bold mb-2">Pengajuan untuk Bulan</label>
            <input type="month" name="pengajuan_bulan" id="pengajuan_bulan" value="{{ old('pengajuan_bulan') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="masa_pinjaman" class="block text-gray-700 text-sm font-bold mb-2">Masa Pinjaman</label>
            <select name="masa_pinjaman" id="masa_pinjaman" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Pilih Masa Pinjaman</option>
                <option value="3">3 Bulan</option>
                <option value="6">6 Bulan</option>
                <option value="12">12 Bulan</option>
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Ajukan Pinjaman
            </button>
        </div>
    </form>
</div>
@endsection
