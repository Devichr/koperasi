<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->string('nik')->after('amount');
            $table->string('pekerjaan')->after('nik');
            $table->decimal('gaji_perbulan', 15, 2)->after('pekerjaan');
            $table->text('alamat')->after('gaji_perbulan');
            $table->string('no_rekening')->after('alamat');
            $table->integer('beban_keluarga')->after('no_rekening');
            $table->text('hutang_lain')->nullable()->after('beban_keluarga');
            $table->string('penanggung_jawab')->after('hutang_lain');
            $table->decimal('gaji_penanggung_jawab', 15, 2)->after('penanggung_jawab');
            $table->string('pekerjaan_penanggung_jawab')->after('gaji_penanggung_jawab');
            $table->text('alasan_meminjam')->after('pekerjaan_penanggung_jawab');
            $table->string('pengajuan_bulan')->after('alasan_meminjam');
            $table->integer('masa_pinjaman')->after('pengajuan_bulan');
        });
    }

    public function down()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn([
                'nik',
                'pekerjaan',
                'gaji_perbulan',
                'alamat',
                'no_rekening',
                'beban_keluarga',
                'hutang_lain',
                'penanggung_jawab',
                'gaji_penanggung_jawab',
                'pekerjaan_penanggung_jawab',
                'alasan_meminjam',
                'pengajuan_bulan',
                'masa_pinjaman'
            ]);
        });
    }
};
