<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenTetap extends Model
{
    use HasFactory;

    protected $table = 'dosen_tetap';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'email',
        'bulan',
        'tahun',
        'nama',
        'jabatan_struktural',
        'jabatan_fungsional',
        'gaji_pokok',
        'matkul_1',
        'tunjangan_kehadiran',
        'tunjangan_jabatan_struktural',
        'tunjangan_jabatan_fungsional',
        'honor_mengajar_kls_pagi',
        'honor_mengajar_kls_malam',
        'pmb_atau_penguji_kp',
        'pmb_1_proposal_pagi',
        'pmb_1_proposal_malam',
        'pmb_1_skripsi_pagi',
        'pmb_1_skripsi_malam',
        'pmb_2_proposal_pagi',
        'pmb_2_proposal_malam',
        'pmb_2_skripsi_pagi',
        'pmb_2_skripsi_malam',
        'penguji_sidang_proposal',
        'penguji_sidang_skripsi',
        'koreksi_soal',
        'pembuatan_soal',
        'dosen_wali',
        'pengawas_ujian',
        'pembina_ukm',
        'remidial',
        'pmb_company_visit',
        'reward_ekin',
        'jumlah_gaji_tunjangan_honor',
        'potongan_kas_bon',
        'pph_21',
        'potongan_absensi',
        'potongan_bpjs',
        'jumlah',
        'gaji_yang_dibayar'
    ];

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}

