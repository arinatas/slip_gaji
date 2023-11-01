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

            .table-sm td {
                font-size: 12px; /* You can adjust the font size as needed */
            }

            .table-sm th {
                font-size: 12px; /* You can adjust the font size as needed */
            }
            .table-responsive td {
                font-size: 12px; /* You can adjust the font size as needed */
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
                        <h4 style="margin: 5px 0;">SLIP HONOR DOSEN</h4>
                        <h3 style="margin: 5px 0;">PRIMAKARA UNIVERSITY</h3>
                        <h6 style="margin: 5px 0; text-transform: uppercase;">PERIODE {{ ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$item->bulan - 1] }} {{ $item->tahun }}</h6>
                    </div>
                </div>

                <!-- Table row -->
                    <div class="col-12 table-responsive">
                        <table>
                        <tr>
                            <td>
                                <div>
                                    Nama
                                </div>
                                </td>
                            <td style="text-align: left;"> : {{ $item->nama }}</td>
                        </tr>
                        <tr>
                            <td>
                                <div>
                                    Jabatan Struktural 
                                    </div>
                                </td>
                            <td style="text-align: left;"> : {{ $item->jabatan_struktural }}</td>
                        </tr>
                        <tr>
                            <td>
                                <div>
                                    Jabatan Fungsional
                                    </div>
                                </td>
                            <td style="text-align: left;"> : {{ $item->jabatan_fungsional }}</td>
                        </tr>
                        </table>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="fw-semibold fs-6 text-bold">
                                    <th>Deskripsi</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div>
                                            Honor Pokok
                                        </div>
                                    </td>
                                    <td style="text-align: right;">Rp. @currency( $item->honor_pokok )</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Anggota Klp Dosen
                                        </div>
                                    </td>
                                    <td style="text-align: right;">Rp. @currency( $item->anggota_klp_dosen )</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Pembuatan Soal
                                        </div>
                                    </td>
                                    <td style="text-align: right;">Rp. @currency( $item->pembuatan_soal )</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Koreksi Soal
                                        </div>
                                    </td>
                                    <td style="text-align: right;">Rp. @currency( $item->koreksi_soal )</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Pengawas Ujian
                                        </div>
                                    </td>
                                    <td style="text-align: right;">Rp. @currency( $item->pengawas_ujian )</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="fw-semibold fs-6 text-bold">
                                    <th>Matakuliah</th>
                                    <th>SKS</th>
                                    <th>Hadir/Jml</th>
                                    <th>Honor/SKS</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @if($item->matkul_1 !== null && $item->nominal_matkul_1 !== null && $item->sks_matkul_1 !== null && $item->jml_hadir_mkl_1 !== null && $item->honor_mk_1 !== null)
                                        <td>{{ $item->matkul_1 }}</td>
                                        <td style="text-align: center;">{{ $item->sks_matkul_1 }}</td>
                                        <td style="text-align: center;">{{ $item->jml_hadir_mkl_1 }}</td>
                                        <td style="text-align: center;"> X Rp. @currency( $item->honor_mk_1 )</td>
                                        <td style="text-align: right;">Rp. @currency( $item->nominal_matkul_1 )</td>
                                    @endif
                                </tr>
                                <tr>
                                    @if($item->matkul_2 !== null && $item->nominal_matkul_2 !== null && $item->sks_matkul_2 !== null && $item->jml_hadir_mkl_2 !== null && $item->honor_mk_2 !== null)
                                        <td>{{ $item->matkul_2 }}</td>
                                        <td style="text-align: center;">{{ $item->sks_matkul_2 }}</td>
                                        <td style="text-align: center;">{{ $item->jml_hadir_mkl_2 }}</td>
                                        <td style="text-align: center;"> X Rp. @currency( $item->honor_mk_2 )</td>
                                        <td style="text-align: right;">Rp. @currency( $item->nominal_matkul_2 )</td>
                                    @endif
                                </tr>
                                <tr>
                                    @if($item->matkul_3 !== null && $item->nominal_matkul_3 !== null && $item->sks_matkul_3 !== null && $item->jml_hadir_mkl_3 !== null && $item->honor_mk_3 !== null)
                                        <td>{{ $item->matkul_3 }}</td>
                                        <td style="text-align: center;">{{ $item->sks_matkul_3 }}</td>
                                        <td style="text-align: center;">{{ $item->jml_hadir_mkl_3 }}</td>
                                        <td style="text-align: center;"> X Rp. @currency( $item->honor_mk_3 )</td>
                                        <td style="text-align: right;">Rp. @currency( $item->nominal_matkul_3 )</td>
                                    @endif
                                </tr>
                                <tr>
                                    @if($item->matkul_4 !== null && $item->nominal_matkul_4 !== null && $item->sks_matkul_4 !== null && $item->jml_hadir_mkl_4 !== null && $item->honor_mk_4 !== null)
                                        <td>{{ $item->matkul_4 }}</td>
                                        <td style="text-align: center;">{{ $item->sks_matkul_4 }}</td>
                                        <td style="text-align: center;">{{ $item->jml_hadir_mkl_4 }}</td>
                                        <td style="text-align: center;"> X Rp. @currency( $item->honor_mk_4 )</td>
                                        <td style="text-align: right;">Rp. @currency( $item->nominal_matkul_4 )</td>
                                    @endif
                                </tr>
                                <tr>
                                    @if($item->matkul_5 !== null && $item->nominal_matkul_5 !== null && $item->sks_matkul_5 !== null && $item->jml_hadir_mkl_5 !== null && $item->honor_mk_5 !== null)
                                        <td>{{ $item->matkul_5 }}</td>
                                        <td style="text-align: center;">{{ $item->sks_matkul_5 }}</td>
                                        <td style="text-align: center;">{{ $item->jml_hadir_mkl_5 }}</td>
                                        <td style="text-align: center;"> X Rp. @currency( $item->honor_mk_5 )</td>
                                        <td style="text-align: right;">Rp. @currency( $item->nominal_matkul_5 )</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered">
                                <tr>
                                    <td>
                                        <b>Jumlah</b>
                                    </td>
                                    <td style="text-align: right;"><b> + Rp. @currency( $item->jumlah )</b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Potongan Pph 21</b>
                                    </td>
                                    <td style="text-align: right;"><b> - Rp. @currency( $item->pph_21 )</b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Honor yang dibayar</b>
                                    </td>
                                    <td style="text-align: right;"><b>Rp. @currency( $item->honor_yang_dibayar )</b></td>
                                </tr>
                        </table>
                    </div>
                    <!-- /.col -->
    
                    <div class="row">
                        <div class="col-sm-12 invoice-col mt-5">
                            <address style="text-align: right; padding-right: 10px;"> <!-- Atur text-align ke center -->
                                <p style="font-size: 12px;">Denpasar, 28 {{ ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$item->bulan - 1] }} {{ $item->tahun }}</p><br>
                                <img alt="Logo" class="" src="assets/media/logos/ttd.png" width="160px" />
                                <br>
                                <strong style="font-size: 14px; text-decoration: underline;">I Made Artana, S.Kom.,M.M.</strong><br>
                                <strong style="font-size: 14px;">Rektor Primakara University</strong><br>
                            </address>
                        </div>
                    </div>
                </div>
        @endforeach
    </body>
</html>
