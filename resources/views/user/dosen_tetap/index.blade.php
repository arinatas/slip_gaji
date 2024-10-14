@extends('layouts.main')

@section('content')
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Toolbar-->
                        @include('partials.toolbar')
                        <!--end::Toolbar-->
						<!--begin::Post-->
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<!--begin::Container-->
							<div id="kt_content_container" class="container-xxl">
                                <!--begin::Card-->
                                <div class="card">
                                    <!--begin::Card body-->
                                    <div class="pb-5">
                                        <!--begin::Heading-->
                                        <div class="card-px pt-10 d-flex justify-content-between">
                                            <!--begin::Title-->
                                                <div>
                                                    <h1 class="d-none d-md-block">Laporan {{ $title }}</h1>
                                                </div>
                                                <div class="d-flex flex-row align-items-center justify-content-end py-1">
                                                    <!--begin::Wrapper-->
                                                    <div class="me-4">
                                                        <!--begin::Menu-->
                                                        <a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                                                        <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="black" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->Filter</a>
                                                        <!--begin::Menu 1-->
                                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_6155aca8b3fa9">
                                                            <!--begin::Header-->
                                                            <div class="px-7 py-5">
                                                                <div class="fs-5 text-dark fw-bolder">Filter {{ $title }}</div>
                                                            </div>
                                                            <!--end::Header-->
                                                            <!--begin::Menu separator-->
                                                            <div class="separator border-gray-200"></div>
                                                            <!--end::Menu separator-->
                                                            <!--begin::Form-->
                                                            <div class="px-7 py-5">
                                                                <!--begin::Form-->
                                                                <form action="{{ route('slipGajiDosenTetap') }}" method="GET">
                                                                    <!--begin::Input group-->
                                                                    <div class="mb-10">
                                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                                            <span class="required">Bulan</span>
                                                                        </label>
                                                                        <!--begin::Input-->
                                                                        <div class="me-2">
                                                                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" id="bulan" name="bulan" required>
                                                                                <option value="1">January</option>
                                                                                <option value="2">February</option>
                                                                                <option value="3">March</option>
                                                                                <option value="4">April</option>
                                                                                <option value="5">May</option>
                                                                                <option value="6">June</option>
                                                                                <option value="7">July</option>
                                                                                <option value="8">August</option>
                                                                                <option value="9">September</option>
                                                                                <option value="10">October</option>
                                                                                <option value="11">November</option>
                                                                                <option value="12">December</option>
                                                                            </select>
                                                                        </div>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                    <!--begin::Input group-->
                                                                    <div class="mb-10">
                                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                                            <span class="required">Tahun</span>
                                                                        </label>
                                                                        <!--begin::Input-->
                                                                        <div class="me-2">
                                                                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" id="tahun" name="tahun" required>
                                                                                <option value="<?= $previousYear ?>"><?= $previousYear ?></option>
                                                                                <option value="<?= $nowYear ?>"><?= $nowYear ?></option>
                                                                                <option value="<?= $nextYear ?>"><?= $nextYear ?></option>
                                                                            </select>
                                                                        </div>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                    <!--begin::Actions-->
                                                                    <div class="d-flex justify-content-end">
                                                                        <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                                                        <button type="submit" class="btn btn-sm btn-primary">Apply</button>
                                                                    </div>
                                                                    <!--end::Actions-->
                                                                    <input type="text" hidden name="email" value="{{ auth()->user()->email }}">
                                                                </form>
                                                                <!--end::Form-->
                                                            </div>
                                                            <!--end::Form-->
                                                        </div>
                                                        <!--end::Menu 1-->
                                                        <!--end::Menu-->
                                                    </div>
                                                    <!--end::Wrapper-->
                                                    <!--begin::Button-->
                                                    @if(session('bulan') && session('tahun'))
                                                        <a href="{{ url('printSlipGajiDosenTetap') }}" target="blank" class="btn btn-sm btn-warning">
                                                            <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Devices/Printer.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <path d="M16,17 L16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 L8,17 L5,17 C3.8954305,17 3,16.1045695 3,15 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,15 C21,16.1045695 20.1045695,17 19,17 L16,17 Z M17.5,11 C18.3284271,11 19,10.3284271 19,9.5 C19,8.67157288 18.3284271,8 17.5,8 C16.6715729,8 16,8.67157288 16,9.5 C16,10.3284271 16.6715729,11 17.5,11 Z M10,14 L10,20 L14,20 L14,14 L10,14 Z" fill="#000000"/>
                                                                    <rect fill="#000000" opacity="0.3" x="8" y="2" width="8" height="2" rx="1"/>
                                                                </g>
                                                            </svg><!--end::Svg Icon--></span>
                                                            Print</a>
                                                    @endif
                                                    <!--end::Button-->
                                                </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Table-->
                                        @if ($filterUsed)
                                            @if ($Datas)
                                            <div class="card-body pb-0">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <!--begin::Accordion-->
                                                        <div class="accordion mb-2" id="kt_accordion_1">
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="kt_accordion_1_header_1">
                                                                    <button class="accordion-button bg-success text-white fs-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_1" aria-expanded="true" aria-controls="kt_accordion_1_body_1">
                                                                        @if ($Datas[0]->bulan === 1)
                                                                            January
                                                                        @endif
                                                                        @if ($Datas[0]->bulan === 2)
                                                                            February
                                                                        @endif
                                                                        @if ($Datas[0]->bulan === 3)
                                                                            March
                                                                        @endif
                                                                        @if ($Datas[0]->bulan === 4)
                                                                            April
                                                                        @endif
                                                                        @if ($Datas[0]->bulan === 5)
                                                                            May
                                                                        @endif
                                                                        @if ($Datas[0]->bulan === 6)
                                                                            June
                                                                        @endif
                                                                        @if ($Datas[0]->bulan === 7)
                                                                            July
                                                                        @endif
                                                                        @if ($Datas[0]->bulan === 8)
                                                                            August
                                                                        @endif
                                                                        @if ($Datas[0]->bulan === 9)
                                                                            September
                                                                        @endif
                                                                        @if ($Datas[0]->bulan === 10)
                                                                            October
                                                                        @endif
                                                                        @if ($Datas[0]->bulan === 11)
                                                                            November
                                                                        @endif
                                                                        @if ($Datas[0]->bulan === 12)
                                                                            December
                                                                        @endif
                                                                        |
                                                                        {{ $Datas[0]->tahun }}
                                                                    </button>
                                                                </h2>
                                                                <div id="kt_accordion_1_body_1" class="accordion-collapse collapse show" aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                                                                    <div class="accordion-body">
                                                                        <!--begin::table-->
                                                                        <div class="table-responsive">
                                                                            <table id="kt_datatable_jurnal" class="table table-row-bordered gy-5">
                                                                                <h1 style="text-align: center"><b>{{ auth()->user()->name }} | {{ $Datas[0]->jabatan_fungsional }} : {{ $Datas[0]->jabatan_struktural }}</b></h1>
                                                                                <thead>
                                                                                    <tr class="fw-semibold fs-6 text-muted">
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
                                                                        </div>
                                                                        <!--end::table-->
                                                                        <!--begin::table-->
                                                                        <div class="table-responsive">
                                                                            <table class="table table-row-bordered gy-5">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Honor Mengajar (Pagi)
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ $Datas[0]->x_honor_mengajar_kls_pagi }}</td>
                                                                                        <td>X</td>
                                                                                        <td>Rp. @currency($Datas[0]->honor_mengajar_kls_pagi)</td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_honor_mengajar_kls_pagi)</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Honor Mengajar (Malam)
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ $Datas[0]->x_honor_mengajar_kls_malam }}</td>
                                                                                        <td>X</td>
                                                                                        <td>Rp. @currency($Datas[0]->honor_mengajar_kls_malam)</td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_honor_mengajar_kls_malam)</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Koordinator Matakuliah
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ $Datas[0]->x_koordinator_matkul }}</td>
                                                                                        <td>X</td>
                                                                                        <td>Rp. @currency($Datas[0]->koordinator_matkul)</td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_koordinator_matkul)</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Koordinator / Anggota Skema MBKM
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ $Datas[0]->x_koor_anggota_mbkm }}</td>
                                                                                        <td>X</td>
                                                                                        <td>Rp. @currency($Datas[0]->koor_anggota_mbkm)</td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_koor_anggota_mbkm)</td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Pembimbing MBKM
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ $Datas[0]->x_pmb_atau_penguji_mbkm }}</td>
                                                                                        <td>X</td>
                                                                                        <td>Rp. @currency($Datas[0]->pmb_atau_penguji_mbkm)</td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_pmb_atau_penguji_mbkm)</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Penguji Sidang Proposal
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ $Datas[0]->x_penguji_sidang_proposal }}</td>
                                                                                        <td>X</td>
                                                                                        <td>Rp. @currency($Datas[0]->penguji_sidang_proposal)</td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_penguji_sidang_proposal)</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Penguji Sidang Skripsi
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ $Datas[0]->x_penguji_sidang_skripsi }}</td>
                                                                                        <td>X</td>
                                                                                        <td>Rp. @currency($Datas[0]->penguji_sidang_skripsi)</td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_penguji_sidang_skripsi)</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Pmb. I Proposal (kls pagi)
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ $Datas[0]->x_pmb_1_proposal_pagi }}</td>
                                                                                        <td>X</td>
                                                                                        <td>Rp. @currency($Datas[0]->pmb_1_proposal_pagi)</td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_pmb_1_proposal_pagi)</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Pmb. I Proposal (kls malam)
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ $Datas[0]->x_pmb_1_proposal_malam }}</td>
                                                                                        <td>X</td>
                                                                                        <td>Rp. @currency($Datas[0]->pmb_1_proposal_malam)</td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_pmb_1_proposal_malam)</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Pmb. I Skripsi (kls pagi)
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ $Datas[0]->x_pmb_1_skripsi_pagi }}</td>
                                                                                        <td>X</td>
                                                                                        <td>Rp. @currency($Datas[0]->pmb_1_skripsi_pagi)</td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_pmb_1_skripsi_pagi)</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Pmb. I Skripsi (kls malam)
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ $Datas[0]->x_pmb_1_skripsi_malam }}</td>
                                                                                        <td>X</td>
                                                                                        <td>Rp. @currency($Datas[0]->pmb_1_skripsi_malam)</td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_pmb_1_skripsi_malam)</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Pmb. II Proposal (kls pagi)
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ $Datas[0]->x_pmb_2_proposal_pagi }}</td>
                                                                                        <td>X</td>
                                                                                        <td>Rp. @currency($Datas[0]->pmb_2_proposal_pagi)</td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_pmb_2_proposal_pagi)</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Pmb. II Proposal (kls malam)
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ $Datas[0]->x_pmb_2_proposal_malam }}</td>
                                                                                        <td>X</td>
                                                                                        <td>Rp. @currency($Datas[0]->pmb_2_proposal_malam)</td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_pmb_2_proposal_malam)</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Pmb. II Skripsi (kls pagi)
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ $Datas[0]->x_pmb_2_skripsi_pagi }}</td>
                                                                                        <td>X</td>
                                                                                        <td>Rp. @currency($Datas[0]->pmb_2_skripsi_pagi)</td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_pmb_2_skripsi_pagi)</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Pmb. II Skripsi (kls malam)
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ $Datas[0]->x_pmb_2_skripsi_malam }}</td>
                                                                                        <td>X</td>
                                                                                        <td>Rp. @currency($Datas[0]->pmb_2_skripsi_malam)</td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_pmb_2_skripsi_malam)</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Pembuatan Soal
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ $Datas[0]->x_pembuatan_soal }}</td>
                                                                                        <td>X</td>
                                                                                        <td>Rp. @currency($Datas[0]->pembuatan_soal)</td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_pembuatan_soal)</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Koreksi Soal
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ $Datas[0]->x_koreksi_soal }}</td>
                                                                                        <td>X</td>
                                                                                        <td>Rp. @currency($Datas[0]->koreksi_soal)</td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_koreksi_soal)</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Dosen Wali
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ $Datas[0]->x_dosen_wali }}</td>
                                                                                        <td>X</td>
                                                                                        <td>Rp. @currency($Datas[0]->dosen_wali)</td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_dosen_wali)</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Pengawas Ujian
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ $Datas[0]->x_pengawas_ujian }}</td>
                                                                                        <td>X</td>
                                                                                        <td>Rp. @currency($Datas[0]->pengawas_ujian)</td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_pengawas_ujian)</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Remidial
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ $Datas[0]->x_remidial }}</td>
                                                                                        <td>X</td>
                                                                                        <td>Rp. @currency($Datas[0]->remidial)</td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_remidial)</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Pemb. Company Visit
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ $Datas[0]->x_pmb_company_visit }}</td>
                                                                                        <td>X</td>
                                                                                        <td>Rp. @currency($Datas[0]->pmb_company_visit)</td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->nominal_pmb_company_visit)</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <!--end::table-->
                                                                        <!--begin::table-->
                                                                        <div class="table-responsive">
                                                                            <table class="table table-row-bordered gy-5">
                                                                                <tbody>
                                                                                    <!-- <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Pembina UKM
                                                                                            </div>
                                                                                        </td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->pembina_ukm)</td>
                                                                                    </tr> -->
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
                                                                                                Punishment EKIN
                                                                                            </div>
                                                                                        </td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->punishment_ekin)</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Potongan Pph 21
                                                                                            </div>
                                                                                        </td>
                                                                                        <td style="text-align: end;"> Rp. @currency($Datas[0]->pph_21)</td>
                                                                                    </tr>
                                                                                    <!-- <tr>
                                                                                        <td>
                                                                                            <div>
                                                                                                Potongan Absensi
                                                                                            </div>
                                                                                        </td>
                                                                                        <td style="text-align: end;">Rp. @currency($Datas[0]->potongan_absensi)</td>
                                                                                    </tr> -->
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
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <!--end::table-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end::Accordion-->
                                                        <!--begin::Alert-->
                                                        <div class="alert alert-success mt-3">
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex flex-column">
                                                                <!--begin::Title-->
                                                                <h3 class="my-1 text-dark text-center">Gaji Yang dibayar
                                                                    <br>Rp. @currency($Datas[0]->gaji_yang_dibayar)</h3>
                                                                <!--end::Title-->
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </div>
                                                        <!--end::Alert-->
                                                    </div>
                                                </div>
                                            </div>

                                            @else
                                            <div class="my-10 mx-15">
                                                <!--begin::Notice-->
                                                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                                                    <!--begin::Icon-->
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                                    <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="black" />
                                                            <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                    <!--end::Icon-->
                                                    <!--begin::Wrapper-->
                                                    <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                                        <!--begin::Content-->
                                                        <div class="mb-3 mb-md-0 fw-bold">
                                                            <h4 class="text-gray-900 fw-bolder">Belum ada data</h4>
                                                            <div class="fs-6 text-gray-700 pe-7">Belum ada data yang diinputkan</div>
                                                        </div>
                                                        <!--end::Content-->
                                                    </div>
                                                    <!--end::Wrapper-->
                                                </div>
                                                <!--end::Notice-->
                                            </div>
                                            @endif
                                        <!--end::Table-->
                                        @else
                                        <div class="my-10 mx-15">
                                            <!--begin::Notice-->
                                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                                                <!--begin::Icon-->
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                                <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="black" />
                                                        <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <!--end::Icon-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                                    <!--begin::Content-->
                                                    <div class="mb-3 mb-md-0 fw-bold">
                                                        <h4 class="text-gray-900 fw-bolder">Belum ada data</h4>
                                                        <div class="fs-6 text-gray-700 pe-7">Silahkan Filter data terlebih dahulu</div>
                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Notice-->
                                        </div>
                                        @endif
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Post-->
					</div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            // Mendapatkan bulan dan tahun saat ini dari PHP
                            const nowMonth = <?= $nowMonth ?>;
                            const nowYear = <?= $nowYear ?>;

                            // Mengatur nilai default untuk bulan dan tahun
                            document.getElementById('bulan').value = nowMonth;
                            document.getElementById('tahun').value = nowYear;
                        });
                    </script>
@endsection
