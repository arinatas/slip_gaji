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
use PDF;

class TendikController extends Controller
{
    public function index()
    {
        $tendiks = Tendik::all();
            return view('admin.import.tendik.index', [
                'title' => 'Tendik',
                'section' => 'Import',
                'active' => 'tendik',
                'tendiks' => $tendiks,
            ]);
    }

    public function store(Request $request)
    {
        // Validasi input yang didapatkan dari request
        $validator = Validator::make($request->all(),[
            'id_pegawai' => 'required|string|max:100',
            'bulan' => 'required|integer',
            'tahun' => 'required|integer'
        ]);

        // kalau ada error kembalikan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data ke database
        try {
            DB::beginTransaction();

            // insert ke tabel pegawai
            Tendik::create([
                'id_pegawai' => $request->id_pegawai,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun
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
            'id_pegawai' => 'required|string|max:100',
            'bulan' => 'required|integer',
            'tahun' => 'required|integer'
        ]);

        // kalau ada error kembalikan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{
            $tendik->id_pegawai = $request->id_pegawai;
            $tendik->bulan = $request->bulan;
            $tendik->tahun = $request->tahun;

            $tendik->save();

            return redirect('/tendik')->with('updateSuccess', 'Data berhasil di Update');
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

    public function importExcel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'excel_file' => 'required|mimes:xls,xlsx',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $file = $request->file('excel_file');
        $import = new TendikImport;
        Excel::import($import, $file);
    
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

    // public function exportPdf()
    // {
    //     $data = Tendik::all();
        
    //     // Kelompokkan data berdasarkan ID Pegawai
    //     $groupedData = $data->groupBy('id_pegawai');
        
    //     // Loop melalui setiap kelompok data dan buat PDF untuk setiap pegawai
    //     foreach ($groupedData as $pegawaiId => $pegawaiData) {
    //         $pegawai = $pegawaiData->first(); // Ambil data pegawai pertama sebagai contoh
    //         $pdf = PDF::loadView('admin.import.tendik.pdf', compact('pegawai', 'pegawaiData'));
        
    //         return $pdf->download('slip_gaji_' . $pegawai->id_pegawai . '.pdf'); // Pastikan Anda mengembalikan PDF yang diunduh
    //     }
    // }    

    public function exportPdf()
    {
        $data = Tendik::all();

        // Buat instance PDF
        // $pdf = PDF::loadView('admin.import.tendik.pdf', compact('data'));
        $pdf = PDF::loadView('admin.import.tendik.pdf', compact('data'))->setPaper('a5');

        return $pdf->download('slip_gaji_semua_pegawai.pdf');
    }
}
