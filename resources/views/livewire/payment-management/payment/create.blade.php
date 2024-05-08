<div class="modal fade" tabindex="-1" id="modal-add-payment" data-bs-backdrop="static" data-bs-keyboard="false" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Pembayaran</h3>

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
                        @if(!$mode)
                        <div class="col-sm-5">
                            <h4 class="fw-normal mb-8">Silahkan pilih opsi pembayaran....</h4>
                            @if($optionOne['status'])
                                <label class="btn btn-outline btn-outline-dashed border-primary btn-active-light-primary d-flex text-start p-6 mb-5 @if($selectedOption == 1) active @endif">
                                    <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                        <input wire:model.live="selectedOption" class="form-check-input" type="radio" name="discount_option" value="1">
                                    </span>
                                    <span class="ms-5 w-100">
                                        <span class="fs-4 fw-bold text-gray-800 d-block">Rp. {{ Number::format($optionOne['amount'], 0, 0, 'id') }}</span>
                                        <table style="width: 100%">
                                            <tr class="text-muted">
                                                <td>{{ $optionOne['payment_text'] }}</td>
                                                <td class="text-end">{{ Number::format($optionOne['payment_amount'], 0, 0, 'id') }}</td>
                                            </tr>
                                            @if($optionOne['distribution_amount'] > 0)
                                                <tr class="text-muted">
                                                    <td>{{ $optionOne['distribution_name'] }}</td>
                                                    <td class="text-end">{{ Number::format($optionOne['distribution_amount'], 0, 0, 'id') }}</td>
                                                </tr>
                                            @endif
                                        </table>
                                    </span>
                                </label>
                            @endif

                            @if($optionTwo['status'])
                                <label class="btn btn-outline btn-outline-dashed border-primary btn-active-light-primary d-flex text-start p-6 mb-5 @if($selectedOption == 2) active @endif">
                                    <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                        <input wire:model.live="selectedOption" class="form-check-input" type="radio" name="discount_option" value="2">
                                    </span>
                                    <span class="ms-5 w-100">
                                        <span class="fs-4 fw-bold text-gray-800 d-block">Rp. {{ Number::format($optionTwo['amount'], 0, 0, 'id') }}</span>
                                        <table style="width: 100%">
                                            <tr class="text-muted">
                                                <td>{{ $optionTwo['payment_text'] }}</td>
                                                <td class="text-end">{{ Number::format($optionTwo['payment_amount'], 0, 0, 'id') }}</td>
                                            </tr>
                                            @if($optionTwo['distribution_amount'] > 0)
                                                <tr class="text-muted">
                                                    <td>{{ $optionTwo['distribution_name'] }}</td>
                                                    <td class="text-end">{{ Number::format($optionTwo['distribution_amount'], 0, 0, 'id') }}</td>
                                                </tr>
                                            @endif
                                        </table>
                                    </span>
                                </label>
                            @endif

                            @if($optionThree['status'])
                                <label class="btn btn-outline btn-outline-dashed border-primary btn-active-light-primary d-flex text-start p-6 mb-5 @if($selectedOption == 3) active @endif">
                                    <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                        <input wire:model.live="selectedOption" class="form-check-input" type="radio" name="discount_option" value="3">
                                    </span>
                                    <span class="ms-5 w-100">
                                        <span class="fs-4 fw-bold text-gray-800 d-block">Rp. {{ Number::format($optionThree['amount'], 0, 0, 'id') }}</span>
                                        <table style="width: 100%">
                                            <tr class="text-muted">
                                                <td>{{ $optionThree['payment_text'] }}</td>
                                                <td class="text-end">{{ Number::format($optionThree['payment_amount'], 0, 0, 'id') }}</td>
                                            </tr>
                                            @if($optionThree['distribution_amount'] > 0)
                                                <tr class="text-muted">
                                                    <td>{{ $optionThree['distribution_name'] }}</td>
                                                    <td class="text-end">{{ Number::format($optionThree['distribution_amount'], 0, 0, 'id') }}</td>
                                                </tr>
                                            @endif
                                        </table>
                                    </span>
                                </label>
                            @endif
                        </div>
                        @endif
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
