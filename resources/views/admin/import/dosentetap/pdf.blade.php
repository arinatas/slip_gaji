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
                    <div style="padding-bottom: 35px;">
                        <table>
                            <tr>
                                <td style="text-align: left;">
                                <div >
                                    <img alt="Logo" class="" src="assets/media/logos/univ.png" width="150px" />
                                </div>
                                </td>
                                <td style="text-align: center;"> 
                                <div style="padding-left: 40px;">
                                    <h4>SLIP GAJI DOSEN</h4>
                                    <h3>PRIMAKARA UNIVERSITY</h3>
                                    <h6 style="text-transform: uppercase;">PERIODE {{ ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$item->bulan - 1] }} {{ $item->tahun }}</h6>
                                </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                <!-- Table row -->
                    <div class="col-12 table-responsive">
                        <table style="padding-bottom: 5px;">
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
                                            Gaji Pokok
                                        </div>
                                    </td>
                                    <td style="text-align: right;">Rp. @currency( $item->gaji_pokok )</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            Tujangan Kehadiran
                                        </div>
                                    </td>
                                    <td style="text-align: right;">Rp. @currency( $item->tunjangan_kehadiran )</td>
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
                                    <th>Deskripsi</th>
                                    <th>Qty</th>
                                    <th></th>
                                    <th>Nominal</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Honor Mengajar (Pagi)</td>
                                    <td style="text-align: center;">@currency( $item->x_honor_mengajar_kls_pagi )</td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center;">@currency( $item->honor_mengajar_kls_pagi )</td>
                                    <td style="text-align: right;">@currency( $item->nominal_mengajar_kls_pagi )</td>
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
                                        <b>Jumlah Pengurang</b>
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
    
                    <div class="row">
                        <div class="col-sm-12 invoice-col mt-3">
                            <address style="text-align: right; padding-right: 10px;"> <!-- Atur text-align ke center -->
                                <p style="font-size: 12px;">Denpasar, 28 {{ ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$item->bulan - 1] }} {{ $item->tahun }}</p><br>
                                <img alt="Logo" class="" src="assets/media/logos/ttd.png" width="160px" style="margin-top: -35px;" />
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
