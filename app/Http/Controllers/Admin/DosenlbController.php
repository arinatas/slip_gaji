<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Dosenlb;
use App\Imports\DosenlbImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;

class DosenlbController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan'); // Get the selected month from the request
        $tahun = $request->input('tahun'); // Get the selected year from the request
    
        // Fetch distinct years from the database
        $distinctYears = Dosenlb::distinct('tahun')->pluck('tahun');
    
        $dosenlbs = Dosenlb::where('bulan', $bulan)
                         ->where('tahun', $tahun)
                         ->get();
    
        return view('admin.import.dosenlb.index', [
            'title' => 'Dosen LB',
            'section' => 'Import',
            'active' => 'dosenlb',
            'dosenlbs' => $dosenlbs,
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
            'honor_pokok' => 'required|integer',
            'matkul_1' => 'nullable|string|max:100',
            'nominal_matkul_1' => 'nullable|integer',
            'sks_maktul_1' => 'nullable|integer',
            'jml_hadir_mkl_1' => 'nullable|integer',
            'honor_mk_1' => 'nullable|integer',
            'matkul_2' => 'nullable|string|max:100',
            'nominal_matkul_2' => 'nullable|integer',
            'sks_maktul_2' => 'nullable|integer',
            'jml_hadir_mkl_2' => 'nullable|integer',
            'honor_mk_2' => 'nullable|integer',
            'matkul_3' => 'nullable|string|max:100',
            'nominal_matkul_3' => 'nullable|integer',
            'sks_maktul_3' => 'nullable|integer',
            'jml_hadir_mkl_3' => 'nullable|integer',
            'honor_mk_3' => 'nullable|integer',
            'matkul_4' => 'nullable|string|max:100',
            'nominal_matkul_4' => 'nullable|integer',
            'sks_maktul_4' => 'nullable|integer',
            'jml_hadir_mkl_4' => 'nullable|integer',
            'honor_mk_4' => 'nullable|integer',
            'matkul_5' => 'nullable|string|max:100',
            'nominal_matkul_5' => 'nullable|integer',
            'sks_maktul_5' => 'nullable|integer',
            'jml_hadir_mkl_5' => 'nullable|integer',
            'honor_mk_5' => 'nullable|integer',
            'anggota_klp_dosen' => 'required|integer',
            'pembuatan_soal' => 'required|integer',
            'koreksi_soal' => 'required|integer',
            'pengawas_ujian' => 'required|integer',
            'jumlah' => 'required|integer',
            'pph_21' => 'required|integer',
            'honor_yang_dibayar' => 'required|integer'
        ]);

        // kalau ada error kembalikan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cek apakah email dengan bulan dan tahun yang sama sudah ada
        $existingRecord = Dosenlb::where('email', $request->email)
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
            Dosenlb::create([
                'email' => $request->email,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
                'nama' => $request->nama,
                'jabatan_struktural' => $request->jabatan_struktural,
                'jabatan_fungsional' => $request->jabatan_fungsional,
                'honor_pokok' => $request->honor_pokok,
                'matkul_1' => $request->matkul_1,
                'nominal_matkul_1' => $request->nominal_matkul_1,
                'sks_matkul_1' => $request->sks_matkul_1,
                'jml_hadir_mkl_1' => $request->jml_hadir_mkl_1,
                'honor_mk_1' => $request->honor_mk_1,
                'matkul_2' => $request->matkul_2,
                'nominal_matkul_2' => $request->nominal_matkul_2,
                'sks_matkul_2' => $request->sks_matkul_2,
                'jml_hadir_mkl_2' => $request->jml_hadir_mkl_2,
                'honor_mk_2' => $request->honor_mk_2,
                'matkul_3' => $request->matkul_3,
                'nominal_matkul_3' => $request->nominal_matkul_3,
                'sks_matkul_3' => $request->sks_matkul_3,
                'jml_hadir_mkl_3' => $request->jml_hadir_mkl_3,
                'honor_mk_3' => $request->honor_mk_3,
                'matkul_4' => $request->matkul_4,
                'nominal_matkul_4' => $request->nominal_matkul_4,
                'sks_matkul_4' => $request->sks_matkul_4,
                'jml_hadir_mkl_4' => $request->jml_hadir_mkl_4,
                'honor_mk_4' => $request->honor_mk_4,
                'matkul_5' => $request->matkul_5,
                'nominal_matkul_5' => $request->nominal_matkul_5,
                'sks_matkul_5' => $request->sks_matkul_5,
                'jml_hadir_mkl_5' => $request->jml_hadir_mkl_5,
                'honor_mk_5' => $request->honor_mk_5,
                'anggota_klp_dosen' => $request->anggota_klp_dosen,
                'pembuatan_soal' => $request->pembuatan_soal,
                'koreksi_soal' => $request->koreksi_soal,
                'nampengawas_ujiana' => $request->pengawas_ujian,
                'jumlah' => $request->jumlah,
                'pph_21' => $request->pph_21,
                'honor_yang_dibayar' => $request->honor_yang_dibayar
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
        $dosenlb = Dosenlb::find($id);

        if (!$dosenlb) {
            return redirect()->back()->with('dataNotFound', 'Data tidak ditemukan');
        }

        return view('admin.import.dosenlb.edit', [
            'title' => 'Dosen LB',
            'secction' => 'Import',
            'active' => 'dosenlb',
            'dosenlb' => $dosenlb
        ]);
    }

    public function update(Request $request, $id)
    {
        $dosenlb = Dosenlb::find($id);

        if (!$dosenlb) {
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
            'honor_pokok' => 'required|integer',
            'matkul_1' => 'nullable|string|max:100',
            'nominal_matkul_1' => 'nullable|integer',
            'sks_maktul_1' => 'nullable|integer',
            'jml_hadir_mkl_1' => 'nullable|integer',
            'honor_mk_1' => 'nullable|integer',
            'matkul_2' => 'nullable|string|max:100',
            'nominal_matkul_2' => 'nullable|integer',
            'sks_maktul_2' => 'nullable|integer',
            'jml_hadir_mkl_2' => 'nullable|integer',
            'honor_mk_2' => 'nullable|integer',
            'matkul_3' => 'nullable|string|max:100',
            'nominal_matkul_3' => 'nullable|integer',
            'sks_maktul_3' => 'nullable|integer',
            'jml_hadir_mkl_3' => 'nullable|integer',
            'honor_mk_3' => 'nullable|integer',
            'matkul_4' => 'nullable|string|max:100',
            'nominal_matkul_4' => 'nullable|integer',
            'sks_maktul_4' => 'nullable|integer',
            'jml_hadir_mkl_4' => 'nullable|integer',
            'honor_mk_4' => 'nullable|integer',
            'matkul_5' => 'nullable|string|max:100',
            'nominal_matkul_5' => 'nullable|integer',
            'sks_maktul_5' => 'nullable|integer',
            'jml_hadir_mkl_5' => 'nullable|integer',
            'honor_mk_5' => 'nullable|integer',
            'anggota_klp_dosen' => 'required|integer',
            'pembuatan_soal' => 'required|integer',
            'koreksi_soal' => 'required|integer',
            'pengawas_ujian' => 'required|integer',
            'jumlah' => 'required|integer',
            'pph_21' => 'required|integer',
            'honor_yang_dibayar' => 'required|integer'
        ]);

        // kalau ada error kembalikan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{
            $dosenlb->email = $request->email;
            $dosenlb->bulan = $request->bulan;
            $dosenlb->tahun = $request->tahun;
            $dosenlb->nama = $request->nama;
            $dosenlb->jabatan_struktural = $request->jabatan_struktural;
            $dosenlb->jabatan_fungsional = $request->jabatan_fungsional;
            $dosenlb->honor_pokok = $request->honor_pokok;
            $dosenlb->matkul_1 = $request->matkul_1;
            $dosenlb->nominal_matkul_1 = $request->nominal_matkul_1;
            $dosenlb->sks_matkul_1 = $request->sks_matkul_1;
            $dosenlb->jml_hadir_mkl_1 = $request->jml_hadir_mkl_1;
            $dosenlb->honor_mk_1 = $request->honor_mk_1;
            $dosenlb->matkul_2 = $request->matkul_2;
            $dosenlb->nominal_matkul_2 = $request->nominal_matkul_2;
            $dosenlb->sks_matkul_2 = $request->sks_matkul_2;
            $dosenlb->jml_hadir_mkl_2 = $request->jml_hadir_mkl_2;
            $dosenlb->honor_mk_2 = $request->honor_mk_2;
            $dosenlb->matkul_3 = $request->matkul_3;
            $dosenlb->nominal_matkul_3 = $request->nominal_matkul_3;
            $dosenlb->sks_matkul_3 = $request->sks_matkul_3;
            $dosenlb->jml_hadir_mkl_3 = $request->jml_hadir_mkl_3;
            $dosenlb->honor_mk_3 = $request->honor_mk_3;
            $dosenlb->matkul_4 = $request->matkul_4;
            $dosenlb->nominal_matkul_4 = $request->nominal_matkul_4;
            $dosenlb->sks_matkul_4 = $request->sks_matkul_4;
            $dosenlb->jml_hadir_mkl_4 = $request->jml_hadir_mkl_4;
            $dosenlb->honor_mk_4 = $request->honor_mk_4;
            $dosenlb->matkul_5 = $request->matkul_5;
            $dosenlb->nominal_matkul_5 = $request->nominal_matkul_5;
            $dosenlb->sks_matkul_5 = $request->sks_matkul_5;
            $dosenlb->jml_hadir_mkl_5 = $request->jml_hadir_mkl_5;
            $dosenlb->honor_mk_5 = $request->honor_mk_5;
            $dosenlb->anggota_klp_dosen = $request->anggota_klp_dosen;
            $dosenlb->pembuatan_soal = $request->pembuatan_soal;
            $dosenlb->koreksi_soal = $request->koreksi_soal;
            $dosenlb->pengawas_ujian = $request->pengawas_ujian;
            $dosenlb->jumlah = $request->jumlah;
            $dosenlb->pph_21 = $request->pph_21;
            $dosenlb->honor_yang_dibayar = $request->honor_yang_dibayar;

            $dosenlb->save();

            return redirect()->route('dosenlb', ['bulan' => $request->bulan, 'tahun' => $request->tahun])->with('updateSuccess', 'Data berhasil di Update');
        } catch(Exception $e) {
            dd($e);
            return redirect()->back()->with('updateFail', 'Data gagal di Update');
        }
    }

    public function destroy($id)
    {
        // Cari data pengguna berdasarkan ID
        $dosenlb = Dosenlb::find($id);

        try {
            // Hapus data pengguna
            $dosenlb->delete();
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
        $import = new DosenlbImport;
        $rows = Excel::toCollection($import, $file)->first();

        $duplicateEntries = [];

        foreach ($rows as $row) {
            $email = $row['email'];
            $bulan = $row['bulan'];
            $tahun = $row['tahun'];

            // Periksa apakah kombinasi email, bulan, dan tahun sudah ada di database
            if (Dosenlb::where('email', $email)->where('bulan', $bulan)->where('tahun', $tahun)->exists()) {
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
        $filePath = public_path('contoh-excel/dosenlb.xlsx'); // Sesuaikan dengan path file Excel contoh Anda
    
        if (file_exists($filePath)) {
            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];
    
            return response()->download($filePath, 'dosenlb.xlsx', $headers);
        } else {
            return redirect()->back()->with('downloadFail', 'File contoh tidak ditemukan.');
        }
    } 

    // Metode untuk menampilkan slip gaji keseluruhan
    public function exportPdf($bulan, $tahun)
    {
        $data = Dosenlb::where('bulan', $bulan)
                      ->where('tahun', $tahun)
                      ->get();

        return view('admin.import.dosenlb.printslip', [
            'title' => 'Dosen LB',
            'section' => 'Import',
            'active' => 'dosenlb',
            'data' => $data
            ]);
    }

    // Metode untuk menampilkan slip gaji berdasarkan ID Pegawai
    public function exportPdfbyid($id)
    {
        $data = Dosenlb::where('id', $id)->get();

        if ($data->isEmpty()) {
            return redirect()->back()->with('error', 'Data Pegawai tidak ditemukan.');
        }
        return view('admin.import.dosenlb.printslip', [
            'title' => 'Dosen LB',
            'section' => 'Import',
            'active' => 'dosenlb',
            'data' => $data
            ]);
    }
}
