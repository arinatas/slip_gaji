<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Akun;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function index()
    {
        $akuns = Akun::all();
            return view('admin.master.akun.index', [
                'title' => 'User',
                'section' => 'Master',
                'active' => 'user',
                'akuns' => $akuns,
            ]);
    }

    public function store(Request $request)
    {
        // validasi input yang didapatkan dari request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'jenis_pegawai' => 'required|integer',
            'password' => 'required|string|max:255',
            'is_admin' => 'required|integer|between:0,1'
        ]);

        // kalau ada error kembalikan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // simpan data ke database
        try {
            DB::beginTransaction();

             // Hash password sebelum menyimpannya ke database
            $hashedPassword = Hash::make($request->password);

            // insert ke tabel positions
            Akun::create([
                'name' => $request->name,
                'email' => $request->email,
                'jenis_pegawai' => $request->jenis_pegawai,
                'password' => $hashedPassword,
                'is_admin' => $request->is_admin
            ]);

            DB::commit();

            return redirect()->back()->with('insertSuccess', 'Data berhasil di Inputkan');

        } catch(Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
            return redirect()->back()->with('insertFail', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $akun = Akun::find($id);

        if (!$akun) {
            return redirect()->back()->with('dataNotFound', 'Data tidak ditemukan');
        }

        return view('admin.master.akun.edit', [
            'title' => 'User',
            'secction' => 'Master',
            'active' => 'user',
            'akun' => $akun,
        ]);
    }

    public function update(Request $request, $id)
    {
        $akun = Akun::find($id);

        if (!$akun) {
            return redirect()->back()->with('dataNotFound', 'Data tidak ditemukan');
        }

        // validasi input yang didapatkan dari request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'is_admin' => 'required|integer|between:0,1',
            'is_aktif' => 'required|integer|between:0,1',
            'jenis_pegawai' => 'required|integer'
        ]);

        // kalau ada error kembalikan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{
            $akun->name = $request->name;
            $akun->email = $request->email;
            $akun->is_admin = $request->is_admin;
            $akun->is_aktif = $request->is_aktif;
            $akun->jenis_pegawai = $request->jenis_pegawai;

            $akun->save();

            return redirect('/akun')->with('updateSuccess', 'Data berhasil di Update');
        } catch(Exception $e) {
            dd($e);
            return redirect()->back()->with('updateFail', 'Data gagal di Update');
        }
    }

    public function destroy($id)
    {
        // Cari data pengguna berdasarkan ID
        $position = Akun::find($id);

        try {
            // Hapus data pengguna
            $position->delete();
            return redirect()->back()->with('deleteSuccess', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('deleteFail', $e->getMessage());
        }
    }

    public function reset($id)
    {
        $akun = Akun::find($id);

        if (!$akun) {
            return redirect()->back()->with('dataNotFound', 'Data tidak ditemukan');
        }

        return view('admin.master.akun.reset', [
            'title' => 'User',
            'secction' => 'Master',
            'active' => 'user',
            'akun' => $akun,
        ]);
    }

    public function resetupdate(Request $request, $id)
    {
        $akun = Akun::find($id);

        if (!$akun) {
            return redirect()->back()->with('dataNotFound', 'Data tidak ditemukan');
        }

        // validasi input yang didapatkan dari request
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255'
        ]);

        // kalau ada error kembalikan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{
            $akun->email = $request->email;
            // Hash password sebelum menyimpannya ke database
            $akun->password = Hash::make($request->password);

            $akun->save();

            return redirect('/akun')->with('updateSuccess', 'Password berhasil di Reset');
        } catch(Exception $e) {
            dd($e);
            return redirect()->back()->with('updateFail', 'Password gagal di Reset');
        }
    }

}
