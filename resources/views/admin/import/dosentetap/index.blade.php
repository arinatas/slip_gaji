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
                                    <div class="card-body pb-5">
                                        <!--begin::Heading-->
                                        <div class="card-px pt-10 d-flex justify-content-between">
                                            <!--begin::Title-->
                                                <div class="d-inline mt-2">
                                                    <h2 class="fs-2x fw-bolder mb-0">Slip {{ $title }}</h2>
                                                </div>
                                                <div class="d-inline">
                                                    <a href="#" class="btn btn-sm btn-primary fs-6" data-bs-toggle="modal" data-bs-target="#kt_modal_new_dosentetap" title="Tambah Data Slip Gaji per Pegawai">Tambah</a>
                                                    <a href="{{ route('excel.dosen.tetap') }}" class="btn btn-sm btn-secondary">Download Contoh Excel</a>

                                                </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Heading-->

                                        <!--begin::Table-->
                                        @if ($dosenTetaps )
                                        <div class="table-responsive my-10 mx-8">
                                             <!--begin::Import Form-->
                                            <div class="mt-5">
                                                <h3 class="fs-4 fw-bolder mb-4">Import Data Excel</h3>
                                                <form action="{{ route('import.dosentetap') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="excel_file" class="form-label">Pilih File Excel:</label>
                                                        <input type="file" class="form-control" name="excel_file" id="excel_file" accept=".xls, .xlsx">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Import Data</button>
                                                </form>
                                                @if (session('importSuccess'))
                                                    <div class="alert alert-success mt-4">
                                                        {{ session('importSuccess') }}
                                                    </div>
                                                @endif
                                                @if (session('importError'))
                                                    <div class="alert alert-danger mt-4">
                                                        {{ session('importError') }}
                                                    </div>
                                                @endif
                                                @if (session('importErrors'))
                                                    <div class="alert alert-danger mt-4">
                                                        <ul>
                                                            @foreach(session('importErrors') as $errorMessage)
                                                                <li>{{ $errorMessage }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                @if (session('importValidationFailures'))
                                                    <div class="alert alert-danger mt-4">
                                                        <p>Detail Kesalahan:</p>
                                                        <ul>
                                                            @foreach(session('importValidationFailures') as $failure)
                                                                <li>Baris: {{ $failure->row() }}, Kolom: {{ $failure->attribute() }}, Pesan: {{ implode(', ', $failure->errors()) }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                            <!--End::Import Form-->
                                            <!-- Filter Form -->
                                            <div class="mt-10">
                                                <form action="{{ route('dosentetap') }}" method="GET">
                                                    <div class="row mb-3">
                                                        <div class="col-md-3">
                                                            <label for="bulan" class="form-label">Bulan:</label>
                                                            <select class="form-control" name="bulan" id="bulan">
                                                                <option value="" @if(!request('bulan')) selected @endif>-- Silahkan Memilih Bulan --</option>
                                                                @php
                                                                $bulanIndonesia = [
                                                                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                                                ];
                                                                @endphp
                                                                @for ($i = 1; $i <= 12; $i++)
                                                                    <option value="{{ $i }}" @if(request('bulan') == $i) selected @endif>{{ $bulanIndonesia[$i - 1] }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="tahun" class="form-label">Tahun:</label>
                                                            <select class="form-control" name="tahun" id="tahun">
                                                                <option value="" @if(!request('tahun')) selected @endif>-- Silahkan Memilih Tahun --</option>
                                                                @foreach ($distinctYears as $year)
                                                                    <option value="{{ $year }}" @if(request('tahun') == $year) selected @endif>{{ $year }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3 mt-4">
                                                            <button type="submit" class="btn btn-primary mt-4">Filter</button>
                                                            <!-- Tombol Export PDF -->
                                                            @if (request('bulan') && request('tahun'))
                                                                <a href="{{ route('export.pdf.dosentetap', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}" class="btn btn-danger mt-4" title="Unduh Slip Gaji Semua">Export Slip Gaji</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            @if (!request('bulan') || !request('tahun'))
                                            <div class="alert alert-warning mt-4">
                                                Silahkan filter terlebih dahulu berdasarkan bulan dan tahun.
                                            </div>
                                            @endif
                                            <!-- End Filter Form -->
                                            <!--end::Import Form-->
                                            <table class="table table-striped gy-7 gs-7">
                                                <thead>
                                                    <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                                        <th class="min-w-300px">Action</th>
                                                        <th class="min-w-50px">No</th>
                                                        <th class="min-w-100px">Email</th>
                                                        <th class="min-w-200px">Nama</th>
                                                        <th class="min-w-100px">Bulan</th>
                                                        <th class="min-w-100px">Tahun</th>
                                                        <th class="min-w-100px">Jabatan Struktural</th>
                                                        <th class="min-w-100px">Jabatan Fungsional</th>
                                                        <th class="min-w-100px">Gaji Pokok</th>
                                                        <th class="min-w-100px">Tunjangan Kehadiran</th>
                                                        <th class="min-w-100px">Tunj. Jbt.Struktural</th>
                                                        <th class="min-w-100px">Tunj. Jbt. Fungsional</th>
                                                        <th class="min-w-100px">Honor Mengajar Kelas Pagi</th>
                                                        <th class="min-w-100px">Pengali</th>
                                                        <th class="min-w-100px">Total Honor Mengajar Kelas Pagi</th>
                                                        <th class="min-w-100px">Honor Mengajar Kelas Malam</th>
                                                        <th class="min-w-100px">Pengali</th>
                                                        <th class="min-w-100px">Total Honor Mengajar Kelas Malam</th>
                                                        <th class="min-w-100px">Koordinator Matkul</th>
                                                        <th class="min-w-100px">Pengali</th>
                                                        <th class="min-w-100px">Total Koordinator Matkul</th>
                                                        <th class="min-w-100px">Koordinator / Anggota MBKM</th>
                                                        <th class="min-w-100px">Pengali</th>
                                                        <th class="min-w-100px">Total Koordinator / Anggota MBKM</th>
                                                        <th class="min-w-100px">Pmb./Penguji MBKM</th>
                                                        <th class="min-w-100px">Pengali</th>
                                                        <th class="min-w-100px">Total Pmb./Penguji MBKM</th>
                                                        <th class="min-w-100px">Pmb. I Proposal (kls pagi)</th>
                                                        <th class="min-w-100px">Pengali</th>
                                                        <th class="min-w-100px">Total Pmb. I Proposal (kls pagi)</th>
                                                        <th class="min-w-100px">Pmb. I Proposal (kls malam)</th>
                                                        <th class="min-w-100px">Pengali</th>
                                                        <th class="min-w-100px">Total Pmb. I Proposal (kls malam)</th>
                                                        <th class="min-w-100px">Pmb. I Skripsi (kls pagi)</th>
                                                        <th class="min-w-100px">Pengali</th>
                                                        <th class="min-w-100px">Total Pmb. I Skripsi (kls pagi)</th>
                                                        <th class="min-w-100px">Pmb. I Skripsi (kls malam)</th>
                                                        <th class="min-w-100px">Pengali</th>
                                                        <th class="min-w-100px">Total Pmb. I Skripsi (kls malam)</th>
                                                        <th class="min-w-100px">Pmb. II Proposal (kls pagi)</th>
                                                        <th class="min-w-100px">Pengali</th>
                                                        <th class="min-w-100px">Total Pmb. II Proposal (kls pagi)</th>
                                                        <th class="min-w-100px">Pmb. II Proposal (kls malam)</th>
                                                        <th class="min-w-100px">Pengali</th>
                                                        <th class="min-w-100px">Total Pmb. II Proposal (kls malam)</th>
                                                        <th class="min-w-100px">Pmb. II Skripsi (kls pagi)</th>
                                                        <th class="min-w-100px">Pengali</th>
                                                        <th class="min-w-100px">Total Pmb. II Skripsi (kls pagi)</th>
                                                        <th class="min-w-100px">Pmb. II Skripsi (kls malam)</th>
                                                        <th class="min-w-100px">Pengali</th>
                                                        <th class="min-w-100px">Total Pmb. II Skripsi (kls malam)</th>
                                                        <th class="min-w-100px">Penguji Sidang Proposal</th>
                                                        <th class="min-w-100px">Pengali</th>
                                                        <th class="min-w-100px">Total Penguji Sidang Proposal</th>
                                                        <th class="min-w-100px">Penguji Sidang Skripsi</th>
                                                        <th class="min-w-100px">Pengali</th>
                                                        <th class="min-w-100px">Total Penguji Sidang Skripsi</th>
                                                        <th class="min-w-100px">Koreksi Soal</th>
                                                        <th class="min-w-100px">Pengali</th>
                                                        <th class="min-w-100px">Total Koreksi Soal</th>
                                                        <th class="min-w-100px">Pembuatan Soal</th>
                                                        <th class="min-w-100px">Pengali</th>
                                                        <th class="min-w-100px">Total Pembuatan Soal</th>
                                                        <th class="min-w-100px">Dosen Wali</th>
                                                        <th class="min-w-100px">Pengali</th>
                                                        <th class="min-w-100px">Total Dosen Wali</th>
                                                        <th class="min-w-100px">Pengawas Ujian</th>
                                                        <th class="min-w-100px">Pengali</th>
                                                        <th class="min-w-100px">Total Pengawas Ujian</th>
                                                        <th class="min-w-100px">Remidial</th>
                                                        <th class="min-w-100px">Pengali</th>
                                                        <th class="min-w-100px">Total Remidial</th>
                                                        <th class="min-w-200px">Pemb. Company Visit</th>
                                                        <th class="min-w-100px">Pengali</th>
                                                        <th class="min-w-100px">Total Pemb. Company Visit</th>
                                                        <!-- <th class="min-w-100px">Pembina UKM</th> -->
                                                        <th class="min-w-100px">Reward EKIN</th>
                                                        <th class="min-w-100px">Jumlah Gaji, Tunjangan dan honor</th>
                                                        <th class="min-w-100px">Potongan Kas Bon</th>
                                                        <th class="min-w-100px">Pph 21</th>
                                                        <!-- <th class="min-w-100px">Potongan Absensi</th> -->
                                                        <th class="min-w-100px">Potongan BPJS</th>
                                                        <th class="min-w-100px">Jumlah</th>
                                                        <th class="min-w-100px">Gaji Yang dibayar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no = 1; // Inisialisasi no
                                                    @endphp
                                                    @foreach ($dosenTetaps as $item)
                                                    <tr>
                                                        <td>
                                                        <a href="#" class="btn btn-sm btn-info btn-action" title="Detail Slip Gaji" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}"><i class="fas fa-eye"></i></a>
                                                            {{-- modal here --}}
                                                            <!--begin::Modal - New Card-->
                                                            <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                                                <!--begin::Modal dialog-->
                                                                <div class="modal-dialog modal-dialog-centered mw-850px">
                                                                    <!--begin::Modal content-->
                                                                    <div class="modal-content">
                                                                        <!--begin::Modal header-->
                                                                        <div class="modal-header">
                                                                            <!--begin::Modal title-->
                                                                            <h2>Detail Slip Gaji : {{ $item->nama }}, {{ ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$item->bulan - 1] }} {{ $item->tahun }} </h2>
                                                                            <!--end::Modal title-->
                                                                            <!--begin::Close-->
                                                                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                                                <span class="svg-icon svg-icon-1">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                                                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                                                                    </svg>
                                                                                </span>
                                                                                <!--end::Svg Icon-->
                                                                            </div>
                                                                            <!--end::Close-->
                                                                        </div>
                                                                        <!--end::Modal header-->
                                                                        <!--begin::Modal body-->
                                                                        <div class="modal-body scroll-y mx-xl-8">
                                                                            <!--begin::content modal body-->
                                                                            <div class="table-responsive my-10 mx-8">
                                                                                <table class="table table-striped gy-7 gs-7">
                                                                                <tr>
                                                                                    <th>Email</th>
                                                                                    <td>{{ $item->email }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Periode</th>
                                                                                    <td>{{ ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$item->bulan - 1] }} {{ $item->tahun }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Nama</th>
                                                                                    <td>{{ $item->nama }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Jabatan Struktural</th>
                                                                                    <td>{{ $item->jabatan_struktural }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Jabatan Fungsional</th>
                                                                                    <td>{{ $item->jabatan_fungsional }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Gaji Pokok</th>
                                                                                    <td>Rp. @currency( $item->gaji_pokok )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Tunjangan Kehadiran</th>
                                                                                    <td>Rp. @currency( $item->tunjangan_kehadiran )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Tunj. Jbt.Struktural</th>
                                                                                    <td>Rp. @currency( $item->tunjangan_jabatan_struktural )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Tunj. Jbt. Fungsional</th>
                                                                                    <td>Rp. @currency( $item->tunjangan_jabatan_fungsional )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Honor Mengajar Kelas Pagi (Rp. @currency( $item->honor_mengajar_kls_pagi )) X @currency( $item->x_honor_mengajar_kls_pagi )</th>
                                                                                    <td>Rp. @currency( $item->nominal_honor_mengajar_kls_pagi )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Honor Mengajar Kelas Malam (Rp. @currency( $item->honor_mengajar_kls_malam )) X @currency( $item->x_honor_mengajar_kls_malam )</th>
                                                                                    <td>Rp. @currency( $item->nominal_honor_mengajar_kls_malam )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Koordinator Matkul (Rp. @currency( $item->koordinator_matkul )) X @currency( $item->x_koordinator_matkul )</th>
                                                                                    <td>Rp. @currency( $item->nominal_koordinator_matkul )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Koordinator / Anggota MBKM (Rp. @currency( $item->koor_anggota_mbkm )) X @currency( $item->x_koor_anggota_mbkm )</th>
                                                                                    <td>Rp. @currency( $item->nominal_koor_anggota_mbkm )</td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <th>Pmb./Penguji MBKM (Rp. @currency( $item->pmb_atau_penguji_mbkm )) X @currency( $item->x_pmb_atau_penguji_mbkm )</th>
                                                                                    <td>Rp. @currency( $item->nominal_pmb_atau_penguji_mbkm )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Pmb. I Proposal (kls pagi) (Rp. @currency( $item->pmb_1_proposal_pagi )) X @currency( $item->x_pmb_1_proposal_pagi )</th>
                                                                                    <td>Rp. @currency( $item->nominal_pmb_1_proposal_pagi )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Pmb. I Proposal (kls malam) (Rp. @currency( $item->pmb_1_proposal_malam )) X @currency( $item->x_pmb_1_proposal_malam )</th>
                                                                                    <td>Rp. @currency( $item->nominal_pmb_1_proposal_malam )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Pmb. I Skripsi (kls pagi) (Rp. @currency( $item->pmb_1_skripsi_pagi )) X @currency( $item->x_pmb_1_skripsi_pagi )</th>
                                                                                    <td>Rp. @currency( $item->nominal_pmb_1_skripsi_pagi )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Pmb. I Skripsi (kls malam) (Rp. @currency( $item->pmb_1_skripsi_malam )) X @currency( $item->x_pmb_1_skripsi_malam )</th>
                                                                                    <td>Rp. @currency( $item->nominal_pmb_1_skripsi_malam )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Pmb. II Proposal (kls pagi) (Rp. @currency( $item->pmb_2_proposal_pagi )) X @currency( $item->x_pmb_2_proposal_pagi )</th>
                                                                                    <td>Rp. @currency( $item->nominal_pmb_2_proposal_pagi )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Pmb. II Proposal (kls malam) (Rp. @currency( $item->pmb_2_proposal_malam )) X @currency( $item->x_pmb_2_proposal_malam )</th>
                                                                                    <td>Rp. @currency( $item->nominal_pmb_2_proposal_malam )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Pmb. II Skripsi (kls pagi) (Rp. @currency( $item->pmb_2_skripsi_pagi )) X @currency( $item->x_pmb_2_skripsi_pagi )</th>
                                                                                    <td>Rp. @currency( $item->nominal_pmb_2_skripsi_pagi )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Pmb. II Skripsi (kls malam) (Rp. @currency( $item->pmb_2_skripsi_malam )) X @currency( $item->x_pmb_2_skripsi_malam )</th>
                                                                                    <td>Rp. @currency( $item->nominal_pmb_2_skripsi_malam )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Penguji Sidang Proposal (Rp. @currency( $item->penguji_sidang_proposal )) X @currency( $item->x_penguji_sidang_proposal )</th>
                                                                                    <td>Rp. @currency( $item->nominal_penguji_sidang_proposal )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Penguji Sidang Skripsi (Rp. @currency( $item->penguji_sidang_skripsi )) X @currency( $item->x_penguji_sidang_skripsi )</th>
                                                                                    <td>Rp. @currency( $item->nominal_penguji_sidang_skripsi )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Koreksi Soal (Rp. @currency( $item->koreksi_soal )) X @currency( $item->x_koreksi_soal )</th>
                                                                                    <td>Rp. @currency( $item->nominal_koreksi_soal )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Pembuatan Soal (Rp. @currency( $item->pembuatan_soal )) X @currency( $item->x_pembuatan_soal )</th>
                                                                                    <td>Rp. @currency( $item->nominal_pembuatan_soal )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Dosen Wali (Rp. @currency( $item->dosen_wali )) X @currency( $item->x_dosen_wali )</th>
                                                                                    <td>Rp. @currency( $item->nominal_dosen_wali )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Pengawas Ujian (Rp. @currency( $item->pengawas_ujian )) X @currency( $item->x_pengawas_ujian )</th>
                                                                                    <td>Rp. @currency( $item->nominal_pengawas_ujian )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Remidial (Rp. @currency( $item->remidial )) X @currency( $item->x_remidial )</th>
                                                                                    <td>Rp. @currency( $item->nominal_remidial )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Pemb. Company Visit (Rp. @currency( $item->pmb_company_visit )) X @currency( $item->x_pmb_company_visit )</th>
                                                                                    <td>Rp. @currency( $item->nominal_pmb_company_visit )</td>
                                                                                </tr>
                                                                                <!-- <tr>
                                                                                    <th>Pembina UKM</th>
                                                                                    <td>Rp. @currency( $item->pembina_ukm )</td>
                                                                                </tr> -->
                                                                                <tr>
                                                                                    <th>Reward EKIN</th>
                                                                                    <td>Rp. @currency( $item->reward_ekin )</td>
                                                                                </tr>
                                                                                <tr class="alert alert-success">
                                                                                    <th><strong style="font-size: 14px;">Jumlah Gaji, Tunjangan dan honor</strong></th>
                                                                                    <td><strong style="font-size: 14px;">+Rp. @currency( $item->jumlah_gaji_tunjangan_honor )</strong></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Potongan Kas Bon</th>
                                                                                    <td>Rp. @currency( $item->potongan_kas_bon )</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Pph 21</th>
                                                                                    <td>Rp. @currency( $item->pph_21 )</td>
                                                                                </tr>
                                                                                <!-- <tr>
                                                                                    <th>Potongan Absensi</th>
                                                                                    <td>Rp. @currency( $item->potongan_absensi )</td>
                                                                                </tr> -->
                                                                                <tr>
                                                                                    <th>Potongan BPJS</th>
                                                                                    <td>Rp. @currency( $item->potongan_bpjs )</td>
                                                                                </tr>
                                                                                <tr class="alert alert-danger">
                                                                                    <th><strong style="font-size: 14px;">Jumlah Potongan</th>
                                                                                    <td><strong style="font-size: 14px;">-Rp. @currency( $item->jumlah )</td>
                                                                                </tr>
                                                                                <tr class="alert alert-primary">
                                                                                    <th style="text-align: end;"><strong style="font-size: 16px;">Gaji Yang dibayar Rp. @currency( $item->gaji_yang_dibayar )</strong></th>
                                                                                    <td></td>
                                                                                </tr>
                                                                                </table>
                                                                            </div>
                                                                            <!--end::content modal body-->
                                                                        </div>
                                                                        <!--end::Modal body-->
                                                                    </div>
                                                                    <!--end::Modal content-->
                                                                </div>
                                                                <!--end::Modal dialog-->
                                                            </div>
                                                            <!--end::Modal - New Card-->
                                                            <a href="{{ route('edit.dosentetap', $item->id ) }}" class="btn btn-sm btn-primary btn-action" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                            <form id="form-delete" action="{{ route('destroy.dosentetap', $item->id ) }}" method="POST"
                                                            class="d-inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button id="submit-btn" type="submit" data-toggle="tooltip" data-original-title="Hapus bagian"
                                                                class="btn btn-sm btn-danger btn-action" onclick="confirmDelete(event)"
                                                                ><i class="fas fa-trash" title="Hapus Data Slip Gaji per Pegawai"></i></i></button>
                                                            </form>
                                                            <a href="{{ route('export.pdfbyid.dosentetap', $item->id) }}" class="btn btn-sm btn-warning btn-action" data-toggle="tooltip" title="Unduh Slip Gaji per Pegawai"><i class="fas fa-download"></i></a>
                                                        </td>
                                                        <td>{{ $no }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>{{ $item->nama }}</td>
                                                        <td>
                                                            {{ ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$item->bulan - 1] }}
                                                        </td>
                                                        <td>{{ $item->tahun }}</td>
                                                        <td>{{ $item->jabatan_struktural }}</td>
                                                        <td>{{ $item->jabatan_fungsional }}</td>
                                                        <td>{{ $item->gaji_pokok }}</td>
                                                        <td>{{ $item->tunjangan_kehadiran }}</td>
                                                        <td>{{ $item->tunjangan_jabatan_struktural }}</td>
                                                        <td>{{ $item->tunjangan_jabatan_fungsional }}</td>
                                                        <td>{{ $item->honor_mengajar_kls_pagi }}</td>
                                                        <td>{{ $item->x_honor_mengajar_kls_pagi }}</td>
                                                        <td>{{ $item->nominal_honor_mengajar_kls_pagi }}</td>
                                                        <td>{{ $item->honor_mengajar_kls_malam }}</td>
                                                        <td>{{ $item->x_honor_mengajar_kls_malam }}</td>
                                                        <td>{{ $item->nominal_honor_mengajar_kls_malam }}</td>
                                                        <td>{{ $item->koordinator_matkul }}</td>
                                                        <td>{{ $item->x_koordinator_matkul }}</td>
                                                        <td>{{ $item->nominal_koordinator_matkul }}</td>
                                                        <td>{{ $item->koor_anggota_mbkm }}</td>
                                                        <td>{{ $item->x_koor_anggota_mbkm }}</td>
                                                        <td>{{ $item->nominal_koor_anggota_mbkm }}</td>
                                                        <td>{{ $item->pmb_atau_penguji_mbkm }}</td>
                                                        <td>{{ $item->x_pmb_atau_penguji_mbkm }}</td>
                                                        <td>{{ $item->nominal_pmb_atau_penguji_mbkm }}</td>
                                                        <td>{{ $item->pmb_1_proposal_pagi }}</td>
                                                        <td>{{ $item->x_pmb_1_proposal_pagi }}</td>
                                                        <td>{{ $item->nominal_pmb_1_proposal_pagi }}</td>
                                                        <td>{{ $item->pmb_1_proposal_malam }}</td>
                                                        <td>{{ $item->x_pmb_1_proposal_malam }}</td>
                                                        <td>{{ $item->nominal_pmb_1_proposal_malam }}</td>
                                                        <td>{{ $item->pmb_1_skripsi_pagi }}</td>
                                                        <td>{{ $item->x_pmb_1_skripsi_pagi }}</td>
                                                        <td>{{ $item->nominal_pmb_1_skripsi_pagi }}</td>
                                                        <td>{{ $item->pmb_1_skripsi_malam }}</td>
                                                        <td>{{ $item->x_pmb_1_skripsi_malam }}</td>
                                                        <td>{{ $item->nominal_pmb_1_skripsi_malam }}</td>
                                                        <td>{{ $item->pmb_2_proposal_pagi }}</td>
                                                        <td>{{ $item->x_pmb_2_proposal_pagi }}</td>
                                                        <td>{{ $item->nominal_pmb_2_proposal_pagi }}</td>
                                                        <td>{{ $item->pmb_2_proposal_malam }}</td>
                                                        <td>{{ $item->x_pmb_2_proposal_malam }}</td>
                                                        <td>{{ $item->nominal_pmb_2_proposal_malam }}</td>
                                                        <td>{{ $item->pmb_2_skripsi_pagi }}</td>
                                                        <td>{{ $item->x_pmb_2_skripsi_pagi }}</td>
                                                        <td>{{ $item->nominal_pmb_2_skripsi_pagi }}</td>
                                                        <td>{{ $item->pmb_2_skripsi_malam }}</td>
                                                        <td>{{ $item->x_pmb_2_skripsi_malam }}</td>
                                                        <td>{{ $item->nominal_pmb_2_skripsi_malam }}</td>
                                                        <td>{{ $item->penguji_sidang_proposal }}</td>
                                                        <td>{{ $item->x_penguji_sidang_proposal }}</td>
                                                        <td>{{ $item->nominal_penguji_sidang_proposal }}</td>
                                                        <td>{{ $item->penguji_sidang_skripsi }}</td>
                                                        <td>{{ $item->x_penguji_sidang_skripsi }}</td>
                                                        <td>{{ $item->nominal_penguji_sidang_skripsi }}</td>
                                                        <td>{{ $item->koreksi_soal }}</td>
                                                        <td>{{ $item->x_koreksi_soal }}</td>
                                                        <td>{{ $item->nominal_koreksi_soal }}</td>
                                                        <td>{{ $item->pembuatan_soal }}</td>
                                                        <td>{{ $item->x_pembuatan_soal }}</td>
                                                        <td>{{ $item->nominal_pembuatan_soal }}</td>
                                                        <td>{{ $item->dosen_wali }}</td>
                                                        <td>{{ $item->x_dosen_wali }}</td>
                                                        <td>{{ $item->nominal_dosen_wali }}</td>
                                                        <td>{{ $item->pengawas_ujian }}</td>
                                                        <td>{{ $item->x_pengawas_ujian }}</td>
                                                        <td>{{ $item->nominal_pengawas_ujian }}</td>
                                                        <td>{{ $item->remidial }}</td>
                                                        <td>{{ $item->x_remidial }}</td>
                                                        <td>{{ $item->nominal_remidial }}</td>
                                                        <td>{{ $item->pmb_company_visit }}</td>
                                                        <td>{{ $item->x_pmb_company_visit }}</td>
                                                        <td>{{ $item->nominal_pmb_company_visit }}</td>
                                                        <!-- <td>{{ $item->pembina_ukm }}</td> -->
                                                        <td>{{ $item->reward_ekin }}</td>
                                                        <td>{{ $item->jumlah_gaji_tunjangan_honor }}</td>
                                                        <td>{{ $item->potongan_kas_bon }}</td>
                                                        <td>{{ $item->pph_21 }}</td>
                                                        <!-- <td>{{ $item->potongan_absensi }}</td> -->
                                                        <td>{{ $item->potongan_bpjs }}</td>
                                                        <td>{{ $item->jumlah }}</td>
                                                        <td>{{ $item->gaji_yang_dibayar }}</td>
                                                    </tr>
                                                    @php
                                                        $no++; // Tambahkan no setiap kali iterasi
                                                    @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
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
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                                <!--begin::Modal-->
                                <div class="modal fade" id="kt_modal_new_dosentetap" tabindex="-1" aria-hidden="true">
                                    <!--begin::Modal dialog-->
                                    <div class="modal-dialog modal-dialog-centered mw-650px">
                                        <!--begin::Modal content-->
                                        <div class="modal-content">
                                            <!--begin::Modal header-->
                                            <div class="modal-header">
                                                <!--begin::Modal title-->
                                                <h2>Tambah {{ $title }}</h2>
                                                <!--end::Modal title-->
                                                <!--begin::Close-->
                                                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                    <span class="svg-icon svg-icon-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Close-->
                                            </div>
                                            <!--end::Modal header-->
                                            <!--begin::Modal body-->
                                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                                <!--begin::Form-->
                                                <form action="{{ route('insert.dosentetap') }}" method="POST">
                                                    @csrf
                                                    <!--begin::Input group-->
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Email</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="email" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Nama</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nama" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Bulan</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <select class="form-select form-select-solid" name="bulan" required>
                                                            @for ($i = 1; $i <= 12; $i++)
                                                                <option value="{{ $i }}">{{ ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$i - 1] }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Tahun</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="tahun" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Jabatan Struktural</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="jabatan_struktural" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Jabatan Fungsional</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="jabatan_fungsional" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Gaji Pokok</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="gaji_pokok" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Tunjangan Kehadiran</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="tunjangan_kehadiran" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Tunj. Jbt.Struktural</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="tunjangan_jabatan_struktural" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Tunj. Jbt. Fungsional</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="tunjangan_jabatan_fungsional" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Honor Mengajar Kelas Pagi</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="honor_mengajar_kls_pagi" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="x_honor_mengajar_kls_pagi" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Total Honor Mengajar Kelas Pagi</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nominal_honor_mengajar_kls_pagi" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Honor Mengajar Kelas Malam</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="honor_mengajar_kls_malam" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="x_honor_mengajar_kls_malam" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Total Honor Mengajar Kelas Malam</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nominal_honor_mengajar_kls_malam" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Koordinator Matkul</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="koordinator_matkul" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="x_koordinator_matkul" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Total Koordinator Matkul</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nominal_koordinator_matkul" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Koordinator / Anggota MBKM</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="koor_anggota_mbkm" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="x_koor_anggota_mbkm" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Total Koordinator / Anggota MBKM</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nominal_koor_anggota_mbkm" required value=""/>
                                                    </div>


                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pmb./Penguji MBKM</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="pmb_atau_penguji_mbkm" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="x_pmb_atau_penguji_mbkm" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Total Pmb./Penguji MBKM</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nominal_pmb_atau_penguji_mbkm" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pmb. I Proposal (kls pagi)</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="pmb_1_proposal_pagi" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="x_pmb_1_proposal_pagi" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Total Pmb. I Proposal (kls pagi)</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nominal_pmb_1_proposal_pagi" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pmb. I Proposal (kls malam)</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="pmb_1_proposal_malam" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="x_pmb_1_proposal_malam" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Total Pmb. I Proposal (kls malam)</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nominal_pmb_1_proposal_malam" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pmb. I Skripsi (kls pagi)</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="pmb_1_skripsi_pagi" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="x_pmb_1_skripsi_pagi" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Total Pmb. I Skripsi (kls pagi)</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nominal_pmb_1_skripsi_pagi" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pmb. I Skripsi (kls malam)</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="pmb_1_skripsi_malam" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="x_pmb_1_skripsi_malam" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Total Pmb. I Skripsi (kls malam)</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nominal_pmb_1_skripsi_malam" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pmb. II Proposal (kls pagi)</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="pmb_2_proposal_pagi" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="x_pmb_2_proposal_pagi" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Total Pmb. II Proposal (kls pagi)</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nominal_pmb_2_proposal_pagi" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pmb. II Proposal (kls malam)</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="pmb_2_proposal_malam" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="x_pmb_2_proposal_malam" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Total Pmb. II Proposal (kls malam)</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nominal_pmb_2_proposal_malam" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pmb. II Skripsi (kls pagi)</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="pmb_2_skripsi_pagi" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="x_pmb_2_skripsi_pagi" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Total Pmb. II Skripsi (kls pagi)</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nominal_pmb_2_skripsi_pagi" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pmb. II Skripsi (kls malam)</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="pmb_2_skripsi_malam" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="x_pmb_2_skripsi_malam" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Total Pmb. II Skripsi (kls malam)</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nominal_pmb_2_skripsi_malam" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Penguji Sidang Proposal</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="penguji_sidang_proposal" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="x_penguji_sidang_proposal" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Total Penguji Sidang Proposal</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nominal_penguji_sidang_proposal" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Penguji Sidang Skripsi</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="penguji_sidang_skripsi" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="x_penguji_sidang_skripsi" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Total Penguji Sidang Skripsi</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nominal_penguji_sidang_skripsi" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Koreksi Soal</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="koreksi_soal" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="x_koreksi_soal" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Total Koreksi Soal</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nominal_koreksi_soal" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pembuatan Soal</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="pembuatan_soal" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="x_pembuatan_soal" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Total Pembuatan Soal</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nominal_pembuatan_soal" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Dosen Wali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="dosen_wali" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="x_dosen_wali" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Total Dosen Wali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nominal_dosen_wali" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengawas Ujian</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="pengawas_ujian" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="x_pengawas_ujian" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Total Pengawas Ujian</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nominal_pengawas_ujian" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Remidial</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="remidial" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="x_remidial" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Total Remidial</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nominal_remidial" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pemb. Company Visit</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="pmb_company_visit" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pengali</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="x_pmb_company_visit" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Total Pemb. Company Visit</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="nominal_pmb_company_visit" required value=""/>
                                                    </div>

                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Reward EKIN</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="reward_ekin" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Jumlah Gaji, Tunjangan dan honor</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="jumlah_gaji_tunjangan_honor" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Potongan Kas Bon</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="potongan_kas_bon" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Pph 21</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="pph_21" required value=""/>
                                                    </div>

                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Potongan BPJS</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="potongan_bpjs" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Jumlah</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="jumlah" required value=""/>
                                                    </div>
                                                    <div class="d-flex flex-column mb-7 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                            <span class="required">Gaji Yang dibayar</span>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input class="form-control form-control-solid" type="text" name="gaji_yang_dibayar" required value=""/>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Actions-->
                                                    <div class="text-center pt-15">
                                                        <button type="reset" data-bs-dismiss="modal" class="btn btn-light me-3">Cancel</button>
                                                        <button type="submit" onclick="submitForm(this)" class="btn btn-primary">
                                                            <span class="indicator-label">Submit</span>
                                                        </button>
                                                    </div>
                                                    <!--end::Actions-->
                                                </form>
                                                <!--end::Form-->
                                            </div>
                                            <!--end::Modal body-->
                                        </div>
                                        <!--end::Modal content-->
                                    </div>
                                    <!--end::Modal dialog-->
                                </div>
                                <!--end::Modal-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Post-->
					</div>
                    <script>
                        function confirmDelete(event) {
                            event.preventDefault(); // Menghentikan tindakan penghapusan asli
                            if (confirm("Apakah Anda yakin ingin menghapus?")) {
                                // Jika pengguna menekan OK dalam konfirmasi, lanjutkan dengan penghapusan
                                event.target.form.submit();
                            }
                        }
                        // untuk submit agar tidak spam klik
                        function submitForm(button) {
                            button.disabled = true;
                                    button.innerHTML = 'Submitting...';

                                    // Mencegah pengiriman berulang
                                    button.form.submit();
                        }
                    </script>
@endsection
