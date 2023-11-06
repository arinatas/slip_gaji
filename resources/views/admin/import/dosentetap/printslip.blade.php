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
                        <h2>SLIP GAJI DOSEN</h2>
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
                                    <td style="text-align: end;">Rp. @currency( $item->gaji_pokok )</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Tujangan Kehadiran
                                        </div>
                                    </td>
                                    <td style="text-align: end;">Rp. @currency( $item->tunjangan_kehadiran )</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Tunj. Jbt. Struktural
                                        </div>
                                    </td>
                                    <td style="text-align: right;">Rp. @currency( $item->tunjangan_jabatan_struktural )</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Tunj. Jbt. Fungsional
                                        </div>
                                    </td>
                                    <td style="text-align: right;">Rp. @currency( $item->tunjangan_jabatan_fungsional )</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="fw-semibold fs-6 text-bold">
                                    <th style="text-align: center;">Deskripsi</th>
                                    <th style="text-align: center;">Qty</th>
                                    <th style="text-align: center;"></th>
                                    <th style="text-align: center;">Nominal</th>
                                    <th style="text-align: center;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Honor Mengajar (Pagi)</td>
                                    <td style="text-align: center;">@currency( $item->x_honor_mengajar_kls_pagi )</td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center;">@currency( $item->honor_mengajar_kls_pagi )</td>
                                    <td style="text-align: right;">@currency( $item->nominal_honor_mengajar_kls_pagi )</td>
                                </tr>
                                <tr>
                                    <td>Honor Mengajar (Malam)</td>
                                    <td style="text-align: center;">@currency( $item->x_honor_mengajar_kls_malam )</td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center;">@currency( $item->honor_mengajar_kls_malam )</td>
                                    <td style="text-align: right;">@currency( $item->nominal_honor_mengajar_kls_malam )</td>
                                </tr>
                                <tr>
                                    <td>Pmb./Penguji Kerja Praktek</td>
                                    <td style="text-align: center;">@currency( $item->x_pmb_atau_penguji_kp )</td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center;">@currency( $item->pmb_atau_penguji_kp )</td>
                                    <td style="text-align: right;">@currency( $item->nominal_pmb_atau_penguji_kp )</td>
                                </tr>
                                <tr>
                                    <td>Pmb. I Proposal (kls pagi)</td>
                                    <td style="text-align: center;">@currency( $item->x_pmb_1_proposal_pagi )</td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center;">@currency( $item->pmb_1_proposal_pagi )</td>
                                    <td style="text-align: right;">@currency( $item->nominal_pmb_1_proposal_pagi )</td>
                                </tr>
                                <tr>
                                    <td>Pmb. I Proposal (kls malam)</td>
                                    <td style="text-align: center;">@currency( $item->x_pmb_1_proposal_malam )</td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center;">@currency( $item->pmb_1_proposal_malam )</td>
                                    <td style="text-align: right;">@currency( $item->nominal_pmb_1_proposal_malam )</td>
                                </tr>
                                <tr>
                                    <td>Pmb. I Skripsi (kls pagi)</td>
                                    <td style="text-align: center;">@currency( $item->x_pmb_1_skripsi_pagi )</td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center;">@currency( $item->pmb_1_skripsi_pagi )</td>
                                    <td style="text-align: right;">@currency( $item->nominal_pmb_1_skripsi_pagi )</td>
                                </tr>
                                <tr>
                                    <td>Pmb. I Skripsi (kls malam)</td>
                                    <td style="text-align: center;">@currency( $item->x_pmb_1_skripsi_malam )</td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center;">@currency( $item->pmb_1_skripsi_malam )</td>
                                    <td style="text-align: right;">@currency( $item->nominal_pmb_1_skripsi_malam )</td>
                                </tr>
                                <tr>
                                    <td>Pmb. II Proposal (kls pagi)</td>
                                    <td style="text-align: center;">@currency( $item->x_pmb_2_proposal_pagi )</td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center;">@currency( $item->pmb_2_proposal_pagi )</td>
                                    <td style="text-align: right;">@currency( $item->nominal_pmb_2_proposal_pagi )</td>
                                </tr>
                                <tr>
                                    <td>Pmb. II Proposal (kls malam)</td>
                                    <td style="text-align: center;">@currency( $item->x_pmb_2_proposal_malam )</td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center;">@currency( $item->pmb_2_proposal_malam )</td>
                                    <td style="text-align: right;">@currency( $item->nominal_pmb_2_proposal_malam )</td>
                                </tr>
                                <tr>
                                    <td>Pmb. II Skripsi (kls pagi)</td>
                                    <td style="text-align: center;">@currency( $item->x_pmb_2_skripsi_pagi )</td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center;">@currency( $item->pmb_2_skripsi_pagi )</td>
                                    <td style="text-align: right;">@currency( $item->nominal_pmb_2_skripsi_pagi )</td>
                                </tr>
                                <tr>
                                    <td>Pmb. II Skripsi (kls malam)</td>
                                    <td style="text-align: center;">@currency( $item->x_pmb_2_skripsi_malam )</td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center;">@currency( $item->pmb_2_skripsi_malam )</td>
                                    <td style="text-align: right;">@currency( $item->nominal_pmb_2_skripsi_malam )</td>
                                </tr>
                                <tr>
                                    <td>Penguji Sidang Proposal</td>
                                    <td style="text-align: center;">@currency( $item->x_penguji_sidang_proposal )</td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center;">@currency( $item->penguji_sidang_proposal )</td>
                                    <td style="text-align: right;">@currency( $item->nominal_penguji_sidang_proposal )</td>
                                </tr>
                                <tr>
                                    <td>Penguji Sidang Skripsi</td>
                                    <td style="text-align: center;">@currency( $item->x_penguji_sidang_skripsi )</td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center;">@currency( $item->penguji_sidang_skripsi )</td>
                                    <td style="text-align: right;">@currency( $item->nominal_penguji_sidang_skripsi )</td>
                                </tr>
                                <tr>
                                    <td>Pembuatan Soal</td>
                                    <td style="text-align: center;">@currency( $item->x_pembuatan_soal )</td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center;">@currency( $item->pembuatan_soal )</td>
                                    <td style="text-align: right;">@currency( $item->nominal_pembuatan_soal )</td>
                                </tr>
                                <tr>
                                    <td>Koreksi Soal</td>
                                    <td style="text-align: center;">@currency( $item->x_koreksi_soal )</td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center;">@currency( $item->koreksi_soal )</td>
                                    <td style="text-align: right;">@currency( $item->nominal_koreksi_soal )</td>
                                </tr>
                                <tr>
                                    <td>Dosen Wali</td>
                                    <td style="text-align: center;">@currency( $item->x_dosen_wali )</td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center;">@currency( $item->dosen_wali )</td>
                                    <td style="text-align: right;">@currency( $item->nominal_dosen_wali )</td>
                                </tr>
                                <tr>
                                    <td>Pengawas Ujian</td>
                                    <td style="text-align: center;">@currency( $item->x_pengawas_ujian )</td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center;">@currency( $item->pengawas_ujian )</td>
                                    <td style="text-align: right;">@currency( $item->nominal_pengawas_ujian )</td>
                                </tr>
                                <tr>
                                    <td>Remidial</td>
                                    <td style="text-align: center;">@currency( $item->x_remidial )</td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center;">@currency( $item->remidial )</td>
                                    <td style="text-align: right;">@currency( $item->nominal_remidial )</td>
                                </tr>
                                <tr>
                                    <td>Pemb. Company Visit</td>
                                    <td style="text-align: center;">@currency( $item->x_pmb_company_visit )</td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center;">@currency( $item->pmb_company_visit )</td>
                                    <td style="text-align: right;">@currency( $item->nominal_pmb_company_visit )</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered">
                                <tr>
                                    <td>Pembina UMKM</td>
                                    <td style="text-align: right;">Rp. @currency( $item->pembina_ukm )</b></td>
                                </tr>
                                <tr>
                                    <td>Reward EKIN</td>
                                    <td style="text-align: right;">Rp. @currency( $item->reward_ekin )</td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Jumlah Gaji, Tunjangan dan honor</b>
                                    </td>
                                    <td style="text-align: right;"><b> + Rp. @currency( $item->jumlah_gaji_tunjangan_honor )</b></td>
                                </tr>
                                <tr>
                                    <td>Potongan Kas Bon</td>
                                    <td style="text-align: right;">Rp. @currency( $item->potongan_kas_bon )</td>
                                </tr>
                                <tr>
                                    <td>Potongan Pph 21</td>
                                    <td style="text-align: right;">Rp. @currency( $item->pph_21 )</td>
                                </tr>
                                <tr>
                                    <td>Potongan Absensi</td>
                                    <td style="text-align: right;">Rp. @currency( $item->potongan_absensi )</td>
                                </tr>
                                <tr>
                                    <td>Potongan BPJS</td>
                                    <td style="text-align: right;">Rp. @currency( $item->potongan_bpjs )</td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Jumlah</b>
                                    </td>
                                    <td style="text-align: right;"><b> - Rp. @currency( $item->jumlah )</b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Gaji yang dibayar</b>
                                    </td>
                                    <td style="text-align: right;"><b>Rp. @currency( $item->gaji_yang_dibayar )</b></td>
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
