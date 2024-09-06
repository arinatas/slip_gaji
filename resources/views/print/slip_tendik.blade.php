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
                        <h2>SLIP GAJI KARYAWAN</h2>
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
                                    <td>Jabatan</td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td>: &nbsp;&nbsp;&nbsp;{{ $Datas[0]->jabatan }}</td>
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
                                            Gaji Pokok
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->gaji_pokok)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Tunjangan Jabatan
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->tunjangan_jabatan)</td>
                                </tr>
                                <!-- <tr>
                                    <td>
                                        <div>
                                            Bonus
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->bonus)</td>
                                </tr> -->
                                <tr>
                                    <td>
                                        <div>
                                            Tunjangan Kehadiran
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->tunjangan_kehadiran)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Tunjangan lembur
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->tunjangan_lembur)</td>
                                </tr>
                                <!-- <tr>
                                    <td>
                                        <div>
                                            Tunj. Pel. Mhs/Op. Feeder
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->tunj_pel_mhs_op_feeder)</td>
                                </tr> -->
                                <tr>
                                    <td>
                                        <div>
                                            Tunjangan Kinerja
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->tunjangan_kinerja)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <b>Jumlah</b>
                                        </div>
                                    </td>
                                    <td style="text-align: end;"><b> + Rp. @currency($Datas[0]->jumlah_penambah)</b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Potongan Kasbon
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->potongan_kasbon)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Denda Keterlambatan
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->denda_keterlambatan)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Potongan Pph 21
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->potongan_pph_21)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Potongan Absensi
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->potongan_absensi)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Potongan BPJS
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->potongan_bpjs)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <b>Jumlah</b>
                                        </div>
                                    </td>
                                    <td style="text-align: end;"><b> - Rp. @currency($Datas[0]->jumlah_pengurang)</b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <b>Gaji yang dibayar</b>
                                        </div>
                                    </td>
                                    <td style="text-align: end;"><u><b> Rp. @currency($Datas[0]->gaji_yang_dibayar)</b></u></td>
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
