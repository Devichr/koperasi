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
                        <button onclick="loadLoanDetail('{{ route('loans.detail', $loan) }}')" class="text-blue-500 hover:text-blue-700">Lihat Detail...</button>
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
<div id="loanDetailModal" class="fixed inset-0 items-center justify-center overflow-scroll hidden bg-black bg-opacity-50">
    <div class="flex justify-center">

        <div class="bg-white p-6 rounded-lg shadow-lg w-3/4">
        <h2 class="text-2xl font-bold mb-4">Loan Detail</h2>
        <div id="loanDetailContent">
        </div><h2 class="text-xl font-bold mb-4">Data Permohonan Pinjaman</h2>
            <p><strong>Nama:</strong> {{ $loan->member->name }}</p>
            <p><strong>NIK:</strong> {{ $loan->member->nik }}</p>
            <p><strong>No. Anggota:</strong> {{ $loan->member->id }}</p>
            <p><strong>Pekerjaan:</strong> {{ $loan->member->pekerjaan }}</p>
            <p><strong>Gaji Perbulan:</strong> {{ $loan->member->gaji_perbulan }}</p>
            <p><strong>Nomor HP/Email:</strong> {{ $loan->member->email }}</p>
            <p><strong>Alamat:</strong> {{ $loan->member->alamat }}</p>
            <p><strong>No. Rekening:</strong> {{ $loan->member->no_rekening }}</p>
            <hr class="my-5">
            <h2 class="text-xl font-bold mt-6 mb-4">Data Pinjaman</h2>
            <p><strong>Beban Keluarga:</strong> {{ $loan->beban_keluarga }}</p>
            <p><strong>Hutang Lainnya:</strong> {{ $loan->hutang_lainnya }}</p>
            <p><strong>Penanggung Jawab:</strong> {{ $loan->penanggung_jawab }}</p>
            <p><strong>Gaji Penanggung Jawab:</strong> {{ $loan->gaji_penanggung_jawab }}</p>
            <p><strong>Pekerjaan Penanggung Jawab:</strong> {{ $loan->pekerjaan_penanggung_jawab }}</p>
            <p><strong>Alasan Meminjam:</strong> {{ $loan->alasan_meminjam }}</p>
            <p><strong>Nominal Peminjaman:</strong> {{ $loan->amount }}</p>
            <p><strong>Pengajuan untuk Bulan:</strong> {{ $loan->pengajuan_bulan }}</p>
            <p><strong>Masa Pinjaman:</strong> {{ $loan->masa_pinjaman }}</p>
            <hr class="my-5">
            <h2 class="text-xl font-bold mt-6 mb-4">Dokumen</h2>
            <p><strong>KTP:</strong> <a href="{{ asset('asset/'. $loan->member->ktp) }}" target="_blank">Lihat KTP</a></p>
            <p><strong>KK:</strong> <a href="{{ asset('asset/' . $loan->member->kk) }}" target="_blank">Lihat KK</a></p>
            <p><strong>Slip Gaji:</strong> <a href="{{ asset('asset/' . $loan->member->slip_gaji) }}" target="_blank">Lihat Slip Gaji</a></p>

        <button onclick="closeModal()" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded">Close</button>
        </div>
    </div>
</div>
<script>
     function openModal(content) {
        document.getElementById('loanDetailContent').innerHTML = content;
        document.getElementById('loanDetailModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('loanDetailModal').classList.add('hidden');
    }

    function loadLoanDetail(url) {
        fetch(url)
            .then(response => response.text())
            .then(data => {
                openModal(data);
            })
            .catch(error => console.error('Error loading loan detail:', error));
    }
</script>
@endsection