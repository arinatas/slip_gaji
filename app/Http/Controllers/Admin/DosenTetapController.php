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
            'honor_mengajar_kls_malam' => 'required|integer',
            'pmb_atau_penguji_kp' => 'required|integer',
            'pmb_1_proposal_pagi' => 'required|integer',
            'pmb_1_proposal_malam' => 'required|integer',
            'pmb_1_skripsi_pagi' => 'required|integer',
            'pmb_1_skripsi_malam' => 'required|integer',
            'pmb_2_proposal_pagi' => 'required|integer',
            'pmb_2_proposal_malam' => 'required|integer',
            'pmb_2_skripsi_pagi' => 'required|integer',
            'pmb_2_skripsi_malam' => 'required|integer',
            'penguji_sidang_proposal' => 'required|integer',
            'penguji_sidang_skripsi' => 'required|integer',
            'koreksi_soal' => 'required|integer',
            'pembuatan_soal' => 'required|integer',
            'dosen_wali' => 'required|integer',
            'pengawas_ujian' => 'required|integer',
            'pembina_ukm' => 'required|integer',
            'remidial' => 'required|integer',
            'pmb_company_visit' => 'required|integer',
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
                'honor_mengajar_kls_malam' => $request->honor_mengajar_kls_malam,
                'pmb_atau_penguji_kp' => $request->pmb_atau_penguji_kp,
                'pmb_1_proposal_pagi' => $request->pmb_1_proposal_pagi,
                'pmb_1_proposal_malam' => $request->pmb_1_proposal_malam,
                'pmb_1_skripsi_pagi' => $request->pmb_1_skripsi_pagi,
                'pmb_1_skripsi_malam' => $request->pmb_1_skripsi_malam,
                'pmb_2_proposal_pagi' => $request->pmb_2_proposal_pagi,
                'pmb_2_proposal_malam' => $request->pmb_2_proposal_malam,
                'pmb_2_skripsi_pagi' => $request->pmb_2_skripsi_pagi,
                'pmb_2_skripsi_malam' => $request->pmb_2_skripsi_malam,
                'penguji_sidang_proposal' => $request->penguji_sidang_proposal,
                'penguji_sidang_skripsi' => $request->penguji_sidang_skripsi,
                'koreksi_soal' => $request->koreksi_soal,
                'pembuatan_soal' => $request->pembuatan_soal,
                'dosen_wali' => $request->dosen_wali,
                'pengawas_ujian' => $request->pengawas_ujian,
                'pembina_ukm' => $request->pembina_ukm,
                'remidial' => $request->remidial,
                'pmb_company_visit' => $request->pmb_company_visit,
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
            'honor_mengajar_kls_malam' => 'required|integer',
            'pmb_atau_penguji_kp' => 'required|integer',
            'pmb_1_proposal_pagi' => 'required|integer',
            'pmb_1_proposal_malam' => 'required|integer',
            'pmb_1_skripsi_pagi' => 'required|integer',
            'pmb_1_skripsi_malam' => 'required|integer',
            'pmb_2_proposal_pagi' => 'required|integer',
            'pmb_2_proposal_malam' => 'required|integer',
            'pmb_2_skripsi_pagi' => 'required|integer',
            'pmb_2_skripsi_malam' => 'required|integer',
            'penguji_sidang_proposal' => 'required|integer',
            'penguji_sidang_skripsi' => 'required|integer',
            'koreksi_soal' => 'required|integer',
            'pembuatan_soal' => 'required|integer',
            'dosen_wali' => 'required|integer',
            'pengawas_ujian' => 'required|integer',
            'pembina_ukm' => 'required|integer',
            'remidial' => 'required|integer',
            'pmb_company_visit' => 'required|integer',
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
            $dosenTetap->honor_mengajar_kls_malam = $request->honor_mengajar_kls_malam;
            $dosenTetap->pmb_atau_penguji_kp = $request->pmb_atau_penguji_kp;
            $dosenTetap->pmb_1_proposal_pagi = $request->pmb_1_proposal_pagi;
            $dosenTetap->pmb_1_proposal_malam = $request->pmb_1_proposal_malam;
            $dosenTetap->pmb_1_skripsi_pagi = $request->pmb_1_skripsi_pagi;
            $dosenTetap->pmb_1_skripsi_malam = $request->pmb_1_skripsi_malam;
            $dosenTetap->pmb_2_proposal_pagi = $request->pmb_2_proposal_pagi;
            $dosenTetap->pmb_2_proposal_malam = $request->pmb_2_proposal_malam;
            $dosenTetap->pmb_2_skripsi_pagi = $request->pmb_2_skripsi_pagi;
            $dosenTetap->pmb_2_skripsi_malam = $request->pmb_2_skripsi_malam;
            $dosenTetap->penguji_sidang_proposal = $request->penguji_sidang_proposal;
            $dosenTetap->penguji_sidang_skripsi = $request->penguji_sidang_skripsi;
            $dosenTetap->koreksi_soal = $request->koreksi_soal;
            $dosenTetap->pembuatan_soal = $request->pembuatan_soal;
            $dosenTetap->dosen_wali = $request->dosen_wali;
            $dosenTetap->pengawas_ujian = $request->pengawas_ujian;
            $dosenTetap->pembina_ukm = $request->pembina_ukm;
            $dosenTetap->remidial = $request->remidial;
            $dosenTetap->pmb_company_visit = $request->pmb_company_visit;
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
        $import = new DosenTetapImport;
        Excel::import($import, $file);
    
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
    
        $pdf = PDF::loadView('admin.import.dosentetap.pdf', compact('data'));
    
        return $pdf->download('slip_gaji_semua_dosen_tetap.pdf');
    }

    // Metode untuk menampilkan slip gaji berdasarkan ID Pegawai
    public function exportPdfbyid($id)
    {
        $data = DosenTetap::where('id', $id)->get();

        if ($data->isEmpty()) {
            return redirect()->back()->with('error', 'Data Pegawai tidak ditemukan.');
        }

        $pdf = PDF::loadView('admin.import.dosentetap.pdf', compact('data'))->setPaper('a5');

        return $pdf->download('slip_gaji_dosen_tetap_' . $id . '.pdf');
    }
}
