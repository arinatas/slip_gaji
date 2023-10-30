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
						<div class="card-px pt-10">
							<!--begin::Title-->
							<div class="row">
								<div class="col">
									<h2 class="fs-2x fw-bolder mb-0">Edit {{ $title }}</h2>
								</div>
							</div>
							<!--end::Title-->
						</div>
						<!--end::Heading-->
						<!--begin::Table-->
                        <div class="mt-15">
                            <form action="{{ route('update.dosentetap', $dosenTetap->id ) }}" method="POST">
                                @csrf
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">email</label>
                                    <input type="text" value="{{$dosenTetap->email}}" class="form-control form-control-solid" required name="email"/>
                                </div>
								<div class="mb-10">
									<label for="exampleFormControlInput1" class="required form-label">Bulan</label>
									<select class="form-select form-select-solid" name="bulan" required>
										@foreach (range(1, 12) as $month)
											<option value="{{ $month }}" {{ $dosenTetap->bulan == $month ? 'selected' : '' }}>
												{{ ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$month - 1] }}
											</option>
										@endforeach
									</select>
								</div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Tahun</label>
                                    <input type="text" value="{{$dosenTetap->tahun}}" class="form-control form-control-solid" required name="tahun"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Nama</label>
                                    <input type="text" value="{{$dosenTetap->nama}}" class="form-control form-control-solid" required name="nama"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Jabatan Struktural</label>
                                    <input type="text" value="{{$dosenTetap->jabatan_struktural}}" class="form-control form-control-solid" required name="jabatan_struktural"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Jabatan Fungsional</label>
                                    <input type="text" value="{{$dosenTetap->jabatan_fungsional}}" class="form-control form-control-solid" required name="jabatan_fungsional"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Gaji Pokok</label>
                                    <input type="text" value="{{$dosenTetap->gaji_pokok}}" class="form-control form-control-solid" required name="gaji_pokok"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Tunjangan Kehadiran</label>
                                    <input type="text" value="{{$dosenTetap->tunjangan_kehadiran}}" class="form-control form-control-solid" required name="tunjangan_kehadiran"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Tunj. Jbt.Struktural</label>
                                    <input type="text" value="{{$dosenTetap->tunjangan_jabatan_struktural}}" class="form-control form-control-solid" required name="tunjangan_jabatan_struktural"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Tunj. Jbt. Fungsional</label>
                                    <input type="text" value="{{$dosenTetap->tunjangan_jabatan_fungsional}}" class="form-control form-control-solid" required name="tunjangan_jabatan_fungsional"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Honor Mengajar Kelas Pagi</label>
                                    <input type="text" value="{{$dosenTetap->honor_mengajar_kls_pagi}}" class="form-control form-control-solid" required name="honor_mengajar_kls_pagi"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Honor Mengajar Kelas Malam</label>
                                    <input type="text" value="{{$dosenTetap->honor_mengajar_kls_malam}}" class="form-control form-control-solid" required name="honor_mengajar_kls_malam"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Pmb./Penguji Kerja Praktek </label>
                                    <input type="text" value="{{$dosenTetap->pmb_atau_penguji_kp}}" class="form-control form-control-solid" required name="pmb_atau_penguji_kp"/>
                                </div>

								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Pmb. I Proposal (kls pagi)</label>
                                    <input type="text" value="{{$dosenTetap->pmb_1_proposal_pagi}}" class="form-control form-control-solid" required name="pmb_1_proposal_pagi"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Pmb. I Proposal (kls malam)</label>
                                    <input type="text" value="{{$dosenTetap->pmb_1_proposal_malam}}" class="form-control form-control-solid" required name="pmb_1_proposal_malam"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Pmb. I Skripsi (kls pagi)</label>
                                    <input type="text" value="{{$dosenTetap->pmb_1_skripsi_pagi}}" class="form-control form-control-solid" required name="pmb_1_skripsi_pagi"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Pmb. I Skripsi (kls malam)</label>
                                    <input type="text" value="{{$dosenTetap->pmb_1_skripsi_malam}}" class="form-control form-control-solid" required name="pmb_1_skripsi_malam"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Pmb. II Proposal (kls pagi)</label>
                                    <input type="text" value="{{$dosenTetap->pmb_2_proposal_pagi}}" class="form-control form-control-solid" required name="pmb_2_proposal_pagi"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Pmb. II Proposal (kls malam)</label>
                                    <input type="text" value="{{$dosenTetap->pmb_2_proposal_malam}}" class="form-control form-control-solid" required name="pmb_2_proposal_malam"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Pmb. II Skripsi (kls pagi)</label>
                                    <input type="text" value="{{$dosenTetap->pmb_2_skripsi_pagi}}" class="form-control form-control-solid" required name="pmb_2_skripsi_pagi"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Pmb. II Skripsi (kls malam)</label>
                                    <input type="text" value="{{$dosenTetap->pmb_2_skripsi_malam}}" class="form-control form-control-solid" required name="pmb_2_skripsi_malam"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Penguji Sidang Proposal</label>
                                    <input type="text" value="{{$dosenTetap->penguji_sidang_proposal}}" class="form-control form-control-solid" required name="penguji_sidang_proposal"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Penguji Sidang Skripsi</label>
                                    <input type="text" value="{{$dosenTetap->penguji_sidang_skripsi}}" class="form-control form-control-solid" required name="penguji_sidang_skripsi"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Koreksi Soal</label>
                                    <input type="text" value="{{$dosenTetap->koreksi_soal}}" class="form-control form-control-solid" required name="koreksi_soal"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Pembuatan Soal</label>
                                    <input type="text" value="{{$dosenTetap->pembuatan_soal}}" class="form-control form-control-solid" required name="pembuatan_soal"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Dosen Wali</label>
                                    <input type="text" value="{{$dosenTetap->dosen_wali}}" class="form-control form-control-solid" required name="dosen_wali"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Pengawas Ujian</label>
                                    <input type="text" value="{{$dosenTetap->pengawas_ujian}}" class="form-control form-control-solid" required name="pengawas_ujian"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Pembina UKM</label>
                                    <input type="text" value="{{$dosenTetap->pembina_ukm}}" class="form-control form-control-solid" required name="pembina_ukm"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Remidial</label>
                                    <input type="text" value="{{$dosenTetap->remidial}}" class="form-control form-control-solid" required name="remidial"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Pemb. Company Visit</label>
                                    <input type="text" value="{{$dosenTetap->pmb_company_visit}}" class="form-control form-control-solid" required name="pmb_company_visit"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Reward EKIN</label>
                                    <input type="text" value="{{$dosenTetap->reward_ekin}}" class="form-control form-control-solid" required name="reward_ekin"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Jumlah Gaji, Tunjangan dan honor</label>
                                    <input type="text" value="{{$dosenTetap->jumlah_gaji_tunjangan_honor}}" class="form-control form-control-solid" required name="jumlah_gaji_tunjangan_honor"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Potongan Kas Bon</label>
                                    <input type="text" value="{{$dosenTetap->potongan_kas_bon}}" class="form-control form-control-solid" required name="potongan_kas_bon"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Pph 21</label>
                                    <input type="text" value="{{$dosenTetap->pph_21}}" class="form-control form-control-solid" required name="pph_21"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Potongan Absensi </label>
                                    <input type="text" value="{{$dosenTetap->potongan_absensi}}" class="form-control form-control-solid" required name="potongan_absensi"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Potongan BPJS</label>
                                    <input type="text" value="{{$dosenTetap->potongan_bpjs}}" class="form-control form-control-solid" required name="potongan_bpjs"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Jumlah</label>
                                    <input type="text" value="{{$dosenTetap->jumlah}}" class="form-control form-control-solid" required name="jumlah"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Gaji Yang dibayar</label>
                                    <input type="text" value="{{$dosenTetap->gaji_yang_dibayar}}" class="form-control form-control-solid" required name="gaji_yang_dibayar"/>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <!--begin::Actions-->
                                    <a href="{{ route('dosentetap') }}" class="btn btn-secondary">
                                        <span class="indicator-label">
                                            Cancel
                                        </span>
                                    </a>
                                    <button id="submit_form" type="submit" class="btn btn-primary" style="margin-left: 10px; margin-right: 10px;">
                                        <span class="indicator-label">
                                            Submit
                                        </span>
                                    </button>
                                    <!--end::Actions-->
                                </div>
                            </form>
                        </div>
						<!--end::Table-->
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
		document.getElementById('submit-btn').addEventListener('click', confirmDelete);

		function confirmDelete(event) {
		event.preventDefault();

		Swal.fire({
			title: 'Anda yakin ingin menghapus data ini?',
			text: 'Pastikan semua data sudah benar sebelum menekan tombol OK',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'OK'
		}).then((result) => {
			if (result.isConfirmed) {
			event.target.form.submit();
			}
		});
		}
	</script>
@endsection
