<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\Dosenlb;

class DosenlbImport implements ToModel, WithValidation
{
    use Importable;

    public function model(array $row)
    {
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
            'sks_matkul_1' => $row[9],
            'jml_hadir_mkl_1' => $row[10],
            'honor_mk_1' => $row[11],
            'matkul_2' => $row[12],
            'nominal_matkul_2' => $row[13],
            'sks_matkul_2' => $row[14],
            'jml_hadir_mkl_2' => $row[15],
            'honor_mk_2' => $row[16],
            'matkul_3' => $row[17],
            'nominal_matkul_3' => $row[18],
            'sks_matkul_3' => $row[19],
            'jml_hadir_mkl_3' => $row[20],
            'honor_mk_3' => $row[21],
            'matkul_4' => $row[22],
            'nominal_matkul_4' => $row[23],
            'sks_matkul_4' => $row[24],
            'jml_hadir_mkl_4' => $row[25],
            'honor_mk_4' => $row[26],
            'matkul_5' => $row[27],
            'nominal_matkul_5' => $row[28],
            'sks_matkul_5' => $row[29],
            'jml_hadir_mkl_5' => $row[30],
            'honor_mk_5' => $row[31],
            'anggota_klp_dosen' => $row[32],
            'pembuatan_soal' => $row[33],
            'koreksi_soal' => $row[34],
            'pengawas_ujian' => $row[35],
            'jumlah' => $row[36],
            'pph_21' => $row[37],
            'honor_yang_dibayar' => $row[38]
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
            '7' => 'nullable|string|max:100',
            '8' => 'nullable|integer',
            '9' => 'nullable|integer',
            '10' => 'nullable|integer',
            '11' => 'nullable|integer',
            '12' => 'nullable|string|max:100',
            '13' => 'nullable|integer',
            '14' => 'nullable|integer',
            '15' => 'nullable|integer',
            '16' => 'nullable|integer',
            '17' => 'nullable|string|max:100',
            '18' => 'nullable|integer',
            '19' => 'nullable|integer',
            '20' => 'nullable|integer',
            '21' => 'nullable|integer',
            '22' => 'nullable|string|max:100',
            '23' => 'nullable|integer',
            '24' => 'nullable|integer',
            '25' => 'nullable|integer',
            '26' => 'nullable|integer',
            '27' => 'nullable|string|max:100',
            '28' => 'nullable|integer',
            '29' => 'nullable|integer',
            '30' => 'nullable|integer',
            '31' => 'nullable|integer',
            '32' => 'required|integer',
            '33' => 'required|integer',
            '34' => 'required|integer',
            '35' => 'required|integer',
            '36' => 'required|integer',
            '37' => 'required|integer',
            '38' => 'required|integer',
        ];
    }
}

