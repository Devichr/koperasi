@extends('layouts.member')

@section('title', 'Data Permohonan Pinjaman')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Data Permohonan Pinjaman</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('loans.step1.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="nik" class="block text-gray-700 text-sm font-bold mb-2">NIK</label>
            <input type="text" name="nik" id="nik" value="{{ old('nik') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">No. Anggota</label>
            <input type="text" name="user_id" id="user_id" value="{{ Auth::user()->id }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
        </div>

        <div class="mb-4">
            <label for="pekerjaan" class="block text-gray-700 text-sm font-bold mb-2">Pekerjaan</label>
            <select name="pekerjaan" id="pekerjaan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Pilih Pekerjaan</option>
                <option value="swasta">Swasta</option>
                <option value="pns">PNS</option>
                <option value="lainnya">Lainnya</option>
            </select>
        </div>

        <div class="mb-4 hidden" id="golongan_pns">
            <label for="golongan" class="block text-gray-700 text-sm font-bold mb-2">Golongan PNS</label>
            <select name="golongan" id="golongan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Pilih Golongan</option>
                <option value="gol1">I</option>
                <option value="gol2">II</option>
                <option value="gol3">III</option>
                <option value="gol4">IV</option>
            </select>        </div>

        <div class="mb-4">
            <label for="gaji_perbulan" class="block text-gray-700 text-sm font-bold mb-2">Gaji Perbulan</label>
            <input type="text" name="gaji_perbulan" id="gaji_perbulan" value="{{ old('gaji_perbulan') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Nomor HP/Email</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', Auth::user()->phone_number) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
            <input type="text" name="address" id="address" value="{{ old('address', Auth::user()->address) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="no_rekening" class="block text-gray-700 text-sm font-bold mb-2">No Rekening</label>
            <input type="text" name="no_rekening" id="no_rekening" value="{{ old('no_rekening') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Lanjutkan
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('pekerjaan').addEventListener('change', function () {
        var golonganField = document.getElementById('golongan_pns');
        if (this.value === 'pns') {
            golonganField.classList.remove('hidden');
        } else {
            golonganField.classList.add('hidden');
        }
    });
</script>
@endsection
