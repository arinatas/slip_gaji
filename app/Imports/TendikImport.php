<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Tendik;

class TendikImport implements ToModel
{
    public function model(array $row)
    {
        // Logika untuk memasukkan data ke dalam model Tendik
        return new Tendik([
            'email' => $row[0],
            'bulan' => $row[1],
            'tahun' => $row[2],
            'nama' => $row[3],
            'jabatan' => $row[4],
            'gaji_pokok' => $row[5],
            'tunjangan_jabatan' => $row[6],
            'tunjangan_kehadiran' => $row[7],
            'tunjangan_lembur' => $row[8],
            'tunj_pel_mhs_op_feeder' => $row[9],
            'tunjangan_kinerja' => $row[10],
            'jumlah_penambah' => $row[11],
            'potongan_kasbon' => $row[12],
            'denda_keterlambatan' => $row[13],
            'potongan_pph_21' => $row[14],
            'potongan_absensi' => $row[15],
            'potongan_bpjs' => $row[16],
            'jumlah_pengurang' => $row[17],
            'gaji_yang_dibayar' => $row[18]
        ]);
    }
}
