<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\Tendik;

class TendikImport implements ToModel, WithValidation
{
    use Importable;
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

    public function rules(): array
    {
        return [
            '0' => 'required|string|max:255',
            '1' => 'required|integer',
            '2' => 'required|integer',
            '3' => 'required|string|max:100',
            '4' => 'required|string|max:100',
            '5' => 'required|integer',
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
        ];
    }
}
