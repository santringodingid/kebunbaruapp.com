<div class="modal fade" tabindex="-1" id="modal-add-reduction" data-bs-backdrop="static" data-bs-keyboard="false" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Pengurangan</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" aria-label="Close" onclick="reset()">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <form wire:submit.prevent="submit" autocomplete="off" onkeydown="return event.key != 'Enter';">
                <div class="modal-body">
                    <div class="mb-5 row">
                        <label for="name" class="col-sm-3 col-form-label">Nama <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" wire:model="name" class="form-control text-uppercase @error('studentId') is-invalid @enderror" id="name">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-5 row">
                        <label for="name" class="col-sm-3 col-form-label">Akun <span class="text-danger">*</span></label>
                        <div class="col-sm-9 row pt-3">
                            @if($accounts)
                            @forelse($accounts as $account)
                                <div class="col-6 mb-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" wire:model="checkedAccount" value="{{ $account->id }}" id="account-{{$account->id}}" />
                                        <label class="form-check-label" for="account-{{$account->id}}">
                                            {{ $account->name }}
                                        </label>
                                    </div>
                                </div>
                            @empty
                                Akun belum diatur
                            @endforelse
                            @endif
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="reset" class="btn btn-light me-3" onclick="reset()" wire:loading.attr="disabled">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary" onclick="submit()">
                    <span class="indicator-label" wire:loading.remove>
                            Simpan
                        </span>
                    <span class="indicator-progress" wire:loading>
                        Sedang dikirim...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
