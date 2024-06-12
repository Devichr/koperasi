
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
        <p><strong>KTP:</strong> <a href="{{ asset($loan->member->ktp) }}" target="_blank">Lihat KTP</a></p>
        <p><strong>KK:</strong> <a href="{{ asset($loan->member->kk) }}" target="_blank">Lihat KK</a></p>
        <p><strong>Slip Gaji:</strong> <a href="{{ asset($loan->member->slip_gaji) }}" target="_blank">Lihat Slip Gaji</a></p>
        </div>