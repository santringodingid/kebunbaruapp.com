<div class="modal fade" tabindex="-1" id="modal-add-period" wire:ignore.self>
    <div class="modal-dialog modal-default">
        <div class="modal-content position-absolute">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Period</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <form wire:submit="store" autocomplete="off">
                <div class="modal-body">
                    <div class="mb-5 row">
                        <label for="diniyah" class="col-sm-4 col-form-label">Diniyah</label>
                        <div class="col-sm-8">
                            <input type="text" wire:model="diniyah" class="form-control text-uppercase @error('diniyah') is-invalid @enderror period" id="diniyah">
                            @error('diniyah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-5 row">
                        <label for="ammiyah" class="col-sm-4 col-form-label">Ammiyah</label>
                        <div class="col-sm-8">
                            <input type="text" wire:model="ammiyah" class="form-control text-capitalize @error('ammiyah') is-invalid @enderror period" id="ammiyah">
                            @error('ammiyah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label" wire:loading.remove>
                            Simpan
                        </span>
                        <span class="indicator-progress" wire:loading>
                            Sedang dikirim...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
