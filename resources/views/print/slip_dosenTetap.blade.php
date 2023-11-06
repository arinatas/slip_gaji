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
                        <h2>SLIP GAJI DOSEN</h2>
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
                                            Gaji Pokok
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->gaji_pokok)</td>
                                </tr>
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
                                            Tunj. Jbt.Struktural
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->tunjangan_jabatan_struktural)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Tunj. Jbt. Fungsional
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->tunjangan_jabatan_fungsional)</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered">
                            <tbody>
                                <tr>
                                    <td>
                                        <div>
                                            Honor Mengajar (Pagi)
                                        </div>
                                    </td>
                                    <td>{{ $Datas[0]->x_honor_mengajar_kls_pagi }}</td>
                                    <td>X</td>
                                    <td>Rp. @currency($Datas[0]->nominal_honor_mengajar_kls_pagi)</td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->honor_mengajar_kls_pagi)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Honor Mengajar (Malam)
                                        </div>
                                    </td>
                                    <td>{{ $Datas[0]->x_honor_mengajar_kls_malam }}</td>
                                    <td>X</td>
                                    <td>Rp. @currency($Datas[0]->nominal_honor_mengajar_kls_malam)</td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->honor_mengajar_kls_malam)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Pmb./Penguji Kerja Praktek
                                        </div>
                                    </td>
                                    <td>{{ $Datas[0]->x_pmb_atau_penguji_kp }}</td>
                                    <td>X</td>
                                    <td>Rp. @currency($Datas[0]->nominal_pmb_atau_penguji_kp)</td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->pmb_atau_penguji_kp)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Penguji Sidang Proposal
                                        </div>
                                    </td>
                                    <td>{{ $Datas[0]->x_penguji_sidang_proposal }}</td>
                                    <td>X</td>
                                    <td>Rp. @currency($Datas[0]->nominal_penguji_sidang_proposal)</td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->penguji_sidang_proposal)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Penguji Sidang Skripsi
                                        </div>
                                    </td>
                                    <td>{{ $Datas[0]->x_penguji_sidang_skripsi }}</td>
                                    <td>X</td>
                                    <td>Rp. @currency($Datas[0]->nominal_penguji_sidang_skripsi)</td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->penguji_sidang_skripsi)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Pmb. I Proposal (kls pagi)
                                        </div>
                                    </td>
                                    <td>{{ $Datas[0]->x_pmb_1_proposal_pagi }}</td>
                                    <td>X</td>
                                    <td>Rp. @currency($Datas[0]->nominal_pmb_1_proposal_pagi)</td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->pmb_1_proposal_pagi)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Pmb. I Proposal (kls malam)
                                        </div>
                                    </td>
                                    <td>{{ $Datas[0]->x_pmb_1_proposal_malam }}</td>
                                    <td>X</td>
                                    <td>Rp. @currency($Datas[0]->nominal_pmb_1_proposal_malam)</td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->pmb_1_proposal_malam)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Pmb. I Skripsi (kls pagi)
                                        </div>
                                    </td>
                                    <td>{{ $Datas[0]->x_pmb_1_skripsi_pagi }}</td>
                                    <td>X</td>
                                    <td>Rp. @currency($Datas[0]->nominal_pmb_1_skripsi_pagi)</td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->pmb_1_skripsi_pagi)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Pmb. I Skripsi (kls malam)
                                        </div>
                                    </td>
                                    <td>{{ $Datas[0]->x_pmb_1_skripsi_malam }}</td>
                                    <td>X</td>
                                    <td>Rp. @currency($Datas[0]->nominal_pmb_1_skripsi_malam)</td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->pmb_1_skripsi_malam)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Pmb. II Proposal (kls pagi)
                                        </div>
                                    </td>
                                    <td>{{ $Datas[0]->x_pmb_2_proposal_pagi }}</td>
                                    <td>X</td>
                                    <td>Rp. @currency($Datas[0]->nominal_pmb_2_proposal_pagi)</td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->pmb_2_proposal_pagi)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Pmb. II Proposal (kls malam)
                                        </div>
                                    </td>
                                    <td>{{ $Datas[0]->x_pmb_2_proposal_malam }}</td>
                                    <td>X</td>
                                    <td>Rp. @currency($Datas[0]->nominal_pmb_2_proposal_malam)</td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->pmb_2_proposal_malam)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Pmb. II Skripsi (kls pagi)
                                        </div>
                                    </td>
                                    <td>{{ $Datas[0]->x_pmb_2_skripsi_pagi }}</td>
                                    <td>X</td>
                                    <td>Rp. @currency($Datas[0]->nominal_pmb_2_skripsi_pagi)</td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->pmb_2_skripsi_pagi)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Pmb. II Skripsi (kls malam)
                                        </div>
                                    </td>
                                    <td>{{ $Datas[0]->x_pmb_2_skripsi_malam }}</td>
                                    <td>X</td>
                                    <td>Rp. @currency($Datas[0]->nominal_pmb_2_skripsi_malam)</td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->pmb_2_skripsi_malam)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Pembuatan Soal
                                        </div>
                                    </td>
                                    <td>{{ $Datas[0]->x_pembuatan_soal }}</td>
                                    <td>X</td>
                                    <td>Rp. @currency($Datas[0]->nominal_pembuatan_soal)</td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->pembuatan_soal)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Koreksi Soal
                                        </div>
                                    </td>
                                    <td>{{ $Datas[0]->x_koreksi_soal }}</td>
                                    <td>X</td>
                                    <td>Rp. @currency($Datas[0]->nominal_koreksi_soal)</td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->koreksi_soal)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Dosen Wali
                                        </div>
                                    </td>
                                    <td>{{ $Datas[0]->x_dosen_wali }}</td>
                                    <td>X</td>
                                    <td>Rp. @currency($Datas[0]->nominal_dosen_wali)</td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->dosen_wali)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Pengawas Ujian
                                        </div>
                                    </td>
                                    <td>{{ $Datas[0]->x_pengawas_ujian }}</td>
                                    <td>X</td>
                                    <td>Rp. @currency($Datas[0]->nominal_pengawas_ujian)</td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->pengawas_ujian)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Remidial
                                        </div>
                                    </td>
                                    <td>{{ $Datas[0]->x_remidial }}</td>
                                    <td>X</td>
                                    <td>Rp. @currency($Datas[0]->nominal_remidial)</td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->remidial)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Pemb. Company Visit
                                        </div>
                                    </td>
                                    <td>{{ $Datas[0]->x_pmb_company_visit }}</td>
                                    <td>X</td>
                                    <td>Rp. @currency($Datas[0]->nominal_pmb_company_visit)</td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->pmb_company_visit)</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered">
                            <tbody>
                                <tr>
                                    <td>
                                        <div>
                                            Pembina UKM
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->pembina_ukm)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Reward EKIN
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->reward_ekin)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                           <b>Jumlah Gaji, Tunjangan dan honor</b>
                                        </div>
                                    </td>
                                    <td style="text-align: end;"><b>+ Rp. @currency($Datas[0]->jumlah_gaji_tunjangan_honor)</b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Potongan Kas Bon
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency($Datas[0]->potongan_kas_bon)</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Potongan Pph 21
                                        </div>
                                    </td>
                                    <td style="text-align: end;"> Rp. @currency($Datas[0]->pph_21)</td>
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
                                    <td style="text-align: end;"><b>- Rp. @currency($Datas[0]->jumlah)</b></td>
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
