<div class="modal fade" tabindex="-1" id="modal-add-signature" data-bs-backdrop="static" data-bs-keyboard="false" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Foto Tanda Tangan</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" aria-label="Close" onclick="reset()">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <form wire:submit="submit" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <label for="photos" class="col-sm-6 col-form-label">
                            Foto (Harus berekstensi <span class="text-danger">.png</span> dan maksimal ukuran <span class="text-danger">1 Mb</span>)
                        </label>
                        <div class="col-sm-6">
                            <input type="file" wire:model="photos" class="form-control @error('photos.*') is-invalid @enderror" required multiple id="photos">
                            @error('photos.*')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div wire:loading wire:target="photos">Uploading...</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label" wire:loading.remove>
                            Simpan
                        </span>
                        <span class="indicator-progress" wire:loading wire:target="photos">
                            Foto sedang diupload...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
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
