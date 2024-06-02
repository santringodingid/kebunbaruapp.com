<div class="modal fade" tabindex="-1" id="modal-add-guardian-card" data-bs-backdrop="static" data-bs-keyboard="false" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Kartu Wali</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" aria-label="Close" onclick="reset()">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <form wire:submit.prevent="submit" autocomplete="off" onkeydown="return event.key != 'Enter';">
                <input type="hidden" name="mode" wire:model="mode">
                <div class="modal-body">
                    <div class="row mb-8">
                        <div class="col-sm-6">
                            <div class="mb-5 row">
                                <label for="guardianId" class="col-sm-3 col-form-label">ID Wali <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" wire:model="guardianId" class="form-control text-uppercase mask-id" id="guardianId" @if(!$mode) disabled @endif>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h3>Identitas Muwalli</h3>
                        </div>
                    </div>
                    @if($guardian)
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="{{ asset('storage/'.$guardian->image) }}" class="w-100 rounded" alt="">
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="mb-3 d-flex">
                                            <div class="me-4">-</div>
                                            <div class="fw-normal">{{ $guardian->id }}</div>
                                        </div>
                                        <div class="separator separator-dashed"></div>
                                        <div class="my-3 d-flex">
                                            <div class="me-4">-</div>
                                            <div class="fw-normal">{{ \Illuminate\Support\Str::mask($guardian->nik, '*', 4, 6) }}</div>
                                        </div>
                                        <div class="separator separator-dashed"></div>
                                        <div class="my-3 d-flex">
                                            <div class="me-4">-</div>
                                            <div class="fw-bold">{{ $guardian->name }}</div>
                                        </div>
                                        <div class="separator separator-dashed"></div>
                                        <div class="my-3 d-flex">
                                            <div class="me-4">-</div>
                                            <div class="fw-normal">{{ $guardian->gender ? 'Perempuan' : 'Laki-laki' }}</div>
                                        </div>
                                        <div class="separator separator-dashed"></div>
                                        <div class="my-3 d-flex">
                                            <div class="me-4">-</div>
                                            <div class="fw-normal">{{ $guardian->phone }} | {{ $guardian->wa_number }}</div>
                                        </div>
                                        <div class="separator separator-dashed"></div>
                                        <div class="my-3 d-flex">
                                            <div class="me-4">-</div>
                                            <div class="fw-normal">
                                                {{ $guardian->address }} <br>
                                                {{ $guardian->region->village }}, {{ $guardian->region->city }}
                                            </div>
                                        </div>
                                        <div class="separator separator-dashed"></div>
                                        <div class="my-3 d-flex">
                                            <div class="me-4">-</div>
                                            <div class="fw-normal">{{ $guardian->last_education }}</div>
                                        </div>
                                        <div class="separator separator-dashed"></div>
                                        <div class="my-3 d-flex">
                                            <div class="me-4">-</div>
                                            <div class="fw-normal">{{ $guardian->employment }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                @foreach($guardian->allStudent as $student)
                                    <div class="row mb-8">
                                        <div class="col-sm-3">
                                            <img class="w-100 rounded" src="{{ asset('storage/'.$student->image_of_profile) }}" alt="">
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="mb-3 d-flex">
                                                <div class="me-4">-</div>
                                                <div class="fw-normal">{{ $student->id }}</div>
                                            </div>
                                            <div class="separator separator-dashed"></div>
                                            <div class="my-3 d-flex">
                                                <div class="me-4">-</div>
                                                <div class="fw-bold">{{ $student->name }}</div>
                                            </div>
                                            <div class="separator separator-dashed"></div>
                                            <div class="my-3 d-flex">
                                                <div class="me-4">-</div>
                                                <div class="fw-normal">{{ $student->domicile_status }}, {{ $student->domicile.' - '.$student->domicile_number }}</div>
                                            </div>
                                            <div class="separator separator-dashed"></div>
                                            <div class="my-3 d-flex">
                                                <div class="me-4">-</div>
                                                <div class="fw-bold">{{ $student->guardian_relationship }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </form>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-light me-3" onclick="reset()" wire:loading.attr="disabled">
                        Batal
                    </button>
                    @if($mode)
                        <button type="submit" class="btn btn-primary" onclick="submit(true)">
                        <span class="indicator-label" wire:loading.remove>
                            Lakukan Pengecekan
                        </span>
                            <span class="indicator-progress" wire:loading>
                            Sedang dikirim...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                        </button>
                    @else
                        <button type="submit" class="btn btn-primary" onclick="submit(false)">
                            <span class="indicator-label" wire:loading.remove>
                                Simpan
                            </span>
                            <span class="indicator-progress" wire:loading>
                                Sedang dikirim...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    @endif
                </div>

        </div>
    </div>
</div>
