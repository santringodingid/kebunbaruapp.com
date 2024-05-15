<x-default-layout>

    @section('title')
        Profil Akun
    @endsection

    <div>
        <!--begin::Row-->
        <div class="separator mb-10"></div>
        <div class="row gx-5 gx-xl-10">
            <!--begin::Col-->
            <div class="col-12 col-sm-5 mb-5 mb-xl-10">
                <h4>Profil</h4>
                Nama dan instansi merupakan akses administrator.
                <br>
                Kamu tidak bisa sunting data.
            </div>
            <!--end::Col-->
            <div class="col-12 col-sm-7 mb-5 mb-xl-10">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-6">
                            <label for="exampleFormControlInput1" class="form-label">Nama lengkap</label>
                            <input type="text" class="form-control" value="{{ $data['name'] }}" disabled />
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Instansi</label>
                            <input type="text" class="form-control" value="{{ $data['institution'] }}" disabled />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Row-->
    </div>

    <div>
        <!--begin::Row-->
        <div class="separator mb-10"></div>
        <div class="row gx-5 gx-xl-10">
            <!--begin::Col-->
            <div class="col-12 col-sm-5 mb-5 mb-xl-10">
                <h4>Username/Email</h4>
                Seperti yang kamu tahu, akses aplikasi ini butuh autentikasi. Kamu harus memasukkan email atau username berikut password.
                <br><br>
                Kamu bebas ubah email atau username sesukamu. Aturan membuat username:
                <ul>
                    <li>Hanya boleh gabungan huruf dan angka</li>
                    <li>Jumlah karakter maksimal 25</li>
                </ul>
            </div>
            <!--end::Col-->
            <div class="col-12 col-sm-7 mb-5 mb-xl-10">
                <div class="card">
                    <div class="card-body">
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
                        <form action="{{ route('change-email') }}" method="post" autocomplete="off" id="form-change-email-username">
                            @csrf
                            <div class="mb-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ $data['email'] }}" name="email" id="email" />
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" value="{{ $data['username'] }}" name="username" id="username" />
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-8">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password_email') is-invalid @enderror" placeholder="Masukkan password" name="password_email" id="password" />
                                @error('password_email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </form>
                        <div class="mb-2">
                            <button type="button" class="btn btn-primary" onclick="submitChangeEmailUsername()">Simpan perubahan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Row-->
    </div>

        <div>
            <!--begin::Row-->
            <div class="separator mb-10"></div>
            <div class="row gx-5 gx-xl-10">
                <!--begin::Col-->
                <div class="col-12 col-sm-5 mb-5 mb-xl-10">
                    <h4>Password</h4>
                    Untuk keamanan yang lebih baik, sebaiknya kamu perbarui password secara periodik; per minggu, per bulan. Kamu bebas memilih. Aturan membuat password:
                    <ul>
                        <li>Minimal delapan karakter</li>
                        <li>Usahakan gabungan huruf, angka, dan karakter lainnya</li>
                    </ul>
                </div>
                <!--end::Col-->
                <div class="col-12 col-sm-7 mb-5 mb-xl-10">
                    <div class="card">
                        <div class="card-body">
                            @if ($success = Session::get('success-password'))
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
                            <form action="{{ route('change-password') }}" method="post" autocomplete="off" id="form-change-password">
                                @csrf
                                <div class="mb-6">
                                    <label for="change-password" class="form-label">Password baru</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="change-password" />
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-6">
                                    <label for="change-password-confirmation" class="form-label">Ulangi password baru</label>
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="change-password-confirmation" />
                                    @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-8">
                                    <label for="current-password" class="form-label">Password lama</label>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" id="current-password" />
                                    @error('current_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </form>
                            <div class="mb-2">
                                <button type="button" class="btn btn-primary" onclick="submitPassword()">Simpan perubahan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>

        @push('scripts')
            <script>
                const submitChangeEmailUsername = () => {
                    Swal.fire({
                        title: "Yakin, nih?",
                        text: "Pastikan email atau username sudah valid",
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
                            $('#form-change-email-username').submit()
                        }
                    });
                }

                const submitPassword = () => {
                    Swal.fire({
                        title: "Yakin, nih?",
                        text: "Pastikan sudah valid",
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
                            $('#form-change-password').submit()
                        }
                    });
                }
            </script>
        @endpush
</x-default-layout>
