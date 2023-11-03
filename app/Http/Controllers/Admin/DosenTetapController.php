<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\DosenTetap;
use App\Imports\DosenTetapImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use PDF;

class DosenTetapController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan'); // Get the selected month from the request
        $tahun = $request->input('tahun'); // Get the selected year from the request
    
        // Fetch distinct years from the database
        $distinctYears = DosenTetap::distinct('tahun')->pluck('tahun');
    
        $dosenTetaps = DosenTetap::where('bulan', $bulan)
                         ->where('tahun', $tahun)
                         ->get();
    
        return view('admin.import.dosentetap.index', [
            'title' => 'Dosen Tetap',
            'section' => 'Import',
            'active' => 'dosentetap',
            'dosenTetaps' => $dosenTetaps,
            'distinctYears' => $distinctYears,
        ]);
    }    

    public function store(Request $request)
    {
        // Validasi input yang didapatkan dari request
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|max:100',
            'bulan' => 'required|integer',
            'tahun' => 'required|integer',
            'nama' => 'required|string|max:100',
            'jabatan_struktural' => 'required|string|max:100',
            'jabatan_fungsional' => 'required|string|max:100',
            'gaji_pokok' => 'required|integer',
            'tunjangan_kehadiran' => 'required|integer',
            'tunjangan_jabatan_struktural' => 'required|integer',
            'tunjangan_jabatan_fungsional' => 'required|integer',
            'honor_mengajar_kls_pagi' => 'required|integer',
            'x_honor_mengajar_kls_pagi' => 'required|integer',
            'nominal_honor_mengajar_kls_pagi' => 'required|integer',
            'honor_mengajar_kls_malam' => 'required|integer',
            'x_honor_mengajar_kls_malam' => 'required|integer',
            'nominal_honor_mengajar_kls_malam' => 'required|integer',
            'pmb_atau_penguji_kp' => 'required|integer',
            'x_pmb_atau_penguji_kp' => 'required|integer',
            'nominal_pmb_atau_penguji_kp' => 'required|integer',
            'pmb_1_proposal_pagi' => 'required|integer',
            'x_pmb_1_proposal_pagi' => 'required|integer',
            'nominal_pmb_1_proposal_pagi' => 'required|integer',
            'pmb_1_proposal_malam' => 'required|integer',
            'x_pmb_1_proposal_malam' => 'required|integer',
            'nominal_pmb_1_proposal_malam' => 'required|integer',
            'pmb_1_skripsi_pagi' => 'required|integer',
            'x_pmb_1_skripsi_pagi' => 'required|integer',
            'nominal_pmb_1_skripsi_pagi' => 'required|integer',
            'pmb_1_skripsi_malam' => 'required|integer',
            'x_pmb_1_skripsi_malam' => 'required|integer',
            'nominal_pmb_1_skripsi_malam' => 'required|integer',
            'pmb_2_proposal_pagi' => 'required|integer',
            'x_pmb_2_proposal_pagi' => 'required|integer',
            'nominal_pmb_2_proposal_pagi' => 'required|integer',
            'pmb_2_proposal_malam' => 'required|integer',
            'x_pmb_2_proposal_malam' => 'required|integer',
            'nominal_pmb_2_proposal_malam' => 'required|integer',
            'pmb_2_skripsi_pagi' => 'required|integer',
            'x_pmb_2_skripsi_pagi' => 'required|integer',
            'nominal_pmb_2_skripsi_pagi' => 'required|integer',
            'pmb_2_skripsi_malam' => 'required|integer',
            'x_pmb_2_skripsi_malam' => 'required|integer',
            'nominal_pmb_2_skripsi_malam' => 'required|integer',
            'penguji_sidang_proposal' => 'required|integer',
            'x_penguji_sidang_proposal' => 'required|integer',
            'nominal_penguji_sidang_proposal' => 'required|integer',
            'penguji_sidang_skripsi' => 'required|integer',
            'x_penguji_sidang_skripsi' => 'required|integer',
            'nominal_penguji_sidang_skripsi' => 'required|integer',
            'koreksi_soal' => 'required|integer',
            'x_koreksi_soal' => 'required|integer',
            'nominal_koreksi_soal' => 'required|integer',
            'pembuatan_soal' => 'required|integer',
            'x_pembuatan_soal' => 'required|integer',
            'nominal_pembuatan_soal' => 'required|integer',
            'dosen_wali' => 'required|integer',
            'x_dosen_wali' => 'required|integer',
            'nominal_dosen_wali' => 'required|integer',
            'pengawas_ujian' => 'required|integer',
            'x_pengawas_ujian' => 'required|integer',
            'nominal_pengawas_ujian' => 'required|integer',
            'remidial' => 'required|integer',
            'x_remidial' => 'required|integer',
            'nominal_remidial' => 'required|integer',
            'pmb_company_visit' => 'required|integer',
            'x_pmb_company_visit' => 'required|integer',
            'nominal_pmb_company_visit' => 'required|integer',
            'pembina_ukm' => 'required|integer',
            'reward_ekin' => 'required|integer',
            'jumlah_gaji_tunjangan_honor' => 'required|integer',
            'potongan_kas_bon' => 'required|integer',
            'pph_21' => 'required|integer',
            'potongan_absensi' => 'required|integer',
            'potongan_bpjs' => 'required|integer',
            'jumlah' => 'required|integer',
            'gaji_yang_dibayar' => 'required|integer'
        ]);

        // kalau ada error kembalikan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cek apakah email dengan bulan dan tahun yang sama sudah ada
        $existingRecord = DosenTetap::where('email', $request->email)
            ->where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->first();
        if ($existingRecord) {
            return redirect()->back()->with('insertFail', 'Data dengan email, bulan, dan tahun yang sama sudah ada.');
        }

        // Simpan data ke database
        try {
            DB::beginTransaction();

            // insert ke tabel pegawai
            DosenTetap::create([
                'email' => $request->email,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
                'nama' => $request->nama,
                'jabatan_struktural' => $request->jabatan_struktural,
                'jabatan_fungsional' => $request->jabatan_fungsional,
                'gaji_pokok' => $request->gaji_pokok,
                'tunjangan_kehadiran' => $request->tunjangan_kehadiran,
                'tunjangan_jabatan_struktural' => $request->tunjangan_jabatan_struktural,
                'tunjangan_jabatan_fungsional' => $request->tunjangan_jabatan_fungsional,
                'honor_mengajar_kls_pagi' => $request->honor_mengajar_kls_pagi,
                'x_honor_mengajar_kls_pagi' => $request->x_honor_mengajar_kls_pagi,
                'nominal_honor_mengajar_kls_pagi' => $request->nominal_honor_mengajar_kls_pagi,
                'honor_mengajar_kls_malam' => $request->honor_mengajar_kls_malam,
                'x_honor_mengajar_kls_malam' => $request->x_honor_mengajar_kls_malam,
                'nominal_honor_mengajar_kls_malam' => $request->nominal_honor_mengajar_kls_malam,
                'pmb_atau_penguji_kp' => $request->pmb_atau_penguji_kp,
                'x_pmb_atau_penguji_kp' => $request->x_pmb_atau_penguji_kp,
                'nominal_pmb_atau_penguji_kp' => $request->nominal_pmb_atau_penguji_kp,
                'pmb_1_proposal_pagi' => $request->pmb_1_proposal_pagi,
                'x_pmb_1_proposal_pagi' => $request->x_pmb_1_proposal_pagi,
                'nominal_pmb_1_proposal_pagi' => $request->nominal_pmb_1_proposal_pagi,
                'pmb_1_proposal_malam' => $request->pmb_1_proposal_malam,
                'x_pmb_1_proposal_malam' => $request->x_pmb_1_proposal_malam,
                'nominal_pmb_1_proposal_malam' => $request->nominal_pmb_1_proposal_malam,
                'pmb_1_skripsi_pagi' => $request->pmb_1_skripsi_pagi,
                'x_pmb_1_skripsi_pagi' => $request->x_pmb_1_skripsi_pagi,
                'nominal_pmb_1_skripsi_pagi' => $request->nominal_pmb_1_skripsi_pagi,
                'pmb_1_skripsi_malam' => $request->pmb_1_skripsi_malam,
                'x_pmb_1_skripsi_malam' => $request->x_pmb_1_skripsi_malam,
                'nominal_pmb_1_skripsi_malam' => $request->nominal_pmb_1_skripsi_malam,
                'pmb_2_proposal_pagi' => $request->pmb_2_proposal_pagi,
                'x_pmb_2_proposal_pagi' => $request->x_pmb_2_proposal_pagi,
                'nominal_pmb_2_proposal_pagi' => $request->nominal_pmb_2_proposal_pagi,
                'pmb_2_proposal_malam' => $request->pmb_2_proposal_malam,
                'x_pmb_2_proposal_malam' => $request->x_pmb_2_proposal_malam,
                'nominal_pmb_2_proposal_malam' => $request->nominal_pmb_2_proposal_malam,
                'pmb_2_skripsi_pagi' => $request->pmb_2_skripsi_pagi,
                'x_pmb_2_skripsi_pagi' => $request->x_pmb_2_skripsi_pagi,
                'nominal_pmb_2_skripsi_pagi' => $request->nominal_pmb_2_skripsi_pagi,
                'pmb_2_skripsi_malam' => $request->pmb_2_skripsi_malam,
                'x_pmb_2_skripsi_malam' => $request->x_pmb_2_skripsi_malam,
                'nominal_pmb_2_skripsi_malam' => $request->nominal_pmb_2_skripsi_malam,
                'penguji_sidang_proposal' => $request->penguji_sidang_proposal,
                'x_penguji_sidang_proposal' => $request->x_penguji_sidang_proposal,
                'nominal_penguji_sidang_proposal' => $request->nominal_penguji_sidang_proposal,
                'penguji_sidang_skripsi' => $request->penguji_sidang_skripsi,
                'x_penguji_sidang_skripsi' => $request->x_penguji_sidang_skripsi,
                'nominal_penguji_sidang_skripsi' => $request->nominal_penguji_sidang_skripsi,
                'koreksi_soal' => $request->koreksi_soal,
                'x_koreksi_soal' => $request->x_koreksi_soal,
                'nominal_koreksi_soal' => $request->nominal_koreksi_soal,
                'pembuatan_soal' => $request->pembuatan_soal,
                'x_pembuatan_soal' => $request->x_pembuatan_soal,
                'nominal_pembuatan_soal' => $request->nominal_pembuatan_soal,
                'dosen_wali' => $request->dosen_wali,
                'x_dosen_wali' => $request->x_dosen_wali,
                'nominal_dosen_wali' => $request->nominal_dosen_wali,
                'pengawas_ujian' => $request->pengawas_ujian,
                'x_pengawas_ujian' => $request->x_pengawas_ujian,
                'nominal_pengawas_ujian' => $request->nominal_pengawas_ujian,
                'remidial' => $request->remidial,
                'x_remidial' => $request->x_remidial,
                'nominal_remidial' => $request->nominal_remidial,
                'pmb_company_visit' => $request->pmb_company_visit,
                'x_pmb_company_visit' => $request->x_pmb_company_visit,
                'nominal_pmb_company_visit' => $request->nominal_pmb_company_visit,
                'pembina_ukm' => $request->pembina_ukm,
                'reward_ekin' => $request->reward_ekin,
                'jumlah_gaji_tunjangan_honor' => $request->jumlah_gaji_tunjangan_honor,
                'potongan_kas_bon' => $request->potongan_kas_bon,
                'pph_21' => $request->pph_21,
                'potongan_absensi' => $request->potongan_absensi,
                'potongan_bpjs' => $request->potongan_bpjs,
                'jumlah' => $request->jumlah,
                'gaji_yang_dibayar' => $request->gaji_yang_dibayar
            ]);

            DB::commit();

            return redirect()->back()->with('insertSuccess', 'Data Berhasil di Inputkan.');

        }catch(Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('insertFail', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $dosenTetap = DosenTetap::find($id);

        if (!$dosenTetap) {
            return redirect()->back()->with('dataNotFound', 'Data tidak ditemukan');
        }

        return view('admin.import.dosentetap.edit', [
            'title' => 'Dosen Tetap',
            'secction' => 'Import',
            'active' => 'dosentetap',
            'dosenTetap' => $dosenTetap
        ]);
    }

    public function update(Request $request, $id)
    {
        $dosenTetap = DosenTetap::find($id);

        if (!$dosenTetap) {
            return redirect()->back()->with('dataNotFound', 'Data tidak ditemukan');
        }

        // validasi input yang didapatkan dari request
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:100',
            'bulan' => 'required|integer',
            'tahun' => 'required|integer',
            'nama' => 'required|string|max:100',
            'jabatan_struktural' => 'required|string|max:100',
            'jabatan_fungsional' => 'required|string|max:100',
            'gaji_pokok' => 'required|integer',
            'tunjangan_kehadiran' => 'required|integer',
            'tunjangan_jabatan_struktural' => 'required|integer',
            'tunjangan_jabatan_fungsional' => 'required|integer',
            'honor_mengajar_kls_pagi' => 'required|integer',
            'x_honor_mengajar_kls_pagi' => 'required|integer',
            'nominal_honor_mengajar_kls_pagi' => 'required|integer',
            'honor_mengajar_kls_malam' => 'required|integer',
            'x_honor_mengajar_kls_malam' => 'required|integer',
            'nominal_honor_mengajar_kls_malam' => 'required|integer',
            'pmb_atau_penguji_kp' => 'required|integer',
            'x_pmb_atau_penguji_kp' => 'required|integer',
            'nominal_pmb_atau_penguji_kp' => 'required|integer',
            'pmb_1_proposal_pagi' => 'required|integer',
            'x_pmb_1_proposal_pagi' => 'required|integer',
            'nominal_pmb_1_proposal_pagi' => 'required|integer',
            'pmb_1_proposal_malam' => 'required|integer',
            'x_pmb_1_proposal_malam' => 'required|integer',
            'nominal_pmb_1_proposal_malam' => 'required|integer',
            'pmb_1_skripsi_pagi' => 'required|integer',
            'x_pmb_1_skripsi_pagi' => 'required|integer',
            'nominal_pmb_1_skripsi_pagi' => 'required|integer',
            'pmb_1_skripsi_malam' => 'required|integer',
            'x_pmb_1_skripsi_malam' => 'required|integer',
            'nominal_pmb_1_skripsi_malam' => 'required|integer',
            'pmb_2_proposal_pagi' => 'required|integer',
            'x_pmb_2_proposal_pagi' => 'required|integer',
            'nominal_pmb_2_proposal_pagi' => 'required|integer',
            'pmb_2_proposal_malam' => 'required|integer',
            'x_pmb_2_proposal_malam' => 'required|integer',
            'nominal_pmb_2_proposal_malam' => 'required|integer',
            'pmb_2_skripsi_pagi' => 'required|integer',
            'x_pmb_2_skripsi_pagi' => 'required|integer',
            'nominal_pmb_2_skripsi_pagi' => 'required|integer',
            'pmb_2_skripsi_malam' => 'required|integer',
            'x_pmb_2_skripsi_malam' => 'required|integer',
            'nominal_pmb_2_skripsi_malam' => 'required|integer',
            'penguji_sidang_proposal' => 'required|integer',
            'x_penguji_sidang_proposal' => 'required|integer',
            'nominal_penguji_sidang_proposal' => 'required|integer',
            'penguji_sidang_skripsi' => 'required|integer',
            'x_penguji_sidang_skripsi' => 'required|integer',
            'nominal_penguji_sidang_skripsi' => 'required|integer',
            'koreksi_soal' => 'required|integer',
            'x_koreksi_soal' => 'required|integer',
            'nominal_koreksi_soal' => 'required|integer',
            'pembuatan_soal' => 'required|integer',
            'x_pembuatan_soal' => 'required|integer',
            'nominal_pembuatan_soal' => 'required|integer',
            'dosen_wali' => 'required|integer',
            'x_dosen_wali' => 'required|integer',
            'nominal_dosen_wali' => 'required|integer',
            'pengawas_ujian' => 'required|integer',
            'x_pengawas_ujian' => 'required|integer',
            'nominal_pengawas_ujian' => 'required|integer',
            'remidial' => 'required|integer',
            'x_remidial' => 'required|integer',
            'nominal_remidial' => 'required|integer',
            'pmb_company_visit' => 'required|integer',
            'x_pmb_company_visit' => 'required|integer',
            'nominal_pmb_company_visit' => 'required|integer',
            'pembina_ukm' => 'required|integer',
            'reward_ekin' => 'required|integer',
            'jumlah_gaji_tunjangan_honor' => 'required|integer',
            'potongan_kas_bon' => 'required|integer',
            'pph_21' => 'required|integer',
            'potongan_absensi' => 'required|integer',
            'potongan_bpjs' => 'required|integer',
            'jumlah' => 'required|integer',
            'gaji_yang_dibayar' => 'required|integer'
        ]);

        // kalau ada error kembalikan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{
            $dosenTetap->email = $request->email;
            $dosenTetap->bulan = $request->bulan;
            $dosenTetap->tahun = $request->tahun;
            $dosenTetap->nama = $request->nama;
            $dosenTetap->jabatan_struktural = $request->jabatan_struktural;
            $dosenTetap->jabatan_fungsional = $request->jabatan_fungsional;
            $dosenTetap->gaji_pokok = $request->gaji_pokok;
            $dosenTetap->tunjangan_kehadiran = $request->tunjangan_kehadiran;
            $dosenTetap->tunjangan_jabatan_struktural = $request->tunjangan_jabatan_struktural;
            $dosenTetap->tunjangan_jabatan_fungsional = $request->tunjangan_jabatan_fungsional;
            $dosenTetap->honor_mengajar_kls_pagi = $request->honor_mengajar_kls_pagi;
            $dosenTetap->x_honor_mengajar_kls_pagi = $request->x_honor_mengajar_kls_pagi;
            $dosenTetap->nominal_honor_mengajar_kls_pagi = $request->nominal_honor_mengajar_kls_pagi;
            $dosenTetap->honor_mengajar_kls_malam = $request->honor_mengajar_kls_malam;
            $dosenTetap->x_honor_mengajar_kls_malam = $request->x_honor_mengajar_kls_malam;
            $dosenTetap->nominal_honor_mengajar_kls_malam = $request->nominal_honor_mengajar_kls_malam;
            $dosenTetap->pmb_atau_penguji_kp = $request->pmb_atau_penguji_kp;
            $dosenTetap->x_pmb_atau_penguji_kp = $request->x_pmb_atau_penguji_kp;
            $dosenTetap->nominal_pmb_atau_penguji_kp = $request->nominal_pmb_atau_penguji_kp;
            $dosenTetap->pmb_1_proposal_pagi = $request->pmb_1_proposal_pagi;
            $dosenTetap->x_pmb_1_proposal_pagi = $request->x_pmb_1_proposal_pagi;
            $dosenTetap->nominal_pmb_1_proposal_pagi = $request->nominal_pmb_1_proposal_pagi;
            $dosenTetap->pmb_1_proposal_malam = $request->pmb_1_proposal_malam;
            $dosenTetap->x_pmb_1_proposal_malam = $request->x_pmb_1_proposal_malam;
            $dosenTetap->nominal_pmb_1_proposal_malam = $request->nominal_pmb_1_proposal_malam;
            $dosenTetap->pmb_1_skripsi_pagi = $request->pmb_1_skripsi_pagi;
            $dosenTetap->x_pmb_1_skripsi_pagi = $request->x_pmb_1_skripsi_pagi;
            $dosenTetap->nominal_pmb_1_skripsi_pagi = $request->nominal_pmb_1_skripsi_pagi;
            $dosenTetap->pmb_1_skripsi_malam = $request->pmb_1_skripsi_malam;
            $dosenTetap->x_pmb_1_skripsi_malam = $request->x_pmb_1_skripsi_malam;
            $dosenTetap->nominal_pmb_1_skripsi_malam = $request->nominal_pmb_1_skripsi_malam;
            $dosenTetap->pmb_2_proposal_pagi = $request->pmb_2_proposal_pagi;
            $dosenTetap->x_pmb_2_proposal_pagi = $request->x_pmb_2_proposal_pagi;
            $dosenTetap->nominal_pmb_2_proposal_pagi = $request->nominal_pmb_2_proposal_pagi;
            $dosenTetap->pmb_2_proposal_malam = $request->pmb_2_proposal_malam;
            $dosenTetap->x_pmb_2_proposal_malam = $request->x_pmb_2_proposal_malam;
            $dosenTetap->nominal_pmb_2_proposal_malam = $request->nominal_pmb_2_proposal_malam;
            $dosenTetap->pmb_2_skripsi_pagi = $request->pmb_2_skripsi_pagi;
            $dosenTetap->x_pmb_2_skripsi_pagi = $request->x_pmb_2_skripsi_pagi;
            $dosenTetap->nominal_pmb_2_skripsi_pagi = $request->nominal_pmb_2_skripsi_pagi;
            $dosenTetap->pmb_2_skripsi_malam = $request->pmb_2_skripsi_malam;
            $dosenTetap->x_pmb_2_skripsi_malam = $request->x_pmb_2_skripsi_malam;
            $dosenTetap->nominal_pmb_2_skripsi_malam = $request->nominal_pmb_2_skripsi_malam;
            $dosenTetap->penguji_sidang_proposal = $request->penguji_sidang_proposal;
            $dosenTetap->x_penguji_sidang_proposal = $request->x_penguji_sidang_proposal;
            $dosenTetap->nominal_penguji_sidang_proposal = $request->nominal_penguji_sidang_proposal;
            $dosenTetap->penguji_sidang_skripsi = $request->penguji_sidang_skripsi;
            $dosenTetap->x_penguji_sidang_skripsi = $request->x_penguji_sidang_skripsi;
            $dosenTetap->nominal_penguji_sidang_skripsi = $request->nominal_penguji_sidang_skripsi;
            $dosenTetap->koreksi_soal = $request->koreksi_soal;
            $dosenTetap->x_koreksi_soal = $request->x_koreksi_soal;
            $dosenTetap->nominal_koreksi_soal = $request->nominal_koreksi_soal;
            $dosenTetap->pembuatan_soal = $request->pembuatan_soal;
            $dosenTetap->x_pembuatan_soal = $request->x_pembuatan_soal;
            $dosenTetap->nominal_pembuatan_soal = $request->nominal_pembuatan_soal;
            $dosenTetap->dosen_wali = $request->dosen_wali;
            $dosenTetap->x_dosen_wali = $request->x_dosen_wali;
            $dosenTetap->nominal_dosen_wali = $request->nominal_dosen_wali;
            $dosenTetap->pengawas_ujian = $request->pengawas_ujian;
            $dosenTetap->x_pengawas_ujian = $request->x_pengawas_ujian;
            $dosenTetap->nominal_pengawas_ujian = $request->nominal_pengawas_ujian;
            $dosenTetap->remidial = $request->remidial;
            $dosenTetap->x_remidial = $request->x_remidial;
            $dosenTetap->nominal_remidial = $request->nominal_remidial;
            $dosenTetap->pmb_company_visit = $request->pmb_company_visit;
            $dosenTetap->x_pmb_company_visit = $request->x_pmb_company_visit;
            $dosenTetap->nominal_pmb_company_visit = $request->nominal_pmb_company_visit;
            $dosenTetap->pembina_ukm = $request->pembina_ukm;
            $dosenTetap->reward_ekin = $request->reward_ekin;
            $dosenTetap->jumlah_gaji_tunjangan_honor = $request->jumlah_gaji_tunjangan_honor;
            $dosenTetap->potongan_kas_bon = $request->potongan_kas_bon;
            $dosenTetap->pph_21 = $request->pph_21;
            $dosenTetap->potongan_absensi = $request->potongan_absensi;
            $dosenTetap->potongan_bpjs = $request->potongan_bpjs;
            $dosenTetap->jumlah = $request->jumlah;
            $dosenTetap->gaji_yang_dibayar = $request->gaji_yang_dibayar;

            $dosenTetap->save();

            return redirect()->route('dosentetap', ['bulan' => $request->bulan, 'tahun' => $request->tahun])->with('updateSuccess', 'Data berhasil di Update');
        } catch(Exception $e) {
            dd($e);
            return redirect()->back()->with('updateFail', 'Data gagal di Update');
        }
    }

    public function destroy($id)
    {
        // Cari data pengguna berdasarkan ID
        $dosenTetap = DosenTetap::find($id);

        try {
            // Hapus data pengguna
            $dosenTetap->delete();
            return redirect()->back()->with('deleteSuccess', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('deleteFail', $e->getMessage());
        }
    }

    public function showImportForm()
    {
        return view('import'); // Menampilkan tampilan untuk mengunggah file Excel
    }

    public function importExcel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'excel_file' => 'required|mimes:xls,xlsx',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $file = $request->file('excel_file');

        // Validasi Data duplikat atau dengan email & bulan & tahun yang sama sebelum di impor
        $import = new DosenTetapImport;
        $rows = Excel::toCollection($import, $file)->first();

        $duplicateEntries = [];

        foreach ($rows as $row) {
            $email = $row['email'];
            $bulan = $row['bulan'];
            $tahun = $row['tahun'];

            // Periksa apakah kombinasi email, bulan, dan tahun sudah ada di database
            if (DosenTetap::where('email', $email)->where('bulan', $bulan)->where('tahun', $tahun)->exists()) {
                $duplicateEntries[] = "Email: $email, Bulan: $bulan, Tahun: $tahun";
            }
        }

        if (!empty($duplicateEntries)) {
            $errorMessage = 'Data dengan email, bulan, dan tahun yang sama sudah ada:';
            foreach ($duplicateEntries as $entry) {
                $errorMessage .= "$entry";
            }

            return redirect()->back()->with('importError', $errorMessage);
        }
        // END Validasi Data duplikat atau dengan email & bulan & tahun yang sama sebelum di impor
    
        DB::beginTransaction(); // Memulai transaksi database
    
        try {
            Excel::import($import, $file);
    
            DB::commit(); // Jika tidak ada kesalahan, lakukan commit untuk menyimpan perubahan ke database
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            DB::rollBack(); // Rollback jika terjadi kesalahan validasi
            $failures = $e->failures();
            $errorMessages = [];
    
            foreach ($failures as $failure) {
                $rowNumber = $failure->row();
                $column = $failure->attribute();
                $errorMessages[] = "Baris $rowNumber, Kolom $column: " . implode(', ', $failure->errors());
            }
            // Simpan detail kesalahan validasi dalam sesi
            return redirect()->back()
                ->with('importValidationFailures', $failures)
                ->with('importErrors', $errorMessages)
                ->withInput();
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika terjadi kesalahan umum selama impor
            return redirect()->back()->with('importError', 'Terjadi kesalahan selama impor. Silakan coba lagi.');
        }
    
        return redirect()->back()->with('importSuccess', 'Data berhasil diimpor.');
    }

    public function downloadExampleExcel()
    {
        $filePath = public_path('contoh-excel/dosentetap.xlsx'); // Sesuaikan dengan path file Excel contoh Anda
    
        if (file_exists($filePath)) {
            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];
    
            return response()->download($filePath, 'dosentetap.xlsx', $headers);
        } else {
            return redirect()->back()->with('downloadFail', 'File contoh tidak ditemukan.');
        }
    } 

    // Metode untuk menampilkan slip gaji keseluruhan
    public function exportPdf($bulan, $tahun)
    {
        $data = DosenTetap::where('bulan', $bulan)
                      ->where('tahun', $tahun)
                      ->get();
    
        return view('admin.import.dosentetap.printslip', [
            'title' => 'Dosen Tetap',
            'section' => 'Import',
            'active' => 'dosentetap',
            'data' => $data
            ]);
    }

    // Metode untuk menampilkan slip gaji berdasarkan ID Pegawai
    public function exportPdfbyid($id)
    {
        $data = DosenTetap::where('id', $id)->get();

        if ($data->isEmpty()) {
            return redirect()->back()->with('error', 'Data Pegawai tidak ditemukan.');
        }

        return view('admin.import.dosentetap.printslip', [
            'title' => 'Dosen Tetap',
            'section' => 'Import',
            'active' => 'dosentetap',
            'data' => $data
            ]);
    }
}
