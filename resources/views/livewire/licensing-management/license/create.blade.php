<div class="modal fade" tabindex="-1" id="modal-add-license" data-bs-backdrop="static" data-bs-keyboard="false" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Surat</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" aria-label="Close" onclick="reset()">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <form wire:submit.prevent="submit" autocomplete="off" onkeydown="return event.key != 'Enter';">
                <div class="modal-body">
                    <input type="hidden" name="mode" wire:model="mode">
                    <div class="row justify-content-between">
                        <div class="col-12 col-sm-6">
                            <div class="mb-5 row">
                                <label for="reg" class="col-sm-4 col-form-label">No. Reg.<span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" wire:model="reg" class="form-control text-uppercase mask-id" id="reg" onkeyup="beforeSubmit(event)">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" wire:model="studentId" class="form-control text-uppercase" disabled id="studentId">
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="name" class="col-sm-4 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" wire:model="name" disabled class="form-control text-uppercase" id="name">
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="address" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <textarea type="text" wire:model="address" disabled class="form-control" id="address"></textarea>
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="domicile" class="col-sm-4 col-form-label">Domisili</label>
                                <div class="col-sm-8">
                                    <input type="text" wire:model="domicile" disabled class="form-control" id="domicile">
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="diniyah" class="col-sm-4 col-form-label">Diniyah</label>
                                <div class="col-sm-8">
                                    <input type="text" wire:model="diniyah" disabled class="form-control" id="diniyah">
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="formal" class="col-sm-4 col-form-label">Formal</label>
                                <div class="col-sm-8">
                                    <input type="text" wire:model="formal" disabled class="form-control" id="formal">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="mb-5 row">
                                <label for="reason" class="col-sm-4 col-form-label">Alasan</label>
                                <div class="col-sm-8">
                                    <input type="text" wire:model="reason" disabled class="form-control" id="reason">
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="note" class="col-sm-4 col-form-label">Keterangan tambahan</label>
                                <div class="col-sm-8">
                                    <textarea type="text" wire:model="note" class="form-control " id="note" disabled></textarea>
                                </div>
                            </div>
                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-5 p-6">
                                <!--begin::Icon-->
                                <span class="ki-duotone ki-information fs-2tx text-warning me-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
                                <!--end::Icon-->
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-grow-1">
                                    <!--begin::Content-->
                                    <div class="fw-semibold">
                                        <div class="fs-6 text-gray-700">
                                            <strong class="me-1">Warning!</strong> <br>
                                            - Format tanggal: tanggal-bulan-tahun jam:menit:detik
                                            <br>
                                            - Validasi dulu tanggal sebelum disimpan
                                        </div>
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <div class="row mb-5">
                                <label for="start-at" class="col-sm-4 col-form-label">Berlaku sejak</label>
                                <div class="col-sm-8">
                                    <input type="text" wire:model="startAt" class="form-control mask-date" id="start-at" @if($mode) readonly @endif>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <label for="end-at" class="col-sm-4 col-form-label">Berakhir pada</label>
                                <div class="col-sm-8">
                                    <input type="text" wire:model="endAt" class="form-control mask-date" id="end-at" @if($mode) readonly @endif>
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
