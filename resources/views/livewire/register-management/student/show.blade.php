<div class="modal fade" tabindex="-1" id="modal-show-student" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header p-4">
                <h5 class="modal-title">Detil Data Santri/Murid</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="mb-5">Identitas Diri Santri/Murid</h5>
                        <div class="row">
                            <div class="col-sm-3 mb-5 mb-sm-0">
                                <img src="{{ asset('storage/'.$student?->image_of_profile) }}" alt="Student Image" class="w-100">
                            </div>
                            <div class="col-sm-9">
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">ID</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 text-gray-800">{{ $student?->id }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">No. Registrasi</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 text-gray-800">{{ $student?->registration_number }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">NIK</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 text-gray-800">{{ $student?->nik }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">KK</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 text-gray-800">{{ $student?->kk }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">Nama</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 fw-bold text-gray-800">{{ $student?->name }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">Jenis Kelamin</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 text-gray-800">{{ $student?->gender }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">Tempat, Tanggal Lahir</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 text-gray-800">{{ $student?->place_of_birth }}, {{ $student?->date_of_birth->isoFormat('D MMMM Y') }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">Pendidikan Akhir</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 text-gray-800">{{ $student?->last_education }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">Rencana Domisili</label>
                                    <div class="col-lg-8">
                                                <span class="fs-6 text-gray-800">
                                                    <b>{{ $student?->domicile_status }}</b>,  {{ $student?->domicile }} - {{ $student?->domicile_number }}
                                                </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">Angkatan Periode</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 text-gray-800">{{ $student?->period?->diniyah }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">Rencana Diniyah</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 text-gray-800">{{ $student?->grade_of_diniyah }} - {{ $student?->diniyah?->name }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">Rencana Formal</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 text-gray-800">{{ $student?->grade_of_formal }} - {{ $student?->formal?->name }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">Alamat</label>
                                    <div class="col-lg-8">
                                                <span class="fs-6 text-gray-800">
                                                    {{ $student?->address }}
                                                    <br>
                                                    {{ $student?->region?->village }} {{ $student?->region?->district }}
                                                    <br>
                                                    {{ $student?->region?->city }} {{ $student?->region?->province }}
                                                    <br>
                                                    {{ $student?->region?->portal_code }}
                                                </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">NIK Ayah</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 text-gray-800">{{ $student?->father_nik }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">Nama Ayah</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 fw-bold text-gray-800">{{ $student?->father }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">NIK Ibu</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 text-gray-800">{{ $student?->mother_nik }}</span>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <label class="col-lg-4 text-muted">Nama Ibu</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 fw-bold text-gray-800">{{ $student?->mother }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h5 class="mb-5">Identitas Wali</h5>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="col-sm-3 mb-5 mb-sm-0">
                                    <img src="{{ asset('storage/'.$student?->guardian?->image) }}" alt="Guardian Image" class="w-100">
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">NIK</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 text-gray-800">{{ $student?->guardian?->nik }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">Nama</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 fw-bold text-gray-800">{{ $student?->guardian?->name }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">Jenis Kelamin</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 text-gray-800">{{ $student?->guardian?->gender }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">No. Hp</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 text-gray-800">{{ $student?->guardian?->phone }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">No. WA</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 text-gray-800">{{ $student?->guardian?->wa_number }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">Pendidikan Akhir</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 text-gray-800">{{ $student?->guardian?->last_education }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">Pekerjaan</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 text-gray-800">{{ $student?->guardian?->employment }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">Hubungan Perwalian</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 fw-bold text-gray-800">{{ $student?->guardian_relationship }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 text-muted">Alamat</label>
                                    <div class="col-lg-8">
                                        <span class="fs-6 text-gray-800">
                                            {{ $student?->guardian?->address }}
                                            <br>
                                            {{ $student?->guardian?->region?->village }} {{ $student?->guardian?->region?->district }}
                                            <br>
                                            {{ $student?->guardian?->region?->city }} {{ $student?->guardian?->region?->province }}
                                            <br>
                                            {{ $student?->guardian?->region?->portal_code }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer p-4 justify-content-between">
                <div class="col-sm-2">
                    <button type="reset" class="btn btn-light-danger w-100" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        Tutup
                    </button>
                </div>
                <div class="col-sm-2">
                    <a target="_blank" href="{{ route('print.student', ['id' => $student?->id]) }} " class="btn btn-light-primary w-100">
                        <i class="ki-duotone ki-printer fs-1"><span class="path1"></span><span class="path2"></span></i>
                        Salinan Form
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
