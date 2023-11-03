<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Akun;

class AdminController extends Controller
{

    public function index()
    {
        // dd("Berhasil login");
        $tendikCount = Akun::where('jenis_pegawai', '1')->count();
        $dosentetapCount = Akun::where('jenis_pegawai', '2')->count();
        $dosenlbCount = Akun::where('jenis_pegawai', '3')->count();

        return view('admin.dashboard.index', [
            'title' => 'Dashboard',
            'section' => 'Dashboard',
            'active' => 'Dashboard',
            'tendikCount' => $tendikCount,
            'dosenlbCount' => $dosenlbCount,
            'dosentetapCount' => $dosentetapCount,
        ]);
    }
}
