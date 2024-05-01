<div class="modal fade" tabindex="-1" id="modal-add-student" data-bs-backdrop="static" data-bs-keyboard="false" wire:ignore.self>
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrasi Santri/Murid</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" onclick="reset()">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <form wire:submit="store" autocomplete="off" onkeydown="return event.key != 'Enter';">
                <div class="modal-body overflow-y-scroll">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-5 p-6">
                                <!--begin::Icon-->
                                <span class="ki-duotone ki-information fs-2tx text-warning me-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
                                <!--end::Icon-->
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-grow-1">
                                    <!--begin::Content-->
                                    <div class="fw-semibold">
                                        <div class="fs-6 text-gray-700">
                                            <strong class="me-1">Warning!</strong>
                                            Data domisili, diniyah dan formal otomatis ditambahkan ke data registrasi masing-masing jika mode tambah (bukan edit).
                                        </div>
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <div class="mb-5 row">
                                <label for="guardianId" class="col-sm-4 col-form-label">ID Wali<span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" wire:model="guardianId" class="form-control text-uppercase @error('guardianId') is-invalid @enderror mask-id" id="guardianId">
                                    @error('guardianId')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-5">
                                <label for="guardianRelationship" class="col-sm-4 col-form-label">Hubungan Perwalian</label>
                                <div class="col-sm-8">
                                    <select wire:model="guardianRelationship" class="form-control @error('guardianRelationship') is-invalid @enderror" id="guardianRelationship">
                                        <option>.:Pilih Hubungan:.</option>
                                        <option value="Orang Tua Kandung">Orang Tua Kandung</option>
                                        <option value="Kakek/Nenek">Kakek/Nenek</option>
                                        <option value="Paman/Bibi">Paman/Bibi</option>
                                        <option value="Saudara Kandung">Saudara Kandung</option>
                                        <option value="Orang Tua Tiri">Orang Tua Tiri</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                    @error('guardianRelationship')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="kk" class="col-sm-4 col-form-label">NO. KK <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" wire:model="kk" class="form-control text-uppercase @error('kk') is-invalid @enderror mask" id="kk">
                                    @error('kk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
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
                                <label for="place-of-birth" class="col-sm-4 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-8">
                                    <input type="text" wire:model="placeOfBirth" class="form-control text-capitalize @error('placeOfBirth') is-invalid @enderror" id="place-of-birth">
                                    @error('placeOfBirth')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="date-of-birth" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-8">
                                    <input type="text" wire:model="dateOfBirth" class="form-control mask-date text-uppercase @error('dateOfBirth') is-invalid @enderror" id="date-of-birth">
                                    @error('dateOfBirth')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-5">
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
                        </div>
                        <div class="col-sm-4">
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
                            <div class="row mb-5">
                                <label for="" class="col-sm-4 col-form-label">Domisili</label>
                                <div class="col-sm-2">
                                    <select wire:model="domicileNumber" class="form-control @error('domicileNumber') is-invalid @enderror" id="last-education">
                                        <option>.:No:.</option>
                                        @for ($i = 1; $i < 11; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select wire:model="domicile" class="form-control @error('domicile') is-invalid @enderror" id="domicile">
                                        <option>.:Pilih Domisili:.</option>
                                        @if($domiciles)
                                            @foreach($domiciles as $domicile)
                                                <option value="{{ $domicile->name }}">{{ $domicile->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('domicile')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            @if(!$editMode)
                            <div class="mb-5 row">
                                <label for="isNewDomicile" class="col-sm-4 col-form-label">Status Masuk Domisili</label>
                                <div class="col-sm-8">
                                    <div class="d-flex gap-8 mt-3">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" wire:model="isNewDomicile" value="1" id="true" name="isNewDomicile"/>
                                            <label class="form-check-label" for="true">
                                                Baru
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" wire:model="isNewDomicile" value="0" id="false" name="isNewDomicile"/>
                                            <label class="form-check-label" for="false">
                                                Lama
                                            </label>
                                        </div>
                                    </div>
                                    @error('isNewDomicile')
                                    <small class="text-danger mt-2 d-block">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            @endif
                            <div class="row mb-5">
                                <label for="diniyah" class="col-sm-4 col-form-label">Rencana Diniyah</label>
                                <div class="col-sm-2">
                                    <select wire:model="gradeOfDiniyah" class="form-control @error('gradeOfDiniyah') is-invalid @enderror" id="diniyah">
                                        <option>.:Kelas:.</option>
                                        @for ($i = 0; $i < 7; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                        <option value="RA">RA</option>
                                        <option value="TPQ">TPQ</option>
                                        <option value="Jilid">Jilid</option>
                                        <option value="Takhossus">Takhossus</option>
                                        <option value="Lulus">Lulus</option>
                                    </select>
                                    @error('gradeOfDiniyah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <select wire:model="institutionOfDiniyah" class="form-control @error('institutionOfDiniyah') is-invalid @enderror" id="last-education">
                                        <option>.:Pilih Tingkat:.</option>
                                        @if($diniyahs)
                                            @foreach($diniyahs as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                        <option value="22">Tidak sekolah/Lembaga Non Kebun Baru</option>
                                    </select>
                                    @error('institutionOfDiniyah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            @if(!$editMode)
                            <div class="mb-5 row">
                                <label for="isNewDiniyah" class="col-sm-4 col-form-label">Status Masuk Diniyah</label>
                                <div class="col-sm-8">
                                    <div class="d-flex gap-8 mt-3">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" wire:model="isNewDiniyah" value="1" id="isNewDiniyahTrue" name="isNewDiniyah"/>
                                            <label class="form-check-label" for="isNewDiniyahTrue">
                                                Baru
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" wire:model="isNewDiniyah" value="0" id="isNewDiniyahFalse" name="isNewDiniyah"/>
                                            <label class="form-check-label" for="isNewDiniyahFalse">
                                                Lama
                                            </label>
                                        </div>
                                    </div>
                                    @error('isNewDiniyah')
                                    <small class="text-danger mt-2 d-block">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            @endif
                            <div class="row mb-5">
                                <label for="gradeOfFormal" class="col-sm-4 col-form-label">Rencana Formal</label>
                                <div class="col-sm-2">
                                    <select wire:model="gradeOfFormal" class="form-control @error('gradeOfFormal') is-invalid @enderror" id="gradeOfFormal">
                                        <option value="">.:Kelas:.</option>
                                        @for ($i = 0; $i < 8; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                        <option value="Lulus">Lulus</option>
                                    </select>
                                    @error('gradeOfFormal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <select wire:model="institutionOfFormal" class="form-control @error('institutionOfFormal') is-invalid @enderror">
                                        <option>.:Pilih Tingkat:.</option>
                                        @if($formals)
                                            @foreach($formals as $formal)
                                                <option value="{{ $formal->id }}">{{ $formal->name }}</option>
                                            @endforeach
                                        @endif
                                        <option value="22">Tidak sekolah/Lembaga Non Kebun Baru</option>
                                    </select>
                                    @error('institutionOfFormal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            @if(!$editMode)
                            <div class="mb-5 row">
                                <label for="isNewFormal" class="col-sm-4 col-form-label">Status Masuk Formal</label>
                                <div class="col-sm-8">
                                    <div class="d-flex gap-8 mt-3">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" wire:model="isNewFormal" value="1" id="isNewFormalTrue" name="isNewFormal"/>
                                            <label class="form-check-label" for="isNewFormalTrue">
                                                Baru
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" wire:model="isNewFormal" value="0" id="isNewFormalFalse" name="isNewFormal"/>
                                            <label class="form-check-label" for="isNewFormalFalse">
                                                Lama
                                            </label>
                                        </div>
                                    </div>
                                    @error('isNewFormal')
                                    <small class="text-danger mt-2 d-block">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            @endif
                            <div class="mb-5 row">
                                <label for="father" class="col-sm-4 col-form-label">Nama Ayah</label>
                                <div class="col-sm-8">
                                    <input type="text" wire:model="father" class="form-control text-uppercase @error('father') is-invalid @enderror" id="father">
                                    @error('father')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <label for="mother" class="col-sm-4 col-form-label">Nama Ibu</label>
                                <div class="col-sm-8">
                                    <input type="text" wire:model="mother" class="form-control text-uppercase @error('mother') is-invalid @enderror" id="mother">
                                    @error('mother')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-5 row">
                                <label for="address" class="col-sm-4 col-form-label">Opsi Alamat</label>
                                <div class="col-sm-8">
                                    <div class="form-check form-switch mt-sm-4">
                                        <input class="form-check-input" type="checkbox" wire:model.live="switchAddress" value="1" id="flexSwitchDefault"/>
                                        <label class="form-check-label" for="flexSwitchDefault">
                                            Swicth On jika sama dengan wali
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if(!$switchAddress)
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
                                    <livewire:select-option wire:ignore wire:model.live="selectedRegion" name="region" id="region" label="Pinpoint otomatis" text="desa" parent="modal-add-student" :options="$regions" :key="$regions?->pluck('id')->join('-')" />
                                @endif
                                @if(is_null($selectedRegion))
                                    <livewire:select-option wire:model.live="selectedProvince" name="province" label="Pinpoint Manual" text="provinsi" parent="modal-add-student" :options="$provinces" :key="$provinces?->pluck('id')->join('-')" />
                                @endif
                                @if(!is_null($selectedProvince))
                                    <livewire:select-option wire:model.live="selectedCity" name="city" label="" text="kabupaten/kota" parent="modal-add-student" :options="$cities" :key="$cities?->pluck('id')->join('-')" />
                                @endif
                                @if(!is_null($selectedCity))
                                    <livewire:select-option wire:model.live="selectedDistrict" name="district" label="" text="kecamatan" parent="modal-add-student" :options="$districts" :key="$districts?->pluck('id')->join('-')" />
                                @endif
                                @if(!is_null($selectedDistrict))
                                    <livewire:select-option wire:model="selectedVillage" name="village" label="" text="desa/kelurahan" parent="modal-add-student" :options="$villages" :key="$villages?->pluck('id')->join('-')" />
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer" style="position: absolute; width: 100%; bottom: 0">
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
