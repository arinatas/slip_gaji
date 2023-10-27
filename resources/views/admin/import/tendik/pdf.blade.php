<!DOCTYPE html>
<html>
<head>
    <title>Slip Gaji Karyawan</title>
    <style>
        .slip-gaji {
            page-break-before: always; /* Membuat halaman baru setiap slip gaji */
        }
    </style>
</head>
<body>
    @foreach ($data as $item)
    <div class="slip-gaji">
        <h1>Slip Gaji Karyawan</h1>
        <p>Email: {{ $item->email }}</p>
        <p>Periode: {{ ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$item->bulan - 1] }} {{ $item->tahun }}</p>
        <p>Nama: {{ $item->nama }}</p>
        <p>Jabatan: {{ $item->jabatan }}</p>
        <p>Gaji Pokok: {{ $item->gaji_pokok }}</p>
        <p>Tunjangan Jabatan: {{ $item->tunjangan_jabatan }}</p>
        <p>Tunjangan Kehadiran: {{ $item->tunjangan_kehadiran }}</p>
        <p>Tunjangan Lembur: {{ $item->tunjangan_lembur }}</p>
        <p>Tunj. Pel. Mhs/Op. Feeder: {{ $item->tunj_pel_mhs_op_feeder }}</p>
        <p>Tunjangan Kinerja: {{ $item->tunjangan_kinerja }}</p>
        <p>Jumlah Penambah: {{ $item->jumlah_penambah }}</p>
        <p>Potongan Kasbon: {{ $item->potongan_kasbon }}</p>
        <p>Denda Keterlambatan: {{ $item->denda_keterlambatan }}</p>
        <p>Potongan Pph 21: {{ $item->potongan_pph_21 }}</p>
        <p>Potongan Absensi: {{ $item->potongan_absensi }}</p>
        <p>Potongan BPJS: {{ $item->potongan_bpjs }}</p>
        <p>Jumlah Pengurang: {{ $item->jumlah_pengurang }}</p>
        <p>Gaji yang Dibayarkan: {{ $item->gaji_yang_dibayar }}</p>
    </div>
    @endforeach
</body>
</html>
