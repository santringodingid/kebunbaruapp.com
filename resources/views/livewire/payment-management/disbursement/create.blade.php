<div class="modal fade" tabindex="-1" id="modal-add-disbursement" wire:ignore.self>
    <div class="modal-dialog modal-default">
        <div class="modal-content position-absolute">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Distribusi</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <form wire:submit="store" autocomplete="off">
                <div class="modal-body">
                    <div class="mb-5 row">
                        <label for="accountId" class="col-sm-4 col-form-label">Akun</label>
                        <div class="col-sm-8">
                            <select wire:model="accountId" class="form-select" data-dropdown-parent="#modal-add-disbursement" data-placeholder="Masukkan akun" id="accountId">
                                <option value="0">.:Pilih Akun:.</option>
                                @if($accounts)
                                    @foreach($accounts as $account)
                                        <option value="{{ $account->id }}">{{ $account->name }}
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mb-5 row">
                        <label for="institutionMale" class="col-sm-4 col-form-label">Instansi Putra</label>
                        <div class="col-sm-8">
                            <select wire:model="institutionMale" class="form-select" data-dropdown-parent="#modal-add-disbursement" data-placeholder="Masukkan akun" id="institutionMale">
                                <option value="0">.:Madrasah:.</option>
                                @if($institutions)
                                    @foreach($institutions as $institution)
                                        <option value="{{ $institution->id }}">{{ $institution->name }}
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mb-5 row">
                        <label for="institutionFemale" class="col-sm-4 col-form-label">Instansi Putri</label>
                        <div class="col-sm-8">
                            <select wire:model="institutionFemale" class="form-select" data-dropdown-parent="#modal-add-disbursement" data-placeholder="Masukkan akun" id="institutionFemale">
                                <option value="0">.:Madrasah:.</option>
                                @if($institutions)
                                    @foreach($institutions as $institution)
                                        <option value="{{ $institution->id }}">{{ $institution->name }}
                                    @endforeach
                                @endif
                            </select>
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
