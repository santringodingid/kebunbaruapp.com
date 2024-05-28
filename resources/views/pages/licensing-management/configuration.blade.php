<x-default-layout>

    @section('title')
        Pengaturan Perizinan
    @endsection

    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
        <div class="col-12 col-sm-5 mb-5 mb-xl-10">
            @if ($success = Session::get('success'))
                <div class="alert alert-dismissible bg-light-success d-flex flex-column flex-sm-row p-5 mb-10">
                    <!--begin::Icon-->
                    <i class="ki-duotone ki-notification-bing fs-2hx text-success me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    <!--end::Icon-->

                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <!--begin::Title-->
                        <h4 class="fw-semibold text-success-emphasis ">Yeaahh... Proses berhasil</h4>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <span>
                            {{ $success }}
                        </span>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Close-->
                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                        <i class="ki-duotone ki-cross fs-1 text-primary"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                    <!--end::Close-->
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Tanda Tangan</h5>
                </div>
                <div class="card-body">
                    <form id="form-add-configuration" action="{{ route('licensing-management.configuration-store') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="mb-6">
                            <label for="exampleFormControlInput1" class="form-label">Nama Keamanan</label>
                            <input type="text" name="kamtib" class="form-control text-uppercase @error('kamtib') is-invalid @enderror" autofocus value="{{ $config?->kamtib ?? '' }}" />
                            @error('kamtib')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="exampleFormControlInput1" class="form-label">Nama Kesehatan</label>
                            <input type="text" name="health" class="form-control text-uppercase @error('health') is-invalid @enderror" autofocus value="{{ $config?->health ?? '' }}" />
                            @error('health')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="exampleFormControlInput1" class="form-label">Nama Taklimiyah</label>
                            <input type="text" name="guardian" class="form-control text-uppercase @error('guardian') is-invalid @enderror" autofocus value="{{ $config?->guardian ?? '' }}" />
                            @error('guardian')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="exampleFormControlInput1" class="form-label">Nama Kabid</label>
                            <input type="text" name="kabid" class="form-control text-uppercase @error('kabid') is-invalid @enderror" value="{{ $config?->kabid ?? '' }}" />
                            @error('kabid')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama Pengasuh</label>
                            <input type="text" name="chief" class="form-control text-uppercase @error('chief') is-invalid @enderror" value="{{ $config?->chief ?? '' }}" />
                            @error('chief')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="mb-2">
                        <button type="button" class="btn btn-primary" onclick="storeConfiguration()">Simpan perubahan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-7 mb-5 mb-xl-10">
            <div class="card">
                <livewire:licensing-management.reason.create />
                <div class="separator"></div>
                <div class="card-body py-3">
                    <livewire:licensing-management.reason.index lazy />
                </div>
            </div>
        </div>
    </div>
    <!--end::Row-->

    @push('scripts')
        <script>
            document.addEventListener('livewire:init', function () {
                Livewire.on('success-created', function (message) {
                    Swal.fire({
                        text: message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: 'OK!',
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                });
            });

            const submit = () => {
                Swal.fire({
                    title: "Yakin, nih?",
                    text: "Pastikan alasan sudah diisi",
                    icon: "warning",
                    showCancelButton: true,
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-danger"
                    },
                    confirmButtonText: "Yakin, dong",
                    cancelButtonText: "Nggak jadi"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('store');
                    }
                });
            }

            const storeConfiguration = () => {
                Swal.fire({
                    title: "Yakin, nih?",
                    text: "Pastikan semua bidang sudah diisi",
                    icon: "warning",
                    showCancelButton: true,
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-danger"
                    },
                    confirmButtonText: "Yakin, dong",
                    cancelButtonText: "Nggak jadi"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-add-configuration').submit()
                    }
                });
            }
        </script>
    @endpush
</x-default-layout>
