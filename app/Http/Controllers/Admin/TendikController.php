<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Tendik;
use Illuminate\Support\Facades\Hash;

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
}
