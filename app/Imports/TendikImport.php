<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; // row 1 sebagai heading
use Maatwebsite\Excel\Concerns\WithValidation; // validasi string / integer
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\Tendik;

class TendikImport implements ToModel, WithHeadingRow, WithValidation // Gunakan WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        // Logika untuk memasukkan data ke dalam model Tendik
        return new Tendik([
            'email' => $row['email'],
            'bulan' => $row['bulan'],
            'tahun' => $row['tahun'],
            'nama' => $row['nama'],
            'jabatan' => $row['jabatan'],
            'gaji_pokok' => $row['gaji_pokok'],
            'tunjangan_jabatan' => $row['tunjangan_jabatan'],
            'bonus' => $row['bonus'],
            'tunjangan_kehadiran' => $row['tunjangan_kehadiran'],
            'tunjangan_lembur' => $row['tunjangan_lembur'],
            'tunj_pel_mhs_op_feeder' => $row['tunj_pel_mhs_op_feeder'],
            'tunjangan_kinerja' => $row['tunjangan_kinerja'],
            'jumlah_penambah' => $row['jumlah_penambah'],
            'potongan_kasbon' => $row['potongan_kasbon'],
            'denda_keterlambatan' => $row['denda_keterlambatan'],
            'potongan_pph_21' => $row['potongan_pph_21'],
            'potongan_absensi' => $row['potongan_absensi'],
            'potongan_bpjs' => $row['potongan_bpjs'],
            'jumlah_pengurang' => $row['jumlah_pengurang'],
            'gaji_yang_dibayar' => $row['gaji_yang_dibayar']
        ]);
    }

    public function rules(): array
    {
        return [
            // Sesuaikan aturan validasi dengan kunci (header) yang Anda tetapkan
            'email' => 'required|string|max:255',
            'bulan' => 'required|integer',
            'tahun' => 'required|integer',
            'nama' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'gaji_pokok' => 'required|integer',
            'tunjangan_jabatan' => 'required|integer',
            'bonus' => 'required|integer',
            'tunjangan_kehadiran' => 'required|integer',
            'tunjangan_lembur' => 'required|integer',
            'tunj_pel_mhs_op_feeder' => 'required|integer',
            'tunjangan_kinerja' => 'required|integer',
            'jumlah_penambah' => 'required|integer',
            'potongan_kasbon' => 'required|integer',
            'denda_keterlambatan' => 'required|integer',
            'potongan_pph_21' => 'required|integer',
            'potongan_absensi' => 'required|integer',
            'potongan_bpjs' => 'required|integer',
            'jumlah_pengurang' => 'required|integer',
            'gaji_yang_dibayar' => 'required|integer',
        ];
    }
}
