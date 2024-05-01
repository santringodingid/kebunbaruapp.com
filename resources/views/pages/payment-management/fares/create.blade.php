<x-default-layout>
    @section('title')
        Tambah Tarif
    @endsection

    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
        <form method="post" action="{{ route('payment-management.fare.store') }}" onkeydown="return event.key != 'Enter';">
            @csrf
            <div class="row">
            <div class="col-sm-4">
                <div class="mb-10">
                    <label for="diniyah" class="form-label">Kelas</label>
                    <div class="row">
                        <div class="col-4">
                            <select name="grade" class="form-control form-control-sm @error('grade') is-invalid @enderror" id="diniyah">
                                <option value="">.:Kelas:.</option>
                                @for ($i = 1; $i < 7; $i++)
                                    <option value="{{ $i }}" {{ old('grade') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                                <option value="RA" {{ old('grade') == 'RA' ? 'selected' : '' }}>RA</option>
                                <option value="TPQ" {{ old('grade') == 'TPQ' ? 'selected' : '' }}>TPQ</option>
                                <option value="Jilid" {{ old('grade') == 'Jilid' ? 'selected' : '' }}>Jilid</option>
                                <option value="Takhossus" {{ old('grade') == 'Takhossus' ? 'selected' : '' }}>Takhossus</option>
                                <option value="Lulus" {{ old('grade') == 'Lulus' ? 'selected' : '' }}>Lulus</option>
                            </select>
                            @error('grade')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-8">
                            <select name="institution" class="form-control form-control-sm @error('institution') is-invalid @enderror">
                                <option value="">.:Pilih Tingkat:.</option>
                                @if($diniyahs)
                                    @foreach($diniyahs as $item)
                                        <option value="{{ $item->id }}" {{ old('institution') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('institution')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-10">
                    <label for="diniyahCopy" class="form-label">Salin data dari kelas</label>
                    <div class="row">
                        <div class="col-4">
                            <select name="gradeCopy" class="form-control form-control-sm" id="diniyahCopy">
                                <option value="">.:Kelas:.</option>
                                @for ($i = 1; $i < 7; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                                <option value="RA">RA</option>
                                <option value="TPQ">TPQ</option>
                                <option value="Jilid">Jilid</option>
                                <option value="Takhossus">Takhossus</option>
                                <option value="Lulus">Lulus</option>
                            </select>
                        </div>
                        <div class="col-8">
                            <select name="institutionCopy" class="form-control form-control-sm">
                                <option value="">.:Pilih Tingkat:.</option>
                                @if($diniyahs)
                                    @foreach($diniyahs as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-12 mt-8">
                            <!--begin::Alert-->
                            <div class="alert alert-dismissible bg-light-warning d-flex flex-column flex-sm-row p-5 mb-10">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-notification-bing fs-2hx text-warning me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                <!--end::Icon-->

                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                    <!--begin::Title-->
                                    <h4 class="fw-semibold">Perhatian..!</h4>
                                    <!--end::Title-->

                                    <!--begin::Content-->
                                    <span>
                                        Tarif madrasah perlu penyesuaian karena terdapat perbedaan antar kelas/tingkat. <br> <br>
                                        Untuk tarif pesantren dan infaq tidak perlu disesuaikan kecuali untuk <b>Infaq Pembangunan</b> tingkat RA.
                                    </span>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Close-->
                                <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                                    <i class="ki-duotone ki-cross fs-1 text-warning"><span class="path1"></span><span class="path2"></span></i>
                                </button>
                                <!--end::Close-->
                            </div>
                            <!--end::Alert-->
                        </div>
                    </div>
                </div>
            </div>
            @if($schoolFare)
                <div class="col-4">
                    <div class="mb-10">
                        <label class="form-label">Tarif Madrasah</label>
                        @foreach($schoolFare as $sf)
                            <div class="row mb-2">
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" disabled value="{{ $sf->account->name }}">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm nominal" value="{{ $sf->getRawOriginal('nominal') }}" name="school[{{ $sf->account->id }}]">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="col-4">
                @if($infaqFare)
                    <div class="mb-5">
                        <label class="form-label">Tarif Infaq</label>
                        @foreach($infaqFare as $if)
                            <div class="row mb-2">
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" disabled value="{{ $if->account->name }}">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm nominal" value="{{ $if->getRawOriginal('nominal') }}" name="infaq[{{ $if->account->id }}]" @if($loop->last) readonly @endif>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                @if($pesantrenFare)
                    <div class="mb-10">
                        <label class="form-label">Tarif Pesantren</label>
                        @foreach($pesantrenFare as $pf)
                            <div class="row mb-2">
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" disabled value="{{ $pf->account->name }}">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm nominal" value="{{ $pf->getRawOriginal('nominal') }}" name="pesantren[{{ $pf->account->id }}]" @if($loop->last) readonly @endif>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="row">
                    <div class="col-sm-6">
                        <a href="{{ route('payment-management.fare') }}" class="btn btn-danger w-100">Batal</a>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
                    </div>
                </div>
            </div>
            </div>
        </form>
    </div>
        @push('scripts')
            <script>
                new AutoNumeric.multiple('.nominal', {
                    digitGroupSeparator: '.',
                    decimalPlaces: 0,
                    decimalCharacter: ','
                })

                @if(session('success'))
                Swal.fire({
                    text: "{{ session('success') }}",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
                @endif
            </script>
        @endpush
    <!--end::Row-->
</x-default-layout>
