<!DOCTYPE html>
<html>
<head>
    <title>Slip Gaji Dosen LB</title>
    <style>
        .slip-gaji {
            page-break-before: always; /* Membuat halaman baru setiap slip gaji */
        }
    </style>
</head>
<body>
    @foreach ($data as $item)
    <div class="slip-gaji">
        <h1>Slip Gaji Dosen LB</h1>
        <p>Email: {{ $item->email }}</p>
        <p>Periode: {{ ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$item->bulan - 1] }} {{ $item->tahun }}</p>
        <p>Nama: {{ $item->nama }}</p>
        <p>Jabatan Struktural: {{ $item->jabatan_struktural }}</p>
        <p>Jabatan Fungsional: {{ $item->jabatan_fungsional }}</p>
        <p>Honor Pokok: {{ $item->honor_pokok }}</p>
        <p>Matkul 1: {{ $item->matkul_1 }}</p>
        <p>Nominal Matkul 1: {{ $item->nominal_matkul_1 }}</p>
        <p>Matkul 2: {{ $item->matkul_2 }}</p>
        <p>Nominal Matkul 2: {{ $item->nominal_matkul_2 }}</p>
        <p>Matkul 3: {{ $item->matkul_3 }}</p>
        <p>Nominal Matkul 3: {{ $item->nominal_matkul_3 }}</p>
        <p>Matkul 4: {{ $item->matkul_4 }}</p>
        <p>Nominal Matkul 4: {{ $item->nominal_matkul_4 }}</p>
        <p>Matkul 5: {{ $item->matkul_5 }}</p>
        <p>Nominal Matkul 5: {{ $item->nominal_matkul_5 }}</p>
        <p>Anggota Klp Dosen: {{ $item->anggota_klp_dosen }}</p>
        <p>Pembuatan Soal: {{ $item->pembuatan_soal }}</p>
        <p>Koreksi Soal: {{ $item->koreksi_soal }}</p>
        <p>Pengawas Ujian: {{ $item->pengawas_ujian }}</p>
        <p>Jumlah: {{ $item->jumlah }}</p>
        <p>Pph 21: {{ $item->pph_21 }}</p>
        <p>Honor Yang dibayar: {{ $item->honor_yang_dibayar }}</p>
    </div>
    @endforeach
</body>
</html>
