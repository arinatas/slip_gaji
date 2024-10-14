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
                            <form action="{{ route('update.dosenlb', $dosenlb->id ) }}" method="POST">
                                @csrf
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">email</label>
                                    <input type="text" value="{{$dosenlb->email}}" class="form-control form-control-solid" required name="email"/>
                                </div>
								<div class="mb-10">
									<label for="exampleFormControlInput1" class="required form-label">Bulan</label>
									<select class="form-select form-select-solid" name="bulan" required>
										@foreach (range(1, 12) as $month)
											<option value="{{ $month }}" {{ $dosenlb->bulan == $month ? 'selected' : '' }}>
												{{ ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$month - 1] }}
											</option>
										@endforeach
									</select>
								</div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Tahun</label>
                                    <input type="text" value="{{$dosenlb->tahun}}" class="form-control form-control-solid" required name="tahun"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Nama</label>
                                    <input type="text" value="{{$dosenlb->nama}}" class="form-control form-control-solid" required name="nama"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Jabatan Struktural</label>
                                    <input type="text" value="{{$dosenlb->jabatan_struktural}}" class="form-control form-control-solid" required name="jabatan_struktural"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Jabatan Fungsional</label>
                                    <input type="text" value="{{$dosenlb->jabatan_fungsional}}" class="form-control form-control-solid" required name="jabatan_fungsional"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Honor Pokok</label>
                                    <input type="text" value="{{$dosenlb->honor_pokok}}" class="form-control form-control-solid" required name="honor_pokok"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Matkul 1</label>
                                    <input type="text" value="{{$dosenlb->matkul_1}}" class="form-control form-control-solid" name="matkul_1"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Nominal Matkul 1</label>
                                    <input type="text" value="{{$dosenlb->nominal_matkul_1}}" class="form-control form-control-solid" name="nominal_matkul_1"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">SKS Matkul 1</label>
                                    <input type="text" value="{{$dosenlb->sks_matkul_1}}" class="form-control form-control-solid" name="sks_matkul_1"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Jml Hadir Matkul 1</label>
                                    <input type="text" value="{{$dosenlb->jml_hadir_mkl_1}}" class="form-control form-control-solid" name="jml_hadir_mkl_1"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Honor Matkul 1</label>
                                    <input type="text" value="{{$dosenlb->honor_mk_1}}" class="form-control form-control-solid" name="honor_mk_1"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Matkul 2</label>
                                    <input type="text" value="{{$dosenlb->matkul_2}}" class="form-control form-control-solid" name="matkul_2"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Nominal Matkul 2</label>
                                    <input type="text" value="{{$dosenlb->nominal_matkul_2}}" class="form-control form-control-solid" name="nominal_matkul_2"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">SKS Matkul 2</label>
                                    <input type="text" value="{{$dosenlb->sks_matkul_2}}" class="form-control form-control-solid" name="sks_matkul_2"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Jml Hadir Matkul 2</label>
                                    <input type="text" value="{{$dosenlb->jml_hadir_mkl_2}}" class="form-control form-control-solid" name="jml_hadir_mkl_2"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Honor Matkul 2</label>
                                    <input type="text" value="{{$dosenlb->honor_mk_2}}" class="form-control form-control-solid" name="honor_mk_2"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Matkul 3</label>
                                    <input type="text" value="{{$dosenlb->matkul_3}}" class="form-control form-control-solid" name="matkul_3"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Nominal Matkul 3 </label>
                                    <input type="text" value="{{$dosenlb->nominal_matkul_3}}" class="form-control form-control-solid" name="nominal_matkul_3"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">SKS Matkul 3</label>
                                    <input type="text" value="{{$dosenlb->sks_matkul_3}}" class="form-control form-control-solid" name="sks_matkul_3"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Jml Hadir Matkul 3</label>
                                    <input type="text" value="{{$dosenlb->jml_hadir_mkl_3}}" class="form-control form-control-solid" name="jml_hadir_mkl_3"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Honor Matkul 3</label>
                                    <input type="text" value="{{$dosenlb->honor_mk_3}}" class="form-control form-control-solid" name="honor_mk_3"/>
                                </div>

								<div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Matkul 4</label>
                                    <input type="text" value="{{$dosenlb->matkul_4}}" class="form-control form-control-solid" name="matkul_4"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Nominal Matkul 4</label>
                                    <input type="text" value="{{$dosenlb->nominal_matkul_4}}" class="form-control form-control-solid" name="nominal_matkul_4"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">SKS Matkul 4</label>
                                    <input type="text" value="{{$dosenlb->sks_matkul_4}}" class="form-control form-control-solid" name="sks_matkul_4"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Jml Hadir Matkul 4</label>
                                    <input type="text" value="{{$dosenlb->jml_hadir_mkl_4}}" class="form-control form-control-solid" name="jml_hadir_mkl_4"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Honor Matkul 4</label>
                                    <input type="text" value="{{$dosenlb->honor_mk_4}}" class="form-control form-control-solid" name="honor_mk_4"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Matkul 5</label>
                                    <input type="text" value="{{$dosenlb->matkul_5}}" class="form-control form-control-solid" name="matkul_5"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Nominal Matkul 5</label>
                                    <input type="text" value="{{$dosenlb->nominal_matkul_5}}" class="form-control form-control-solid" name="nominal_matkul_5"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">SKS Matkul 5</label>
                                    <input type="text" value="{{$dosenlb->sks_matkul_5}}" class="form-control form-control-solid" name="sks_matkul_5"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Jml Hadir Matkul 5</label>
                                    <input type="text" value="{{$dosenlb->jml_hadir_mkl_5}}" class="form-control form-control-solid" name="jml_hadir_mkl_5"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Honor Matkul 5</label>
                                    <input type="text" value="{{$dosenlb->honor_mk_5}}" class="form-control form-control-solid" name="honor_mk_5"/>
                                </div>

                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Matkul 6</label>
                                    <input type="text" value="{{$dosenlb->matkul_6}}" class="form-control form-control-solid" name="matkul_6"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Nominal Matkul 6</label>
                                    <input type="text" value="{{$dosenlb->nominal_matkul_6}}" class="form-control form-control-solid" name="nominal_matkul_6"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">SKS Matkul 6</label>
                                    <input type="text" value="{{$dosenlb->sks_matkul_6}}" class="form-control form-control-solid" name="sks_matkul_6"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Jml Hadir Matkul 6</label>
                                    <input type="text" value="{{$dosenlb->jml_hadir_mkl_6}}" class="form-control form-control-solid" name="jml_hadir_mkl_6"/>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" form-label">Honor Matkul 6</label>
                                    <input type="text" value="{{$dosenlb->honor_mk_6}}" class="form-control form-control-solid" name="honor_mk_6"/>
                                </div>


								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Anggota Klp Dosen</label>
                                    <input type="text" value="{{$dosenlb->anggota_klp_dosen}}" class="form-control form-control-solid" required name="anggota_klp_dosen"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Pembuatan Soal</label>
                                    <input type="text" value="{{$dosenlb->pembuatan_soal}}" class="form-control form-control-solid" required name="pembuatan_soal"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Koreksi Soal</label>
                                    <input type="text" value="{{$dosenlb->koreksi_soal}}" class="form-control form-control-solid" required name="koreksi_soal"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Pengawas Ujian</label>
                                    <input type="text" value="{{$dosenlb->pengawas_ujian}}" class="form-control form-control-solid" required name="pengawas_ujian"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Jumlah</label>
                                    <input type="text" value="{{$dosenlb->jumlah}}" class="form-control form-control-solid" required name="jumlah"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Pph 21</label>
                                    <input type="text" value="{{$dosenlb->pph_21}}" class="form-control form-control-solid" required name="pph_21"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Honor Yang dibayar</label>
                                    <input type="text" value="{{$dosenlb->honor_yang_dibayar}}" class="form-control form-control-solid" required name="honor_yang_dibayar"/>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <!--begin::Actions-->
                                    <a href="{{ route('dosenlb') }}" class="btn btn-secondary">
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
