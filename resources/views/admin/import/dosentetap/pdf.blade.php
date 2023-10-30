<!DOCTYPE html>
<html>
<head>
    <title>Slip Gaji Dosen Tetap</title>
    <style>
        .slip-gaji {
            page-break-before: always; /* Membuat halaman baru setiap slip gaji */
        }
    </style>
</head>
<body>
    @foreach ($data as $item)
    <div class="slip-gaji">
        <h1>Slip Gaji Dosen Tetap</h1>
        <p>Email: {{ $item->email }}</p>
        <p>Periode: {{ ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$item->bulan - 1] }} {{ $item->tahun }}</p>
        <p>Nama: {{ $item->nama }}</p>
        <p>Jabatan Struktural: {{ $item->jabatan_struktural }}</p>
        <p>Jabatan Fungsional: {{ $item->jabatan_fungsional }}</p>
        <p>Gaji Pokok: {{ $item->gaji_pokok }}</p>
        <p>Tunjangan Kehadiran: {{ $item->tunjangan_kehadiran }}</p>
        <p>Tunj. Jbt.Struktural: {{ $item->tunjangan_jabatan_struktural }}</p>
        <p>Tunj. Jbt. Fungsional: {{ $item->tunjangan_jabatan_fungsional }}</p>
        <p>Honor Mengajar Kelas Pagi: {{ $item->honor_mengajar_kls_pagi }}</p>
        <p>Honor Mengajar Kelas Malam: {{ $item->honor_mengajar_kls_malam }}</p>
        <p>Pmb./Penguji Kerja Praktek: {{ $item->pmb_atau_penguji_kp }}</p>
        <p>Pmb. I Proposal (kls pagi): {{ $item->pmb_1_proposal_pagi }}</p>
        <p>Pmb. I Proposal (kls malam): {{ $item->pmb_1_proposal_malam }}</p>
        <p>Pmb. I Skripsi (kls pagi): {{ $item->pmb_1_skripsi_pagi }}</p>
        <p>Pmb. I Skripsi (kls malam): {{ $item->pmb_1_skripsi_malam }}</p>
        <p>Pmb. II Proposal (kls pagi): {{ $item->pmb_2_proposal_pagi }}</p>
        <p>Pmb. II Proposal (kls malam): {{ $item->pmb_2_proposal_malam }}</p>
        <p>Pmb. II Skripsi (kls pagi): {{ $item->pmb_2_skripsi_pagi }}</p>
        <p>Pmb. II Skripsi (kls malam): {{ $item->pmb_2_skripsi_malam }}</p>
        <p>Penguji Sidang Proposal: {{ $item->penguji_sidang_proposal }}</p>
        <p>Penguji Sidang Skripsi: {{ $item->penguji_sidang_skripsi }}</p>
        <p>Koreksi Soal: {{ $item->koreksi_soal }}</p>
        <p>Pembuatan Soal: {{ $item->pembuatan_soal }}</p>
        <p>Dosen Wali: {{ $item->dosen_wali }}</p>
        <p>Pengawas Ujian: {{ $item->pengawas_ujian }}</p>
        <p>Pembina UKM: {{ $item->pembina_ukm }}</p>
        <p>Remidial: {{ $item->remidial }}</p>
        <p>Pemb. Company Visit: {{ $item->pmb_company_visit }}</p>
        <p>Reward EKIN: {{ $item->reward_ekin }}</p>
        <p>Jumlah Gaji, Tunjangan dan honor: {{ $item->jumlah_gaji_tunjangan_honor }}</p>
        <p>Potongan Kas Bon: {{ $item->potongan_kas_bon }}</p>
        <p>Pph 21: {{ $item->pph_21 }}</p>
        <p>Potongan Absensi: {{ $item->potongan_absensi }}</p>
        <p>Potongan BPJS: {{ $item->potongan_bpjs }}</p>
        <p>Jumlah: {{ $item->jumlah }}</p>
        <p>Gaji Yang dibayar: {{ $item->gaji_yang_dibayar }}</p>
    </div>
    @endforeach
</body>
</html>
