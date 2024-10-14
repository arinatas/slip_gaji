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
        'tunjangan_kehadiran',
        'tunjangan_jabatan_struktural',
        'tunjangan_jabatan_fungsional',
        'honor_mengajar_kls_pagi',
        'x_honor_mengajar_kls_pagi',
        'nominal_honor_mengajar_kls_pagi',
        'honor_mengajar_kls_malam',
        'x_honor_mengajar_kls_malam',
        'nominal_honor_mengajar_kls_malam',
        'koordinator_matkul',
        'x_koordinator_matkul',
        'nominal_koordinator_matkul',
        'koor_anggota_mbkm',
        'x_koor_anggota_mbkm',
        'nominal_koor_anggota_mbkm',
        'pmb_atau_penguji_mbkm',
        'x_pmb_atau_penguji_mbkm',
        'nominal_pmb_atau_penguji_mbkm',
        'pmb_1_proposal_pagi',
        'x_pmb_1_proposal_pagi',
        'nominal_pmb_1_proposal_pagi',
        'pmb_1_proposal_malam',
        'x_pmb_1_proposal_malam',
        'nominal_pmb_1_proposal_malam',
        'pmb_1_skripsi_pagi',
        'x_pmb_1_skripsi_pagi',
        'nominal_pmb_1_skripsi_pagi',
        'pmb_1_skripsi_malam',
        'x_pmb_1_skripsi_malam',
        'nominal_pmb_1_skripsi_malam',
        'pmb_2_proposal_pagi',
        'x_pmb_2_proposal_pagi',
        'nominal_pmb_2_proposal_pagi',
        'pmb_2_proposal_malam',
        'x_pmb_2_proposal_malam',
        'nominal_pmb_2_proposal_malam',
        'pmb_2_skripsi_pagi',
        'x_pmb_2_skripsi_pagi',
        'nominal_pmb_2_skripsi_pagi',
        'pmb_2_skripsi_malam',
        'x_pmb_2_skripsi_malam',
        'nominal_pmb_2_skripsi_malam',
        'penguji_sidang_proposal',
        'x_penguji_sidang_proposal',
        'nominal_penguji_sidang_proposal',
        'penguji_sidang_skripsi',
        'x_penguji_sidang_skripsi',
        'nominal_penguji_sidang_skripsi',
        'koreksi_soal',
        'x_koreksi_soal',
        'nominal_koreksi_soal',
        'pembuatan_soal',
        'x_pembuatan_soal',
        'nominal_pembuatan_soal',
        'dosen_wali',
        'x_dosen_wali',
        'nominal_dosen_wali',
        'pengawas_ujian',
        'x_pengawas_ujian',
        'nominal_pengawas_ujian',
        'remidial',
        'x_remidial',
        'nominal_remidial',
        'pmb_company_visit',
        'x_pmb_company_visit',
        'nominal_pmb_company_visit',
        'pembina_ukm',
        'reward_ekin',
        'jumlah_gaji_tunjangan_honor',
        'potongan_kas_bon',
        'punishment_ekin',
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

