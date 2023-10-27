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
        <p>ID Pegawai: {{ $item->id_pegawai }}</p>
        <p>Kode Pegawai: {{ $item->kode_pegawai }}</p>
        <p>Bulan: {{ ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$item->bulan - 1] }}</p>
        <p>Tahun: {{ $item->tahun }}</p>
    </div>
    @endforeach
</body>
</html>
