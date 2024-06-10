<div class="modal fade" tabindex="-1" id="modal-show-guardian" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header p-4">
                <h5 class="modal-title">Detil Data Wali</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="mb-5">Identitas Diri Wali</h5>
                        <div class="row mb-2">
                            <label class="col-lg-4 text-muted">ID</label>
                            <div class="col-lg-8">
                                <span class="fs-6 text-gray-800">{{ $guardian?->id }}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-lg-4 text-muted">NIK</label>
                            <div class="col-lg-8">
                                <span class="fs-6 text-gray-800">{{ $guardian?->nik }}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-lg-4 text-muted">Nama</label>
                            <div class="col-lg-8">
                                <span class="fs-6 fw-bold text-gray-800">{{ $guardian?->name }}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-lg-4 text-muted">Jenis Kelamin</label>
                            <div class="col-lg-8">
                                <span class="fs-6 text-gray-800">{{ $guardian?->gender }}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-lg-4 text-muted">No. HP</label>
                            <div class="col-lg-8">
                                <span class="fs-6 text-gray-800">{{ $guardian?->phone }}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-lg-4 text-muted">No. WA</label>
                            <div class="col-lg-8">
                                <span class="fs-6 text-gray-800">{{ $guardian?->wa_number }}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-lg-4 text-muted">Pendidikan Akhir</label>
                            <div class="col-lg-8">
                                <span class="fs-6 text-gray-800">{{ $guardian?->last_education }}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-lg-4 text-muted">Pekerjaan</label>
                            <div class="col-lg-8">
                                <span class="fs-6 text-gray-800">{{ $guardian?->employment }}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-lg-4 text-muted">Alamat</label>
                            <div class="col-lg-8">
                                <span class="fs-6 text-gray-800">
                                    {{ $guardian?->address }}
                                    <br>
                                    {{ $guardian?->region?->village }} {{ $guardian?->region?->district }}
                                    <br>
                                    {{ $guardian?->region?->city }} {{ $guardian?->region?->province }}
                                    <br>
                                    {{ $guardian?->region?->portal_code }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h5 class="mb-5">Identitas Muwalli</h5>
                        @if($guardian?->students)
                        @forelse($guardian?->students as $student)
                            <div class="row mb-2">
                                <label class="col-lg-4 text-muted">ID</label>
                                <div class="col-lg-8">
                                    <span class="fs-6 text-gray-800">{{ $student?->id }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-lg-4 text-muted">Nama</label>
                                <div class="col-lg-8">
                                    <span class="fs-6 text-gray-800">{{ $student?->name }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-lg-4 text-muted">Jenis Kelamin</label>
                                <div class="col-lg-8">
                                    <span class="fs-6 text-gray-800">{{ $student?->gender }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-lg-4 text-muted">Domisili</label>
                                <div class="col-lg-8">
                                    <span class="fs-6 text-gray-800">
                                        <b>{{ $student?->domicile_status }}</b>,  {{ $student?->domicile }} - {{ $student?->domicile_number }}
                                    </span>
                                </div>
                            </div>
                            @if(!$loop->last)
                                <div class="separator separator-dashed mb-3"></div>
                            @endif
                        @empty
                            <div class="row mb-2">
                                <span class="text-danger talign-center">Tidak ada muwalli</span>
                            </div>
                        @endforelse
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer p-4 justify-content-end">
                <div class="col-sm-2">
                    <button type="reset" class="btn btn-light-danger w-100" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
