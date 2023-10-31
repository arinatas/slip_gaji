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
									<div class="card-body pb-0">
										<!--begin::Heading-->
										<!--begin::Row-->
										<div class="row g-5 g-xl-8">
											<div class="col-lg-12 mb-10">
                                                <!--begin::Notice-->
                                                <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                                                    <!--begin::Wrapper-->
                                                    <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                                        <!--begin::Content-->
                                                        <div class="mb-3 mb-md-0 fw-bold">
                                                            <h4 class="text-gray-900 fw-bolder">Hai {{ auth()->user()->name }}, Selamat datang di sistem slip gaji online Primakara ❤️</h4>
                                                            <div class="fs-6 text-gray-700 pe-7">Kami senang melihat Anda di sini. Dengan sistem ini, Anda akan dapat dengan mudah mengakses dan mengelola informasi gaji Anda.

                                                                Jika Anda memiliki pertanyaan atau memerlukan bantuan, jangan ragu untuk menghubungi SDM

                                                                Terima kasih telah menjadi bagian dari keluarga Primakara. Semoga sistem ini membantu Anda dalam mengelola informasi gaji dengan lebih baik.

                                                                Salam Hangat,
                                                                [SDM Primakara]</div>
                                                        </div>
                                                        <!--end::Content-->
                                                        <!--begin::Action-->
                                                        @if (auth()->user()->jenis_pegawai == 1)
                                                            <a href="{{ url('slipGajiTendik') }}" class="btn btn-primary px-6 align-self-center text-nowrap">Lihat Slip Gaji</a>
                                                        @endif
                                                        @if (auth()->user()->jenis_pegawai == 2)
                                                            <a href="{{ url('slipGajiDosenTetap') }}" class="btn btn-primary px-6 align-self-center text-nowrap">Lihat Slip Gaji</a>
                                                        @endif
                                                        @if (auth()->user()->jenis_pegawai == 3)
                                                            <a href="{{ url('slipGajiDosenLB') }}" class="btn btn-primary px-6 align-self-center text-nowrap">Lihat Slip Gaji</a>
                                                        @endif
                                                        <!--end::Action-->
                                                    </div>
                                                    <!--end::Wrapper-->
                                                </div>
                                                <!--end::Notice-->
                                            </div>
										</div>
										<!--end::Row-->
									</div>
									<!--end::Card body-->
								</div>
								<!--end::Card-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Post-->
					</div>
@endsection
