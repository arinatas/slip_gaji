<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Tendik;
use App\Imports\TendikImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;

class TendikController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan'); // Get the selected month from the request
        $tahun = $request->input('tahun'); // Get the selected year from the request
    
        // Fetch distinct years from the database
        $distinctYears = Tendik::distinct('tahun')->pluck('tahun');
    
        $tendiks = Tendik::where('bulan', $bulan)
                         ->where('tahun', $tahun)
                         ->get();
    
        return view('admin.import.tendik.index', [
            'title' => 'Tendik',
            'section' => 'Import',
            'active' => 'tendik',
            'tendiks' => $tendiks,
            'distinctYears' => $distinctYears,
        ]);
    }    

    public function store(Request $request)
    {
        // Validasi input yang didapatkan dari request
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|max:255',
            'bulan' => 'required|integer',
            'tahun' => 'required|integer',
            'nama' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'gaji_pokok' => 'required|integer',
            'tunjangan_jabatan' => 'required|integer',
            'bonus' => 'required|integer',
            'tunjangan_kehadiran' => 'required|integer',
            'tunjangan_lembur' => 'required|integer',
            'tunj_pel_mhs_op_feeder' => 'required|integer',
            'tunjangan_kinerja' => 'required|integer',
            'jumlah_penambah' => 'required|integer',
            'potongan_kasbon' => 'required|integer',
            'denda_keterlambatan' => 'required|integer',
            'potongan_pph_21' => 'required|integer',
            'potongan_absensi' => 'required|integer',
            'potongan_bpjs' => 'required|integer',
            'jumlah_pengurang' => 'required|integer',
            'gaji_yang_dibayar' => 'required|integer'
        ]);

        // kalau ada error kembalikan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cek apakah email dengan bulan dan tahun yang sama sudah ada
        $existingRecord = Tendik::where('email', $request->email)
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
            Tendik::create([
                'email' => $request->email,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'gaji_pokok' => $request->gaji_pokok,
                'tunjangan_jabatan' => $request->tunjangan_jabatan,
                'bonus' => $request->bonus,
                'tunjangan_kehadiran' => $request->tunjangan_kehadiran,
                'tunjangan_lembur' => $request->tunjangan_lembur,
                'tunj_pel_mhs_op_feeder' => $request->tunj_pel_mhs_op_feeder,
                'tunjangan_kinerja' => $request->tunjangan_kinerja,
                'jumlah_penambah' => $request->jumlah_penambah,
                'potongan_kasbon' => $request->potongan_kasbon,
                'denda_keterlambatan' => $request->denda_keterlambatan,
                'potongan_pph_21' => $request->potongan_pph_21,
                'potongan_absensi' => $request->potongan_absensi,
                'potongan_bpjs' => $request->potongan_bpjs,
                'jumlah_pengurang' => $request->jumlah_pengurang,
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
        $tendik = Tendik::find($id);

        if (!$tendik) {
            return redirect()->back()->with('dataNotFound', 'Data tidak ditemukan');
        }

        return view('admin.import.tendik.edit', [
            'title' => 'Pegawai',
            'secction' => 'Import',
            'active' => 'tendik',
            'tendik' => $tendik
        ]);
    }

    public function update(Request $request, $id)
    {
        $tendik = Tendik::find($id);

        if (!$tendik) {
            return redirect()->back()->with('dataNotFound', 'Data tidak ditemukan');
        }

        // validasi input yang didapatkan dari request
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:255',
            'bulan' => 'required|integer',
            'tahun' => 'required|integer',
            'nama' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'gaji_pokok' => 'required|integer',
            'tunjangan_jabatan' => 'required|integer',
            'bonus' => 'required|integer',
            'tunjangan_kehadiran' => 'required|integer',
            'tunjangan_lembur' => 'required|integer',
            'tunj_pel_mhs_op_feeder' => 'required|integer',
            'tunjangan_kinerja' => 'required|integer',
            'jumlah_penambah' => 'required|integer',
            'potongan_kasbon' => 'required|integer',
            'denda_keterlambatan' => 'required|integer',
            'potongan_pph_21' => 'required|integer',
            'potongan_absensi' => 'required|integer',
            'potongan_bpjs' => 'required|integer',
            'jumlah_pengurang' => 'required|integer',
            'gaji_yang_dibayar' => 'required|integer'
        ]);

        // kalau ada error kembalikan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{
            $tendik->email = $request->email;
            $tendik->bulan = $request->bulan;
            $tendik->tahun = $request->tahun;
            $tendik->nama = $request->nama;
            $tendik->jabatan = $request->jabatan;
            $tendik->gaji_pokok = $request->gaji_pokok;
            $tendik->tunjangan_jabatan = $request->tunjangan_jabatan;
            $tendik->bonus = $request->bonus;
            $tendik->tunjangan_kehadiran = $request->tunjangan_kehadiran;
            $tendik->tunjangan_lembur = $request->tunjangan_lembur;
            $tendik->tunj_pel_mhs_op_feeder = $request->tunj_pel_mhs_op_feeder;
            $tendik->tunjangan_kinerja = $request->tunjangan_kinerja;
            $tendik->jumlah_penambah = $request->jumlah_penambah;
            $tendik->potongan_kasbon = $request->potongan_kasbon;
            $tendik->denda_keterlambatan = $request->denda_keterlambatan;
            $tendik->potongan_pph_21 = $request->potongan_pph_21;
            $tendik->potongan_absensi = $request->potongan_absensi;
            $tendik->potongan_bpjs = $request->potongan_bpjs;
            $tendik->jumlah_pengurang = $request->jumlah_pengurang;
            $tendik->gaji_yang_dibayar = $request->gaji_yang_dibayar;

            $tendik->save();

            return redirect()->route('tendik', ['bulan' => $request->bulan, 'tahun' => $request->tahun])->with('updateSuccess', 'Data berhasil di Update');
        } catch(Exception $e) {
            dd($e);
            return redirect()->back()->with('updateFail', 'Data gagal di Update');
        }
    }

    public function destroy($id)
    {
        // Cari data pengguna berdasarkan ID
        $tendik = Tendik::find($id);

        try {
            // Hapus data pengguna
            $tendik->delete();
            return redirect()->back()->with('deleteSuccess', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('deleteFail', $e->getMessage());
        }
    }

    public function showImportForm()
    {
        return view('import'); // Menampilkan tampilan untuk mengunggah file Excel
    }

    // public function importExcel(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'excel_file' => 'required|mimes:xls,xlsx',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    
    //     $file = $request->file('excel_file');
    //     $import = new TendikImport;
    //     Excel::import($import, $file);
    
    //     return redirect()->back()->with('importSuccess', 'Data berhasil diimpor.');
    // }

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
        $import = new TendikImport;
        $rows = Excel::toCollection($import, $file)->first();

        $duplicateEntries = [];

        foreach ($rows as $row) {
            $email = $row['email'];
            $bulan = $row['bulan'];
            $tahun = $row['tahun'];

            // Periksa apakah kombinasi email, bulan, dan tahun sudah ada di database
            if (Tendik::where('email', $email)->where('bulan', $bulan)->where('tahun', $tahun)->exists()) {
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
        $filePath = public_path('contoh-excel/tendik.xlsx'); // Sesuaikan dengan path file Excel contoh Anda
    
        if (file_exists($filePath)) {
            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];
    
            return response()->download($filePath, 'tendik.xlsx', $headers);
        } else {
            return redirect()->back()->with('downloadFail', 'File contoh tidak ditemukan.');
        }
    } 

    // Metode untuk menampilkan slip gaji keseluruhan
    public function exportPdf($bulan, $tahun)
    {
        $data = Tendik::where('bulan', $bulan)
                      ->where('tahun', $tahun)
                      ->get();
    
        $tendiks = Tendik::where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->get();

        return view('admin.import.tendik.printslip', [
        'title' => 'Tendik',
        'section' => 'Import',
        'active' => 'tendik',
        'data' => $data
        ]);
    }

    // Metode untuk menampilkan slip gaji berdasarkan ID Pegawai
    public function exportPdfbyid($id)
    {
        $data = Tendik::where('id', $id)->get();

        if ($data->isEmpty()) {
            return redirect()->back()->with('error', 'Data Pegawai tidak ditemukan.');
        }
        
        return view('admin.import.tendik.printslip', [
            'title' => 'Tendik',
            'section' => 'Import',
            'active' => 'tendik',
            'data' => $data
            ]);
    }
}
