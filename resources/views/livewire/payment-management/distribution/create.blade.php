<div class="modal fade" tabindex="-1" id="modal-add-distribution" data-bs-backdrop="static" data-bs-keyboard="false" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Distribusi Pengurangan</h3>

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
                                            <ul>
                                                <li>Pastikan kamu sudah melakukan verifikasi sebelumnya</li>
                                                <li>Pastikan kelas, tingkat, dan data registrasi lainnya sudah valid dan aktual</li>
                                                <li>Jika santri satu wali antar status domisili, maka distribusi pengurangan di bagian LP2K</li>
                                                <li>Jika santri satu wali antar jenis (gender), maka distribusi pengurangan di bagian putri</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <div class="row mb-5">
                                <label for="reduction" class="col-sm-4 col-form-label">Pengurangan</label>
                                <div class="col-sm-8">
                                    <select wire:model="reduction" class="form-control @error('reduction') is-invalid @enderror" id="reduction">
                                        <option value="">.:Pilih Pengurangan:.</option>
                                        @if($reductions)
                                            @foreach($reductions as $reduction)
                                                <option value="{{ $reduction->id }}">{{ $reduction->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('reduction')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="note" class="col-sm-4 col-form-label">Keterangan</label>
                                <div class="col-sm-8">
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
