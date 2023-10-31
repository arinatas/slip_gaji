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
        'sks_matkul_1',
        'jml_hadir_mkl_1',
        'honor_mk_1',
        'matkul_2',
        'nominal_matkul_2',
        'sks_matkul_2',
        'jml_hadir_mkl_2',
        'honor_mk_2',
        'matkul_3',
        'nominal_matkul_3',
        'sks_matkul_3',
        'jml_hadir_mkl_3',
        'honor_mk_3',
        'matkul_4',
        'nominal_matkul_4',
        'sks_matkul_4',
        'jml_hadir_mkl_4',
        'honor_mk_4',
        'matkul_5',
        'nominal_matkul_5',
        'sks_matkul_5',
        'jml_hadir_mkl_5',
        'honor_mk_5',
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

