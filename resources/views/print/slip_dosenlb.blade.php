<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Slip Gaji</title>
		<link rel="shortcut icon" href="assets/media/logos/smallprimakara.png" />

        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap 4 -->

        <!-- Font Awesome -->
        <!-- Ionicons -->
        <!-- adminlte css-->
        <link rel="stylesheet" href="css/adminlte.min.css">

        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>

    <body>
        <div class="wrapper">
            <!-- Main content -->
            <section class="invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-2">
                        <img alt="Logo" class="" src="assets/media/logos/univ.png" width="160px" />
                    </div>
                    <div class="col-9 text-center">
                        <h2>SLIP HONOR DOSEN</h2>
                        <h1>PRIMAKARA UNIVERSITY</h1>
                        <h2>PERIODE @if ($bulan == 1)
                            JANUARY
                        @endif
                        @if ($bulan == 2)
                            FEBRUARY
                        @endif
                        @if ($bulan == 3)
                            MARCH
                        @endif
                        @if ($bulan == 4)
                            APRIL
                        @endif
                        @if ($bulan == 5)
                            MAY
                        @endif
                        @if ($bulan == 6)
                            JUNE
                        @endif
                        @if ($bulan == 7)
                            JULY
                        @endif
                        @if ($bulan == 8)
                            AUGUST
                        @endif
                        @if ($bulan == 9)
                            SEPTEMBER
                        @endif
                        @if ($bulan == 10)
                            OCTOBER
                        @endif
                        @if ($bulan == 11)
                            NOVEMBER
                        @endif
                        @if ($bulan == 12)
                            DECEMBER
                        @endif {{ $tahun }}</h2>
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
                                    <td>: &nbsp;&nbsp;&nbsp;{{ auth()->user()->name }}</td>
                                </tr>
                                <tr>
                                    <td>Jabatan Fungsional</td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td>: &nbsp;&nbsp;&nbsp;{{ $Datas[0]->jabatan_fungsional }}</td>
                                </tr>
                                <tr>
                                    <td>Jabatan Struktural</td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td>: &nbsp;&nbsp;&nbsp;{{ $Datas[0]->jabatan_struktural }}</td>
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
                                    <th>Deskripsi</th>
                                    <th style="text-align: end;">Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div>
                                            Honor Pokok
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->honor_pokok)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Anggota Klp Dosen
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->anggota_klp_dosen)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Pembuatan Soal
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->pembuatan_soal)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Koreksi Soal
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->koreksi_soal)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Pengawas Ujian
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->pengawas_ujian)</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="fw-semibold fs-6 text-bold">
                                    <th>Matakuliah</th>
                                    <th>SKS</th>
                                    <th>Hadir / Jml</th>
                                    <th>Honor / SKS</th>
                                    <th style="text-align: end;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($Datas[0]->matkul_1 || $Datas[0]->nominal_matkul_1)
                                    <tr>
                                        <td>
                                            <div>
                                                {{ $Datas[0]->matkul_1 }}
                                            </div>
                                        </td>
                                        <td>{{ $Datas[0]->sks_matkul_1 }}</td>
                                        <td>{{ $Datas[0]->jml_hadir_mkl_1 }}</td>
                                        <td>Rp. @currency($Datas[0]->honor_mk_1)</td>
                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_matkul_1)</td>
                                    </tr>
                                @endif
                                @if ($Datas[0]->matkul_2 || $Datas[0]->nominal_matkul_2)
                                    <tr>
                                        <td>
                                            <div>
                                                {{ $Datas[0]->matkul_2 }}
                                            </div>
                                        </td>
                                        <td>{{ $Datas[0]->sks_matkul_2 }}</td>
                                        <td>{{ $Datas[0]->jml_hadir_mkl_2 }}</td>
                                        <td>Rp. @currency($Datas[0]->honor_mk_2)</td>
                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_matkul_2)</td>
                                    </tr>
                                @endif
                                @if ($Datas[0]->matkul_3 || $Datas[0]->nominal_matkul_3)
                                    <tr>
                                        <td>
                                            <div>
                                                {{ $Datas[0]->matkul_3 }}
                                            </div>
                                        </td>
                                        <td>{{ $Datas[0]->sks_matkul_3 }}</td>
                                        <td>{{ $Datas[0]->jml_hadir_mkl_3 }}</td>
                                        <td>Rp. @currency($Datas[0]->honor_mk_3)</td>
                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_matkul_3)</td>
                                    </tr>
                                @endif
                                @if ($Datas[0]->matkul_4 || $Datas[0]->nominal_matkul_4)
                                    <tr>
                                        <td>
                                            <div>
                                                {{ $Datas[0]->matkul_4 }}
                                            </div>
                                        </td>
                                        <td>{{ $Datas[0]->sks_matkul_4 }}</td>
                                        <td>{{ $Datas[0]->jml_hadir_mkl_4 }}</td>
                                        <td>Rp. @currency($Datas[0]->honor_mk_4)</td>
                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_matkul_4)</td>
                                    </tr>
                                @endif
                                @if ($Datas[0]->matkul_5 || $Datas[0]->nominal_matkul_5)
                                    <tr>
                                        <td>
                                            <div>
                                                {{ $Datas[0]->matkul_5 }}
                                            </div>
                                        </td>
                                        <td>{{ $Datas[0]->sks_matkul_5 }}</td>
                                        <td>{{ $Datas[0]->jml_hadir_mkl_5 }}</td>
                                        <td>Rp. @currency($Datas[0]->honor_mk_5)</td>
                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_matkul_5)</td>
                                    </tr>
                                @endif
                                @if ($Datas[0]->matkul_6 || $Datas[0]->nominal_matkul_6)
                                    <tr>
                                        <td>
                                            <div>
                                                {{ $Datas[0]->matkul_6 }}
                                            </div>
                                        </td>
                                        <td>{{ $Datas[0]->sks_matkul_6 }}</td>
                                        <td>{{ $Datas[0]->jml_hadir_mkl_6 }}</td>
                                        <td>Rp. @currency($Datas[0]->honor_mk_6)</td>
                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_matkul_6)</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered">
                            <tbody>
                                <tr>
                                    <td>
                                        <div>
                                            <b>Jumlah</b>
                                        </div>
                                    </td>
                                    <td style="text-align: end;"><b> + Rp. @currency($Datas[0]->jumlah)</b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <b>Potongan Pph 21</b>
                                        </div>
                                    </td>
                                    <td style="text-align: end;"><b> - Rp. @currency($Datas[0]->pph_21)</b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <b>Honor Yang dibayar</b>
                                        </div>
                                    </td>
                                    <td style="text-align: end;"><u><b>Rp. @currency($Datas[0]->honor_yang_dibayar)</b></u></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- info row -->
                <div class="row">
                    <div class="col-sm-12 invoice-col mt-5">
                        <address style="float: inline-end;" class="mr-5">
                            <p>Denpasar, {{ date('d F Y', strtotime($Datas[0]->created_at)) }}</strong><br>
                            <img alt="Logo" class="" src="assets/media/logos/ttd.png" width="160px" />
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
    </body>
</html>
