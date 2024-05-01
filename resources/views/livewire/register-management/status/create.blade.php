<div class="modal fade" tabindex="-1" id="modal-add-status" data-bs-backdrop="static" data-bs-keyboard="false" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Registrasi Status</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" aria-label="Close" onclick="reset()">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <form wire:submit.prevent="submit" autocomplete="off" onkeydown="return event.key != 'Enter';">
                <div class="modal-body">
                    <input type="hidden" name="mode" wire:model="mode">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-5 row">
                                <label for="studentId" class="col-sm-4 col-form-label">ID Santri/Murid <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" wire:model="studentId" class="form-control text-uppercase @error('studentId') is-invalid @enderror mask-id" id="studentId">
                                    @error('studentId')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="name" class="col-sm-4 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" wire:model="name" disabled class="form-control text-uppercase @error('name') is-invalid @enderror" id="name">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="address" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <textarea type="text" wire:model="address" disabled class="form-control @error('address') is-invalid @enderror" id="address"></textarea>
                                    @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="domicile" class="col-sm-4 col-form-label">Domisili</label>
                                <div class="col-sm-8">
                                    <input type="text" wire:model="domicile" disabled class="form-control @error('domicile') is-invalid @enderror" id="domicile">
                                    @error('domicile')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="diniyah" class="col-sm-4 col-form-label">Diniyah</label>
                                <div class="col-sm-8">
                                    <input type="text" wire:model="diniyah" disabled class="form-control @error('diniyah') is-invalid @enderror" id="diniyah">
                                    @error('diniyah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="formal" class="col-sm-4 col-form-label">Formal</label>
                                <div class="col-sm-8">
                                    <input type="text" wire:model="formal" disabled class="form-control @error('formal') is-invalid @enderror" id="formal">
                                    @error('formal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                                <!--begin::Icon-->
                                <span class="ki-duotone ki-information fs-2tx text-warning me-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
                                <!--end::Icon-->
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-grow-1">
                                    <!--begin::Content-->
                                    <div class="fw-semibold">
                                        <div class="fs-6 text-gray-700">
                                            <strong class="me-1">Warning!</strong> <br>
                                            Data status mengacu pada registrasi terakhir. <br>
                                            Kamu bisa ubah sesuai kebutuhan...
                                        </div>
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <div class="mb-5 row">
                                <label for="status" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <div class="d-flex gap-8 mt-3">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" wire:model="status" value="0" id="quited" name="status"/>
                                            <label class="form-check-label" for="quited">
                                                Berhenti
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" wire:model="status" value="1" id="active" name="status"/>
                                            <label class="form-check-label" for="active">
                                                Aktif
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" wire:model="status" value="2" id="assigned" name="status"/>
                                            <label class="form-check-label" for="assigned">
                                                Tugas
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" wire:model="status" value="3" id="administrator" name="status"/>
                                            <label class="form-check-label" for="assigned">
                                                Pengurus
                                            </label>
                                        </div>
                                    </div>
                                    @error('status')
                                    <small class="text-danger mt-2 d-block">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="note" class="col-sm-3 col-form-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <textarea type="text" wire:model="note" class="form-control @error('note') is-invalid @enderror" id="note"></textarea>
                                    @error('note')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="reset" class="btn btn-light me-3" onclick="reset()" wire:loading.attr="disabled">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary" onclick="submit()">
                    @if($mode)
                        <span class="indicator-label" wire:loading.remove>
                            Lakukan Pengecekan
                        </span>
                    @else
                        <span class="indicator-label" wire:loading.remove>
                            Simpan
                        </span>
                    @endif
                    <span class="indicator-progress" wire:loading>
                        Sedang dikirim...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
