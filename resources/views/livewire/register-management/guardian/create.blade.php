<div class="modal fade" tabindex="-1" id="modal-add-guardian" data-bs-backdrop="static" data-bs-keyboard="false" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content position-absolute">
            <div class="modal-header">
                <h5 class="modal-title">Registrasi Wali</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" onclick="reset()">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <form wire:submit="store" autocomplete="off" >
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-5 row">
                                <label for="nik" class="col-sm-4 col-form-label">NIK <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" wire:model="nik" class="form-control text-uppercase @error('nik') is-invalid @enderror mask" id="nik">
                                    @error('nik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="name" class="col-sm-4 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" wire:model="name" class="form-control text-uppercase @error('name') is-invalid @enderror" id="name">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="gender" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-8">
                                    <div class="d-flex gap-8 mt-3">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" wire:model="gender" value="0" id="male" name="gender"/>
                                            <label class="form-check-label" for="male">
                                                Laki-laki
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" wire:model="gender" value="1" id="female" name="gender"/>
                                            <label class="form-check-label" for="female">
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                    @error('gender')
                                    <small class="text-danger mt-2 d-block">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="phone" class="col-sm-4 col-form-label">No. HP <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" wire:model="phone" class="form-control text-uppercase @error('phone') is-invalid @enderror mask-number" id="phone">
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="wa-number" class="col-sm-4 col-form-label">Nomor WA</label>
                                <div class="col-sm-8">
                                    <input type="text" wire:model="waNumber" class="form-control text-uppercase @error('waNumber') is-invalid @enderror mask-number" id="wa-number">
                                    @error('waNumber')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="last-education" class="col-sm-4 col-form-label">Pendidikan Akhir</label>
                                <div class="col-sm-8">
                                    <select wire:model="lastEducation" class="form-control @error('lastEducation') is-invalid @enderror" id="last-education">
                                        <option>.:Pilih Pendidikan Akhir:.</option>
                                        @if($educations)
                                            @foreach($educations as $education)
                                                <option value="{{ $education->name }}">{{ $education->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('lastEducation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <label for="employment" class="col-sm-4 col-form-label">Pekerjaan</label>
                                <div class="col-sm-8">
                                    <select wire:model="employment" class="form-control @error('employment') is-invalid @enderror" id="employment">
                                        <option>.:Pilih Pekerjaan:.</option>
                                        @if($employments)
                                            @foreach($employments as $employment)
                                                <option value="{{ $employment->name }}">{{ $employment->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('employment')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-4 row">
                                <label for="address" class="col-sm-4 col-form-label">Alamat <small class="text-muted">Dusun/Jl.</small></label>
                                <div class="col-sm-8">
                                    <textarea wire:model="address" class="form-control text-capitalize" id="address" rows="4"></textarea>
                                    @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            @if(is_null($selectedProvince))
                            <livewire:select-option wire:ignore wire:model.live="selectedRegion" name="region" id="region" label="Pinpoint otomatis" text="desa" parent="modal-add-guardian" :options="$regions" :key="$regions?->pluck('id')->join('-')" />
                            @endif
                            @if(is_null($selectedRegion))
                            <livewire:select-option wire:model.live="selectedProvince" name="province" label="Pinpoint Manual" text="provinsi" parent="modal-add-guardian" :options="$provinces" :key="$provinces?->pluck('id')->join('-')" />
                            @endif
                            @if(!is_null($selectedProvince))
                                <livewire:select-option wire:model.live="selectedCity" name="city" label="" text="kabupaten/kota" parent="modal-add-guardian" :options="$cities" :key="$cities?->pluck('id')->join('-')" />
                            @endif
                            @if(!is_null($selectedCity))
                                <livewire:select-option wire:model.live="selectedDistrict" name="district" label="" text="kecamatan" parent="modal-add-guardian" :options="$districts" :key="$districts?->pluck('id')->join('-')" />
                            @endif
                            @if(!is_null($selectedDistrict))
                                <livewire:select-option wire:model="selectedVillage" name="village" label="" text="desa/kelurahan" parent="modal-add-guardian" :options="$villages" :key="$villages?->pluck('id')->join('-')" />
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
