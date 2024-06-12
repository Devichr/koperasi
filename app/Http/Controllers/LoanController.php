<?php

namespace App\Http\Controllers;


use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;


class LoanController extends Controller
{
    public function createStep1()
    {
        $user = Auth::user();
        return view('loans.create.step1', compact('user'));
    }

    public function storeStep1(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:users,nik,' . $user->id,
            'pekerjaan' => 'required|string|max:255',
            'golongan' => 'nullable|string|max:255',
            'gaji_perbulan' => 'required|numeric',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'no_rekening' => 'required|string|max:255',
        ]);

        if ($data['pekerjaan']==="pns") {
            /** @var \App\Models\User $user **/
    $user->update([
        'nik' => $data['nik'],
        'no_rekening' => $data['no_rekening'],
        'pekerjaan' => $data['pekerjaan'],
        'golongan' => $data['golongan'],
        'gaji_perbulan' => $data['gaji_perbulan'],
    ]);
        }else{
             /** @var \App\Models\User $user **/
    $user->update([
        'nik' => $data['nik'],
        'no_rekening' => $data['no_rekening'],
        'pekerjaan' => $data['pekerjaan'],
        'golongan' => "tidak ada",
        'gaji_perbulan' => $data['gaji_perbulan'],
    ]);
        }


        Session::put('loan_step1', $data);

        return redirect()->route('loans.step2.create');
    }

    public function createStep2()
    {
        $user = Auth::user();
        return view('loans.create.step2',compact('user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $ktpExists = !empty($user->ktp);
        $kkExists = !empty($user->kk);
        $slipGajiExists = !empty($user->slip_gaji);

        $request->validate([
            'beban_keluarga' => 'required|integer',
            'hutang_lain' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'gaji_penanggung_jawab' => 'required|numeric',
            'pekerjaan_penanggung_jawab' => 'required|string|max:255',
            'alasan_meminjam' => 'required|string|max:1000',
            'nominal_peminjaman' => 'required|numeric',
            'pengajuan_bulan' => 'required|date',
            'masa_pinjaman' => 'required|integer|in:3,6,12',
            'ktp' => $ktpExists ? 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048' : 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'kk' => $kkExists ? 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048' : 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'slip_gaji' => $slipGajiExists ? 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048' : 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $step1 = Session::get('loan_step1');

        if ($step1['pekerjaan']==="pns") {
             Loan::create([
            'memberId' => Auth::id(),
            'name' => $step1['name'],
            'nik' => $step1['nik'],
            'pekerjaan' => $step1['pekerjaan'],
            'golongan' => $step1['golongan'],
            'gaji_perbulan' => $step1['gaji_perbulan'],
            'phone' => $step1['phone'],
            'alamat' => $step1['address'],
            'no_rekening' => $step1['no_rekening'],
            'beban_keluarga' => $request->beban_keluarga,
            'hutang_lain' => $request->hutang_lain,
            'penanggung_jawab' => $request->penanggung_jawab,
            'gaji_penanggung_jawab' => $request->gaji_penanggung_jawab,
            'pekerjaan_penanggung_jawab' => $request->pekerjaan_penanggung_jawab,
            'alasan_meminjam' => $request->alasan_meminjam,
            'amount' => $request->nominal_peminjaman,
            'pengajuan_bulan' => $request->pengajuan_bulan,
            'masa_pinjaman' => $request->masa_pinjaman,
            'status' => 'pending',
            'ktp' => Auth::user()->ktp,
            'kk' => Auth::user()->kk,
            'slip_gaji' => Auth::user()->slip_gaji,
        ]);
        }
        Loan::create([
            'memberId' => Auth::id(),
            'name' => $step1['name'],
            'nik' => $step1['nik'],
            'pekerjaan' => $step1['pekerjaan'],
            'gaji_perbulan' => $step1['gaji_perbulan'],
            'phone' => $step1['phone'],
            'alamat' => $step1['address'],
            'no_rekening' => $step1['no_rekening'],
            'beban_keluarga' => $request->beban_keluarga,
            'hutang_lain' => $request->hutang_lain,
            'penanggung_jawab' => $request->penanggung_jawab,
            'gaji_penanggung_jawab' => $request->gaji_penanggung_jawab,
            'pekerjaan_penanggung_jawab' => $request->pekerjaan_penanggung_jawab,
            'alasan_meminjam' => $request->alasan_meminjam,
            'amount' => $request->nominal_peminjaman,
            'pengajuan_bulan' => $request->pengajuan_bulan,
            'masa_pinjaman' => $request->masa_pinjaman,
            'status' => 'pending',
            'ktp' => Auth::user()->ktp,
            'kk' => Auth::user()->kk,
            'slip_gaji' => Auth::user()->slip_gaji,
        ]);

        $usernameFolder = 'asset/documents/' . $user->username;

    if (!file_exists(public_path($usernameFolder))) {
        mkdir(public_path($usernameFolder), 0755, true);
    }

    // Initialize data array
 // Prepare data for updating user
    $data = $request->only(['nik', 'no_rekening', 'pekerjaan', 'gaji_perbulan']);

    // Move and update file paths if files are uploaded
    if ($request->hasFile('ktp')) {
        $ktpFile = $request->file('ktp');
        if ($ktpFile->isValid()) {
            $ktpFileName = 'ktp_' . $user->username . '.' . $ktpFile->extension();
            $ktpFilePath = $ktpFile->move(public_path($usernameFolder), $ktpFileName);
            $data['ktp'] = $usernameFolder . '/' . $ktpFileName;
        }
    } else {
        $data['ktp'] = $request->input('existing_ktp');
    }

    if ($request->hasFile('kk')) {
        $kkFile = $request->file('kk');
        if ($kkFile->isValid()) {
            $kkFileName = 'kk_' . $user->username . '.' . $kkFile->extension();
            $kkFilePath = $kkFile->move(public_path($usernameFolder), $kkFileName);
            $data['kk'] = $usernameFolder . '/' . $kkFileName;
        }
    } else {
        $data['kk'] = $request->input('existing_kk');
    }

    if ($request->hasFile('slip_gaji')) {
        $slipGajiFile = $request->file('slip_gaji');
        if ($slipGajiFile->isValid()) {
            $slipGajiFileName = 'slip_gaji_' . $user->username . '.' . $slipGajiFile->extension();
            $slipGajiFilePath = $slipGajiFile->move(public_path($usernameFolder), $slipGajiFileName);
            $data['slip_gaji'] = $usernameFolder . '/' . $slipGajiFileName;
        }
    } else {
        $data['slip_gaji'] = $request->input('existing_slip_gaji');
    }

    // Update user information
         /** @var \App\Models\User $user **/
    $user->update($data);

    Session::forget('loan_step1');

    return redirect()->route('member.dashboard')->with('success', 'Pinjaman berhasil diajukan mohon menunggu kami memverifikasi pinjaman anda');
    }
    public function showDetail($id)
{
    $loan = Loan::with('member')->findOrFail($id);
    return view('loans.partials.detail', compact('loan'));

}
}