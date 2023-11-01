<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Slip Gaji Primakara</title>
		<link rel="shortcut icon" href="assets/media/logos/univ.png" />

        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap 4 -->

        <!-- Font Awesome -->
        <!-- Ionicons -->
        <!-- adminlte css-->
        <link rel="stylesheet" href="css/adminlte.min.css">
        <style>
            .slip-gaji {
                page-break-before: always; /* Membuat halaman baru setiap slip gaji */
                margin: 10px;
                padding: 10px 25px 10px 10px;
                border: 1px solid #000;
                display: flex;
                align-items: center;
            }

            .slip-gaji:first-of-type {
                page-break-before: auto; /* Tidak ada page break pada elemen pertama */
            }

            .logo {
                flex: 1; /* Mengambil sebagian besar ruang di sebelah kanan untuk logo */
                text-align: right;
            }

            .judul {
                flex: 2; /* Mengambil sebagian besar ruang di tengah untuk judul */
                text-align: center;
            }
    </style>
    </head>

    <body>
        @foreach ($data as $item)
        <div class="slip-gaji">
                <!-- title row -->
                <div class="row">
                    <div class="col-2">
                        <img alt="Logo" class="" src="assets/media/logos/univ.png" width="160px" />
                    </div>
                    <div class="col-12 table-responsive" style="text-align: center; padding: 10px;">
                        <h3 style="margin: 5px 0;">SLIP GAJI TENDIK</h3>
                        <h2 style="margin: 5px 0;">PRIMAKARA UNIVERSITY</h2>
                        <h4 style="margin: 5px 0; text-transform: uppercase;">PERIODE {{ ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$item->bulan - 1] }} {{ $item->tahun }}</h4>
                    </div>
                </div>

                <!-- Table row -->
        
                    <div class="col-12 table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="fw-semibold fs-6 text-bold">
                                    <th>Deskripsi</th>
                                    <th style="text-align: right;">Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div>
                                            Gaji Pokok
                                        </div>
                                    </td>
                                    <td style="text-align: right;">Rp. {{ $item->gaji_pokok }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Tunjangan Jabatan
                                        </div>
                                    </td>
                                    <td style="text-align: right;">Rp. {{ $item->tunjangan_jabatan }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Tunjangan Kehadiran
                                        </div>
                                    </td>
                                    <td style="text-align: right;">Rp. {{ $item->tunjangan_kehadiran }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Tunjangan lembur
                                        </div>
                                    </td>
                                    <td style="text-align: right;">Rp. {{ $item->tunjangan_lembur }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Tunj. Pel. Mhs/Op. Feeder
                                        </div>
                                    </td>
                                    <td style="text-align: right;">Rp. {{ $item->tunj_pel_mhs_op_feeder }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Tunjangan Kinerja
                                        </div>
                                    </td>
                                    <td style="text-align: right;">Rp. {{ $item->tunjangan_kinerja }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <b>Jumlah Penambah</b>
                                        </div>
                                    </td>
                                    <td style="text-align: right;"><b> + Rp. {{ $item->jumlah_penambah }}</b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Potongan Kasbon
                                        </div>
                                    </td>
                                    <td style="text-align: right;">Rp. {{ $item->potongan_kasbon }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Denda Keterlambatan
                                        </div>
                                    </td>
                                    <td style="text-align: right;">Rp. {{ $item->denda_keterlambatan }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Potongan Pph 21
                                        </div>
                                    </td>
                                    <td style="text-align: right;">Rp. {{ $item->potongan_pph_21 }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Potongan Absensi
                                        </div>
                                    </td>
                                    <td style="text-align: right;">Rp. {{ $item->potongan_absensi }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Potongan BPJS
                                        </div>
                                    </td>
                                    <td style="text-align: right;">Rp. {{ $item->potongan_bpjs }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <b>Jumlah Pengurang</b>
                                        </div>
                                    </td>
                                    <td style="text-align: right;"><b> - Rp. {{ $item->jumlah_pengurang }}</b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <b>Gaji yang dibayar</b>
                                        </div>
                                    </td>
                                    <td style="text-align: right;"><b> Rp. {{ $item->gaji_yang_dibayar }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
    
                    <div class="row">
                        <div class="col-sm-12 invoice-col mt-5">
                            <address style="text-align: center;"> <!-- Atur text-align ke center -->
                                <strong>Denpasar, 28 {{ ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$item->bulan - 1] }} {{ $item->tahun }}</strong><br>
                                <img alt="Logo" class="" src="assets/media/logos/ttd.png" width="200px" />
                                <br>
                                <strong>I Made Artana, S.Kom.,M.M.</strong><br>
                                <strong>Rektor Primakara University</strong><br>
                            </address>
                        </div>
                    </div>
                </div>
        @endforeach
    </body>
</html>
