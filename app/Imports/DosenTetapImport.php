<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\DosenTetap;

class DosenTetapImport implements ToModel, WithValidation
{
    use Importable;

    public function model(array $row)
    {
        return new DosenTetap([
            'email' => $row[0],
            'bulan' => $row[1],
            'tahun' => $row[2],
            'nama' => $row[3],
            'jabatan_struktural' => $row[4],
            'jabatan_fungsional' => $row[5],
            'gaji_pokok' => $row[6],
            'tunjangan_kehadiran' => $row[7],
            'tunjangan_jabatan_struktural' => $row[8],
            'tunjangan_jabatan_fungsional' => $row[9],
            'honor_mengajar_kls_pagi' => $row[10],
            'honor_mengajar_kls_malam' => $row[11],
            'pmb_atau_penguji_kp' => $row[12],
            'pmb_1_proposal_pagi' => $row[13],
            'pmb_1_proposal_malam' => $row[14],
            'pmb_1_skripsi_pagi' => $row[15],
            'pmb_1_skripsi_malam' => $row[16],
            'pmb_2_proposal_pagi' => $row[17],
            'pmb_2_proposal_malam' => $row[18],
            'pmb_2_skripsi_pagi' => $row[19],
            'pmb_2_skripsi_malam' => $row[20],
            'penguji_sidang_proposal' => $row[21],
            'penguji_sidang_skripsi' => $row[22],
            'koreksi_soal' => $row[23],
            'pembuatan_soal' => $row[24],
            'dosen_wali' => $row[25],
            'pengawas_ujian' => $row[26],
            'pembina_ukm' => $row[27],
            'remidial' => $row[28],
            'pmb_company_visit' => $row[29],
            'reward_ekin' => $row[30],
            'jumlah_gaji_tunjangan_honor' => $row[31],
            'potongan_kas_bon' => $row[32],
            'pph_21' => $row[33],
            'potongan_absensi' => $row[34],
            'potongan_bpjs' => $row[35],
            'jumlah' => $row[36],
            'gaji_yang_dibayar' => $row[37]
        ]);
    }

    public function rules(): array
    {
        return [
            '0' => 'required|string|max:100',
            '1' => 'required|integer',
            '2' => 'required|integer',
            '3' => 'required|string|max:100',
            '4' => 'required|string|max:100',
            '5' => 'required|string|max:100',
            '6' => 'required|integer',
            '7' => 'required|integer',
            '8' => 'required|integer',
            '9' => 'required|integer',
            '10' => 'required|integer',
            '11' => 'required|integer',
            '12' => 'required|integer',
            '13' => 'required|integer',
            '14' => 'required|integer',
            '15' => 'required|integer',
            '16' => 'required|integer',
            '17' => 'required|integer',
            '18' => 'required|integer',
            '19' => 'required|integer',
            '20' => 'required|integer',
            '21' => 'required|integer',
            '22' => 'required|integer',
            '23' => 'required|integer',
            '24' => 'required|integer',
            '25' => 'required|integer',
            '26' => 'required|integer',
            '27' => 'required|integer',
            '28' => 'required|integer',
            '29' => 'required|integer',
            '30' => 'required|integer',
            '31' => 'required|integer',
            '32' => 'required|integer',
            '33' => 'required|integer',
            '34' => 'required|integer',
            '35' => 'required|integer',
            '36' => 'required|integer',
            '37' => 'required|integer',
        ];
    }
}
