<!DOCTYPE html>
<html>
<head>
    <title>Slip Gaji</title>
    <style>
        .slip-gaji {
            page-break-before: always; /* Membuat halaman baru setiap slip gaji */
        }
    </style>
</head>
<body>
    @foreach ($data as $item)
    <div class="slip-gaji">
        <h1>Slip Gaji</h1>
        <p>ID Pegawai: {{ $item->id_pegawai }}</p>
        <p>Kode Pegawai: {{ $item->kode_pegawai }}</p>
        <p>Bulan: 
            @if ($item->bulan == 1)
                Januari
            @elseif ($item->bulan == 2)
                Februari
            @elseif ($item->bulan == 3)
                Maret
            @elseif ($item->bulan == 4)
                April
            @endif
        </p>
        <p>Tahun: {{ $item->tahun }}</p>
    </div>
    @endforeach
</body>
</html>
