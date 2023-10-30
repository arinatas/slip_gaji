<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Dosenlb;

class DosenlbImport implements ToModel
{
    public function model(array $row)
    {
        // Logika untuk memasukkan data ke dalam model Tendik
        return new Dosenlb([
            'email' => $row[0],
            'bulan' => $row[1],
            'tahun' => $row[2],
            'nama' => $row[3],
            'jabatan_struktural' => $row[4],
            'jabatan_fungsional' => $row[5],
            'honor_pokok' => $row[6],
            'matkul_1' => $row[7],
            'nominal_matkul_1' => $row[8],
            'matkul_2' => $row[9],
            'nominal_matkul_2' => $row[10],
            'matkul_3' => $row[11],
            'nominal_matkul_3' => $row[12],
            'matkul_4' => $row[13],
            'nominal_matkul_4' => $row[14],
            'matkul_5' => $row[15],
            'nominal_matkul_5' => $row[16],
            'anggota_klp_dosen' => $row[17],
            'pembuatan_soal' => $row[18],
            'koreksi_soal' => $row[19],
            'pengawas_ujian' => $row[20],
            'jumlah' => $row[21],
            'pph_21' => $row[22],
            'honor_yang_dibayar' => $row[23]
        ]);
    }
}
