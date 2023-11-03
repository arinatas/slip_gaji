<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Slip Gaji</title>
		<link rel="shortcut icon" href="/assets/media/logos/smallprimakara.png" />

        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap 4 -->

        <!-- Font Awesome -->
        <!-- Ionicons -->
        <!-- adminlte css-->
        <link rel="stylesheet" href="/css/adminlte.min.css">

        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <style>
            .slip-gaji {
                page-break-before: always; /* Membuat halaman baru setiap slip gaji */
            }

            .slip-gaji:first-of-type {
                page-break-before: auto; /* Tidak ada page break pada elemen pertama */
            }
    </style>
    </head>

    <body>
    @foreach ($data as $item)
    <div class="slip-gaji">
        <div class="wrapper">
            <!-- Main content -->
            <section class="invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-2">
                        <img alt="Logo" class="" src="/assets/media/logos/univ.png" width="160px" />
                    </div>
                    <div class="col-9 text-center">
                        <h2>SLIP HONOR DOSEN</h2>
                        <h1>PRIMAKARA UNIVERSITY</h1>
                        <h2 style="text-transform: uppercase;">PERIODE {{ ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$item->bulan - 1] }} {{ $item->tahun }}</h2>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-9 invoice-col mt-3">
                        <address>
                            <table>
                                <tr>
                                    <td>Nama</td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td>: &nbsp;&nbsp;&nbsp;{{ $item->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Jabatan Struktural</td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td>: &nbsp;&nbsp;&nbsp;{{ $item->jabatan_struktural }}</td>
                                </tr>
                                <tr>
                                    <td>Jabatan Fungsional</td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td>: &nbsp;&nbsp;&nbsp;{{ $item->jabatan_fungsional }}</td>
                                </tr>
                            </table>
                        </address>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="fw-semibold fs-6 text-bold">
                                    <th style="text-align: center;">Deskripsi</th>
                                    <th style="text-align: center;">Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div>
                                            Honor Pokok
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency( $item->honor_pokok )</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Anggota Klp Dosen
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency( $item->anggota_klp_dosen )</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Pembuatan Soal
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency( $item->pembuatan_soal )</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Koreksi Soal
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency( $item->koreksi_soal )</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Pengawas Ujian
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency( $item->tunjangan_lembur )</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="fw-semibold fs-6 text-bold">
                                    <th style="text-align: center;">Matakuliah</th>
                                    <th style="text-align: center;">SKS</th>
                                    <th style="text-align: center;">Hadir/Jml</th>
                                    <th style="text-align: center;">Honor/SKS</th>
                                    <th style="text-align: center;">Nominal</th>
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
                </div>
                <!-- /.row -->

                <!-- info row -->
                <div class="row">
                    <div class="col-sm-12 invoice-col mt-5">
                        <address style="float: inline-end;" class="mr-5">
                            <p>Denpasar, {{ date('d F Y', strtotime($item->created_at)) }}</strong><br>
                            <img alt="Logo" class="" src="/assets/media/logos/ttd.png" width="160px" />
                            <br>
                            <strong><u>I Made Artana, S.Kom.,M.M.</u></strong><br>
                            <strong>Rektor Primakara University</strong><br>
                        </address>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->


            </section>

            </div>
        </div>
        <!-- ./wrapper -->

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var dateElements = document.querySelectorAll('[data-date]');

                dateElements.forEach(function(element) {
                    var dateValue = element.getAttribute('data-date');
                    var formattedDate = new Date(dateValue).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });

                    element.textContent = formattedDate;
                });
            });
        </script>

        <script type="text/javascript">
            window.addEventListener("load", window.print());
        </script>
    @endforeach
    </body>
</html>
