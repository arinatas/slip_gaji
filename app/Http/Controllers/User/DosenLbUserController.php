<?php

namespace App\Http\Controllers\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\Dosenlb;


class DosenLbUserController extends Controller
{

    public function index(Request $request)
    {

        $userEmail = auth()->user()->email;

        if($userEmail === $request->email || $request->email === null) {
            $Datas = Dosenlb::where('email', $request->email)
            ->where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->get();

            if ($Datas->isEmpty()) {
                $Datas = null;
            }

            // Menyimpan data tanggal di session
            session()->put('bulan', $request->bulan);
            session()->put('tahun', $request->tahun);

            // Mengecek apakah filter tanggal telah digunakan
            $filterUsed = $request->filled('bulan') && $request->filled('tahun');

                return view('user.dosen_lb.index', [
                    'title' => 'Slip Gaji Dosen LB',
                    'secction' => 'Menu',
                    'active' => 'Slip Gaji Dosen LB',
                    'Datas' => $Datas,
                    'filterUsed' => $filterUsed, // Mengirimkan status penggunaan filter ke tampilan
                ]);
        }

        return redirect('/userDashboard')->with('insertFail', 'Dilarang mengakses email yang berbeda!');

    }

    public function printSlipGajiDosenLB (){

        $userEmail = auth()->user()->email;

        $Datas = Dosenlb::where('email', $userEmail)
            ->where('bulan', session('bulan'))
            ->where('tahun', session('tahun'))
            ->get();

        $bulan = session('bulan');
        $tahun = session('tahun');

        return view('print.slip_dosenlb', [
            'title' => 'Slip Gaji Dosen LB',
            'secction' => 'Menu',
            'Datas' => $Datas,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);
    }

}
