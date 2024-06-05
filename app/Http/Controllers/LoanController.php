<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoanController extends Controller
{
    public function createStep1()
    {
        return view('loans.create.step1');
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'golongan' => 'nullable|string|max:255',
            'gaji_perbulan' => 'required|numeric',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'no_rekening' => 'required|string|max:255',
        ]);

        $data = $request->all();
        Session::put('loan_step1', $data);

        return redirect()->route('loans.step2.create');
    }

    public function createStep2()
    {
        return view('loans.create.step2');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|numeric|max:16|min:16',
            'beban_keluarga' => 'required|integer',
            'hutang_lain' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'gaji_penanggung_jawab' => 'required|numeric',
            'pekerjaan_penanggung_jawab' => 'required|string|max:255',
            'alasan_meminjam' => 'required|string|max:1000',
            'nominal_peminjaman' => 'required|numeric',
            'pengajuan_bulan' => 'required|date',
            'masa_pinjaman' => 'required|integer|in:3,6,12',
        ]);

        $step1 = Session::get('loan_step1');

        Loan::create([
            'memberId' => Auth::id(),
            'name' => $step1['name'],
            'nik' => $step1['nik'],
            'pekerjaan' => $step1['pekerjaan'],
            'golongan' => $step1['golongan'],
            'gaji_perbulan' => $step1['gaji_perbulan'],
            'phone' => $step1['phone'],
            'address' => $step1['address'],
            'no_rekening' => $step1['no_rekening'],
            'beban_keluarga' => $request->beban_keluarga,
            'hutang_lain' => $request->hutang_lain,
            'penanggung_jawab' => $request->penanggung_jawab,
            'gaji_penanggung_jawab' => $request->gaji_penanggung_jawab,
            'pekerjaan_penanggung_jawab' => $request->pekerjaan_penanggung_jawab,
            'alasan_meminjam' => $request->alasan_meminjam,
            'nominal_peminjaman' => $request->nominal_peminjaman,
            'pengajuan_bulan' => $request->pengajuan_bulan,
            'masa_pinjaman' => $request->masa_pinjaman,
            'status' => 'pending',
        ]);

        Session::forget('loan_step1');

        return redirect()->route('loans.index')->with('success', 'Loan application submitted successfully.');
    }
}