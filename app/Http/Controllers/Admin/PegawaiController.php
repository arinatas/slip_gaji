<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::all();
            return view('admin.master.pegawai.index', [
                'title' => 'Pegawai',
                'section' => 'Master',
                'active' => 'pegawai',
                'pegawais' => $pegawais,
            ]);
    }

    public function store(Request $request)
    {
        // Validasi input yang didapatkan dari request
        $validator = Validator::make($request->all(),[
            'kode_pegawai' => 'required|string|max:100',
            'nama' => 'required|string|max:255',
            'jenis' => 'required|integer'
        ]);

        // kalau ada error kembalikan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cek apakah kode pegawai sudah ada
        $existingPegawai = Pegawai::where('kode_pegawai', $request->kode_pegawai)->first();

        if ($existingPegawai) {
            return redirect()->back()->with('insertFail', 'Kode Pegawai Sudah Digunakan');
        }

        // Simpan data ke database
        try {
            DB::beginTransaction();

            // insert ke tabel pegawai
            Pegawai::create([
                'kode_pegawai' => $request->kode_pegawai,
                'nama' => $request->nama,
                'jenis' => $request->jenis
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
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return redirect()->back()->with('dataNotFound', 'Data tidak ditemukan');
        }

        return view('admin.master.pegawai.edit', [
            'title' => 'Pegawai',
            'secction' => 'Master',
            'active' => 'pegawai',
            'pegawai' => $pegawai
        ]);
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return redirect()->back()->with('dataNotFound', 'Data tidak ditemukan');
        }

        // validasi input yang didapatkan dari request
        $validator = Validator::make($request->all(), [
            'kode_pegawai' => 'required|string|max:100',
            'nama' => 'required|string|max:255',
            'jenis' => 'required|integer'
        ]);

        // kalau ada error kembalikan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cek apakah kode pegawai yang ingin diubah sudah digunakan oleh pegawai lain
        if ($pegawai->kode_pegawai !== $request->kode_pegawai) {
            $existingPegawai = Pegawai::where('kode_pegawai', $request->kode_pegawai)->first();

            if ($existingPegawai) {
                return redirect()->back()->with('updateFail', 'Kode Pegawai sudah digunakan.');
            }
        }

        try{
            $pegawai->kode_pegawai = $request->kode_pegawai;
            $pegawai->nama = $request->nama;
            $pegawai->jenis = $request->jenis;

            $pegawai->save();

            return redirect('/pegawai')->with('updateSuccess', 'Data berhasil di Update');
        } catch(Exception $e) {
            dd($e);
            return redirect()->back()->with('updateFail', 'Data gagal di Update');
        }
    }

    public function destroy($id)
    {
        // Cari data pengguna berdasarkan ID
        $pegawai = Pegawai::find($id);

        try {
            // Hapus data pengguna
            $pegawai->delete();
            return redirect()->back()->with('deleteSuccess', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('deleteFail', $e->getMessage());
        }
    }
}
