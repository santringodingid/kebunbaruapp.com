<div class="modal fade" tabindex="-1" id="kt_modal_3" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content position-absolute">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Instansi</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <form wire:submit="store" autocomplete="off">
                <div class="modal-body">
                    <div class="mb-5 row">
                        <label for="code" class="col-sm-4 col-form-label">Kode</label>
                        <div class="col-sm-8">
                            <input type="text" wire:model="code" class="form-control @error('code') is-invalid @enderror" id="code">
                            @error('code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-5 row">
                        <label for="name" class="col-sm-4 col-form-label">Nama</label>
                        <div class="col-sm-8">
                            <input type="text" wire:model="name" class="form-control text-capitalize @error('name') is-invalid @enderror" id="name">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-5 row">
                        <label for="commission" class="col-sm-4 col-form-label">Komisi</label>
                        <div class="col-sm-8">
                            <select class="form-select @error('name') is-invalid @enderror" wire:model="commission" id="commission">
                                <option>.:Pilih Komisi:.</option>
                                <option value="UMUM">UMUM</option>
                                <option value="BIDANG MAKHADIYAH PUTRA">BIDANG MAKHADIYAH PUTRA</option>
                                <option value="BIDANG MAKHADIYAH PUTRI">BIDANG MAKHADIYAH PUTRI</option>
                                <option value="BIDANG MADRASIYAH">BIDANG MADRASIYAH</option>
                                <option value="BIDANG EKONOMI">BIDANG EKONOMI</option>
                                <option value="BIDANG SARANA DAN PRASARANA">BIDANG SARANA DAN PRASARANA</option>
                                <option value="BIDANG DAKWAH DAN KEMASYARAKATAN">BIDANG DAKWAH DAN KEMASYARAKATAN</option>
                                <option value="BIDANG KESENIAN">BIDANG KESENIAN</option>
                                <option value="KHUSUS">KHUSUS</option>
                            </select>
                            @error('commission')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-5 row">
                        <label for="gender-access" class="col-sm-4 col-form-label">Akses Jenis Kelamin</label>
                        <div class="col-sm-8">
                            <div class="d-flex gap-8 mt-3">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" wire:model="gender_access" value="2" id="general" name="gender_access"/>
                                    <label class="form-check-label" for="general">
                                        Umum
                                    </label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" wire:model="gender_access" value="0" id="male" name="gender_access"/>
                                    <label class="form-check-label" for="male">
                                        Putra
                                    </label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" wire:model="gender_access" value="1" id="female" name="gender_access"/>
                                    <label class="form-check-label" for="female">
                                        Putri
                                    </label>
                                </div>
                            </div>
                            @error('gender_access')
                            <small class="text-danger mt-2 d-block">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-5 row">
                        <label for="gender-access" class="col-sm-4 col-form-label">Akses Status</label>
                        <div class="col-sm-8">
                            <div class="d-flex gap-8 mt-3">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" wire:model="status_access" value="0" id="general_status" name="status_access"/>
                                    <label class="form-check-label" for="general_status">
                                        Umum
                                    </label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" wire:model="status_access" value="1" id="diniyah" name="status_access"/>
                                    <label class="form-check-label" for="diniyah">
                                        Diniyah
                                    </label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" wire:model="status_access" value="2" id="ammiyah" name="status_access"/>
                                    <label class="form-check-label" for="ammiyah">
                                        Ammiyah
                                    </label>
                                </div>
                            </div>
                            @error('status_access')
                            <small class="text-danger mt-2 d-block">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-5 row">
                        <label for="status" class="col-sm-4 col-form-label">Status Instansi</label>
                        <div class="col-sm-8">
                            <div class="d-flex gap-8 mt-3">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" wire:model="status" value="0" id="education_institution" name="status"/>
                                    <label class="form-check-label" for="education_institution">
                                        Instansi Pendidikan
                                    </label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" wire:model="status" value="1" id="other_institution" name="status"/>
                                    <label class="form-check-label" for="other_institution">
                                        Instansi Lainnya
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
