<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tendik extends Model
{
    use HasFactory;

    protected $table = 'tendik';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'email',
        'bulan',
        'tahun',
        'nama',
        'jabatan',
        'gaji_pokok',
        'tunjangan_jabatan',
        'tunjangan_kehadiran',
        'tunjangan_lembur',
        'tunj_pel_mhs_op_feeder',
        'tunjangan_kinerja',
        'jumlah_penambah',
        'potongan_kasbon',
        'denda_keterlambatan',
        'potongan_pph_21',
        'potongan_absensi',
        'potongan_bpjs',
        'jumlah_pengurang',
        'gaji_yang_dibayar'
    ];

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}

