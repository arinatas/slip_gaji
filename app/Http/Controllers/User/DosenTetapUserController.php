<?php

namespace App\Http\Controllers\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\DosenTetap;


class DosenTetapUserController extends Controller
{

    public function index(Request $request)
    {

        $userEmail = auth()->user()->email;

        if($userEmail === $request->email || $request->email === null) {
            $Datas = DosenTetap::where('email', $request->email)
            ->where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->get();

            if ($Datas->isEmpty()) {
                $Datas = null;
            }

            // Menyimpan data tanggal di session
            session()->put('bulan', $request->bulan);
            session()->put('tahun', $request->tahun);

            $nowMonth = date('n'); // Mendapatkan bulan saat ini (1-12)
            $nowYear = date('Y'); // Mendapatkan tahun saat ini (4 digit)
            $previousYear = $nowYear - 1; // Tahun sebelumnya
            $nextYear = $nowYear + 1; // Tahun berikutnya

            // Mengecek apakah filter tanggal telah digunakan
            $filterUsed = $request->filled('bulan') && $request->filled('tahun');

                return view('user.dosen_tetap.index', [
                    'title' => 'Slip Gaji Dosen Tetap',
                    'secction' => 'Menu',
                    'active' => 'Slip Gaji Dosen Tetap',
                    'Datas' => $Datas,
                    'nowMonth' => $nowMonth,
                    'nowYear' => $nowYear,
                    'previousYear' => $previousYear,
                    'nextYear' => $nextYear,
                    'filterUsed' => $filterUsed, // Mengirimkan status penggunaan filter ke tampilan
                ]);
        }

        return redirect('/userDashboard')->with('insertFail', 'Dilarang mengakses email yang berbeda!');

    }

    public function printSlipGajiDosenTetap (){

        $userEmail = auth()->user()->email;

        $Datas = DosenTetap::where('email', $userEmail)
            ->where('bulan', session('bulan'))
            ->where('tahun', session('tahun'))
            ->get();

        $bulan = session('bulan');
        $tahun = session('tahun');

        return view('print.slip_dosenTetap', [
            'title' => 'Slip Gaji Dosen Tetap',
            'secction' => 'Menu',
            'Datas' => $Datas,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);
    }

}
