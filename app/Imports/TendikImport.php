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
            'id_pegawai' => $row[0],
            'bulan' => $row[1],
            'tahun' => $row[2],
        ]);
    }
}
