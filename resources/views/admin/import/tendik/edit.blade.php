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
                            <form action="{{ route('update.tendik', $tendik->id ) }}" method="POST">
                                @csrf
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">email</label>
                                    <input type="text" value="{{$tendik->email}}" class="form-control form-control-solid" required name="email"/>
                                </div>
								<div class="mb-10">
									<label for="exampleFormControlInput1" class="required form-label">Bulan</label>
									<select class="form-select form-select-solid" name="bulan" required>
										@foreach (range(1, 12) as $month)
											<option value="{{ $month }}" {{ $tendik->bulan == $month ? 'selected' : '' }}>
												{{ ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$month - 1] }}
											</option>
										@endforeach
									</select>
								</div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Tahun</label>
                                    <input type="text" value="{{$tendik->tahun}}" class="form-control form-control-solid" required name="tahun"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Nama</label>
                                    <input type="text" value="{{$tendik->nama}}" class="form-control form-control-solid" required name="nama"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Jabatan</label>
                                    <input type="text" value="{{$tendik->jabatan}}" class="form-control form-control-solid" required name="jabatan"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Gaji Pokok</label>
                                    <input type="text" value="{{$tendik->gaji_pokok}}" class="form-control form-control-solid" required name="gaji_pokok"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Tunjangan Jabatan</label>
                                    <input type="text" value="{{$tendik->tunjangan_jabatan}}" class="form-control form-control-solid" required name="tunjangan_jabatan"/>
                                </div>
								<!-- <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Bonus</label>
                                    <input type="text" value="{{$tendik->bonus}}" class="form-control form-control-solid" required name="bonus"/>
                                </div> -->
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Tunjangan Kehadiran</label>
                                    <input type="text" value="{{$tendik->tunjangan_kehadiran}}" class="form-control form-control-solid" required name="tunjangan_kehadiran"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Tunjangan lembur</label>
                                    <input type="text" value="{{$tendik->tunjangan_lembur}}" class="form-control form-control-solid" required name="tunjangan_lembur"/>
                                </div>
								<!-- <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Tunj. Pel. Mhs/Op. Feeder</label>
                                    <input type="text" value="{{$tendik->tunj_pel_mhs_op_feeder}}" class="form-control form-control-solid" required name="tunj_pel_mhs_op_feeder"/>
                                </div> -->
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Tunjangan Kinerja</label>
                                    <input type="text" value="{{$tendik->tunjangan_kinerja}}" class="form-control form-control-solid" required name="tunjangan_kinerja"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Jumlah</label>
                                    <input type="text" value="{{$tendik->jumlah_penambah}}" class="form-control form-control-solid" required name="jumlah_penambah"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Potongan Kasbon </label>
                                    <input type="text" value="{{$tendik->potongan_kasbon}}" class="form-control form-control-solid" required name="potongan_kasbon"/>
                                </div>

								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Denda Keterlambatan</label>
                                    <input type="text" value="{{$tendik->denda_keterlambatan}}" class="form-control form-control-solid" required name="denda_keterlambatan"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Potongan Pph 21</label>
                                    <input type="text" value="{{$tendik->potongan_pph_21}}" class="form-control form-control-solid" required name="potongan_pph_21"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Potongan Absensi</label>
                                    <input type="text" value="{{$tendik->potongan_absensi}}" class="form-control form-control-solid" required name="potongan_absensi"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Potongan BPJS</label>
                                    <input type="text" value="{{$tendik->potongan_bpjs}}" class="form-control form-control-solid" required name="potongan_bpjs"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Jumlah</label>
                                    <input type="text" value="{{$tendik->jumlah_pengurang}}" class="form-control form-control-solid" required name="jumlah_pengurang"/>
                                </div>
								<div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Gaji Yang Dibayar</label>
                                    <input type="text" value="{{$tendik->gaji_yang_dibayar}}" class="form-control form-control-solid" required name="gaji_yang_dibayar"/>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <!--begin::Actions-->
                                    <a href="{{ route('tendik') }}" class="btn btn-secondary">
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
