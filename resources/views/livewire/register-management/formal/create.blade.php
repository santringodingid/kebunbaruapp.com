<div class="modal fade" tabindex="-1" id="modal-add-formal" data-bs-backdrop="static" data-bs-keyboard="false" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Registrasi Formal</h3>

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
                        <div class="col-sm-6 row">
                            <div class="col-12 row">
                                <label for="studentId" class="col-sm-4 col-form-label">ID Santri/Murid <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" wire:model="studentId" class="form-control text-uppercase mask-id" id="studentId">
                                </div>
                            </div>
                            <div class="col-12 row">
                                <div class="col-4 text-center">
                                    @if(file_exists('storage/'.$image))
                                        <img src="{{ asset('storage/'.$image) }}" alt="" class="w-100 rounded">
                                    @else
                                        <img src="{{ asset('storage/assets/spinner.gif') }}" alt="" class="w-10 rounded py-5 py-sm-20 my-4" loading="lazy">
                                    @endif
                                </div>
                                <div class="col-8">
                                    <input type="text" wire:model="name" disabled class="form-control text-uppercase mb-5">
                                    <textarea type="text" wire:model="address" disabled class="form-control mb-5"></textarea>
                                    <input type="text" wire:model="domicile" disabled class="form-control mb-5">
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
                                            Data diniyah mengacu pada registrasi terakhir. <br>
                                            Kamu bisa ubah sesuai kebutuhan...
                                        </div>
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <div class="row mb-5">
                                <label for="" class="col-sm-4 col-form-label">Kelas Diniyah</label>
                                <div class="col-sm-2">
                                    <select wire:model="grade" class="form-control @error('grade') is-invalid @enderror" id="last-education">
                                        <option value="">.:Kelas:.</option>
                                        @for ($i = 0; $i < 8; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                        <option value="Lulus">Lulus</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select wire:model="institution" class="form-control @error('institution') is-invalid @enderror" id="institution" wire:ignore>
                                        <option value="">.:Pilih Tingkat:.</option>
                                        @if($institutions)
                                            @foreach($institutions as $institution)
                                                <option value="{{ $institution->id }}">{{ $institution->name }}</option>
                                            @endforeach
                                            <option value="22">Tidak sekolah/Lembaga Non Kebun Baru</option>
                                        @endif
                                    </select>
                                    @error('institution')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="isNew" class="col-sm-4 col-form-label">Status</label>
                                <div class="col-sm-8">
                                    <div class="d-flex gap-8 mt-3">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" wire:model="isNew" value="1" id="true" name="isNew"/>
                                            <label class="form-check-label" for="true">
                                                Baru
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" wire:model="isNew" value="0" id="false" name="isNew"/>
                                            <label class="form-check-label" for="false">
                                                Lama
                                            </label>
                                        </div>
                                    </div>
                                    @error('isNew')
                                    <small class="text-danger mt-2 d-block">
                                        {{ $message }}
                                    </small>
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
