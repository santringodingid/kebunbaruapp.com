<div class="modal fade" tabindex="-1" id="modal-add-infaq" wire:ignore.self>
    <div class="modal-dialog modal-default">
        <div class="modal-content position-absolute">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Tarif Infaq</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <form wire:submit="store" autocomplete="off">
                <div class="modal-body">
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
                                    Nominal infaq pembangunan untuk LP2K tidak menjadi acuan. Karena ada perbedaan antar RA dan madrasah lainnya.
                                </div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <div class="mb-5 row">
                        <label for="accountId" class="col-sm-4 col-form-label">Akun</label>
                        <div class="col-sm-8">
                            <select wire:model="accountId" class="form-select" id="accountId">
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
                        <label for="domicile-status" class="col-sm-4 col-form-label">Status Domisili</label>
                        <div class="col-sm-8">
                            <div class="d-flex gap-8 mt-3">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" wire:model="domicileStatus" value="1" id="p2k" name="domicile_status"/>
                                    <label class="form-check-label" for="p2k">
                                        P2K (Mukim)
                                    </label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" wire:model="domicileStatus" value="0" id="lp2k" name="domicile_status"/>
                                    <label class="form-check-label" for="lp2k">
                                        LP2K (Non Mukim)
                                    </label>
                                </div>
                            </div>
                            @error('domicileStatus')
                            <small class="text-danger mt-2 d-block">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-5 row">
                        <label for="nominal" class="col-sm-4 col-form-label">Nominal Bawaan</label>
                        <div class="col-sm-8">
                            <input type="text" wire:model="nominal" class="form-control nominal @error('nominal') is-invalid @enderror" id="nominal">
                            @error('nominal')
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

@script
<script>
    new AutoNumeric('#nominal', {
        digitGroupSeparator: '.',
        decimalPlaces: 0,
        decimalCharacter: ','
    })
</script>
@endscript

