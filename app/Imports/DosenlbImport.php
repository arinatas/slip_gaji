<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; // row 1 sebagai heading
use Maatwebsite\Excel\Concerns\WithValidation; // validasi string / integer
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\Dosenlb;

class DosenlbImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    public function model(array $row)
    {
        return new Dosenlb([
            'email' => $row['email'],
            'bulan' => $row['bulan'],
            'tahun' => $row['tahun'],
            'nama' => $row['nama'],
            'jabatan_struktural' => $row['jabatan_struktural'],
            'jabatan_fungsional' => $row['jabatan_fungsional'],
            'honor_pokok' => $row['honor_pokok'],
            'matkul_1' => $row['matkul_1'],
            'nominal_matkul_1' => $row['nominal_matkul_1'],
            'sks_matkul_1' => $row['sks_matkul_1'],
            'jml_hadir_mkl_1' => $row['jml_hadir_mkl_1'],
            'honor_mk_1' => $row['honor_mk_1'],
            'matkul_2' => $row['matkul_2'],
            'nominal_matkul_2' => $row['nominal_matkul_2'],
            'sks_matkul_2' => $row['sks_matkul_2'],
            'jml_hadir_mkl_2' => $row['jml_hadir_mkl_2'],
            'honor_mk_2' => $row['honor_mk_2'],
            'matkul_3' => $row['matkul_3'],
            'nominal_matkul_3' => $row['nominal_matkul_3'],
            'sks_matkul_3' => $row['sks_matkul_3'],
            'jml_hadir_mkl_3' => $row['jml_hadir_mkl_3'],
            'honor_mk_3' => $row['honor_mk_3'],
            'matkul_4' => $row['matkul_4'],
            'nominal_matkul_4' => $row['nominal_matkul_4'],
            'sks_matkul_4' => $row['sks_matkul_4'],
            'jml_hadir_mkl_4' => $row['jml_hadir_mkl_4'],
            'honor_mk_4' => $row['honor_mk_4'],
            'matkul_5' => $row['matkul_5'],
            'nominal_matkul_5' => $row['nominal_matkul_5'],
            'sks_matkul_5' => $row['sks_matkul_5'],
            'jml_hadir_mkl_5' => $row['jml_hadir_mkl_5'],
            'honor_mk_5' => $row['honor_mk_5'],
            'matkul_6' => $row['matkul_6'],
            'nominal_matkul_6' => $row['nominal_matkul_6'],
            'sks_matkul_6' => $row['sks_matkul_6'],
            'jml_hadir_mkl_6' => $row['jml_hadir_mkl_6'],
            'honor_mk_6' => $row['honor_mk_6'],
            'anggota_klp_dosen' => $row['anggota_klp_dosen'],
            'pembuatan_soal' => $row['pembuatan_soal'],
            'koreksi_soal' => $row['koreksi_soal'],
            'pengawas_ujian' => $row['pengawas_ujian'],
            'jumlah' => $row['jumlah'],
            'pph_21' => $row['pph_21'],
            'honor_yang_dibayar' => $row['honor_yang_dibayar']
        ]);
    }

    public function rules(): array
    {
        return [
            'email' => 'required|string|max:100',
            'bulan' => 'required|integer',
            'tahun' => 'required|integer',
            'nama' => 'required|string|max:100',
            'jabatan_struktural' => 'required|string|max:100',
            'jabatan_fungsional' => 'required|string|max:100',
            'honor_pokok' => 'required|integer',
            'matkul_1' => 'nullable|string|max:100',
            'nominal_matkul_1' => 'nullable|integer',
            'sks_matkul_1' => 'nullable|integer',
            'jml_hadir_mkl_1' => 'nullable|integer',
            'honor_mk_1' => 'nullable|integer',
            'matkul_2' => 'nullable|string|max:100',
            'nominal_matkul_2' => 'nullable|integer',
            'sks_matkul_2' => 'nullable|integer',
            'jml_hadir_mkl_2' => 'nullable|integer',
            'honor_mk_2' => 'nullable|integer',
            'matkul_3' => 'nullable|string|max:100',
            'nominal_matkul_3' => 'nullable|integer',
            'sks_matkul_3' => 'nullable|integer',
            'jml_hadir_mkl_3' => 'nullable|integer',
            'honor_mk_3' => 'nullable|integer',
            'matkul_4' => 'nullable|string|max:100',
            'nominal_matkul_4' => 'nullable|integer',
            'sks_matkul_4' => 'nullable|integer',
            'jml_hadir_mkl_4' => 'nullable|integer',
            'honor_mk_4' => 'nullable|integer',
            'matkul_5' => 'nullable|string|max:100',
            'nominal_matkul_5' => 'nullable|integer',
            'sks_matkul_5' => 'nullable|integer',
            'jml_hadir_mkl_5' => 'nullable|integer',
            'honor_mk_5' => 'nullable|integer',
            'matkul_6' => 'nullable|string|max:100',
            'nominal_matkul_6' => 'nullable|integer',
            'sks_matkul_6' => 'nullable|integer',
            'jml_hadir_mkl_6' => 'nullable|integer',
            'honor_mk_6' => 'nullable|integer',
            'anggota_klp_dosen' => 'required|integer',
            'pembuatan_soal' => 'required|integer',
            'koreksi_soal' => 'required|integer',
            'pengawas_ujian' => 'required|integer',
            'jumlah' => 'required|integer',
            'pph_21' => 'required|integer',
            'honor_yang_dibayar' => 'required|integer',
        ];
    }
}

