<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosenlb extends Model
{
    use HasFactory;

    protected $table = 'dosen_lb';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'email',
        'bulan',
        'tahun',
        'nama',
        'jabatan_struktural',
        'jabatan_fungsional',
        'honor_pokok',
        'matkul_1',
        'nominal_matkul_1',
        'matkul_2',
        'nominal_matkul_2',
        'matkul_3',
        'nominal_matkul_3',
        'matkul_4',
        'nominal_matkul_4',
        'matkul_5',
        'nominal_matkul_5',
        'anggota_klp_dosen',
        'pembuatan_soal',
        'koreksi_soal',
        'pengawas_ujian',
        'jumlah',
        'pph_21',
        'honor_yang_dibayar'
    ];

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}

