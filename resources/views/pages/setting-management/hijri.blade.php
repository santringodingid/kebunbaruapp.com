<x-default-layout>

    @section('title')
        Kalender Hijriah
    @endsection

    <div class="row g-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-sm-6 mb-5 mb-xl-10">
            <!--begin::Card widget 1-->
            <div class="card card-flush border-0 h-lg-100" data-bs-theme="light" style="background-color: #7239EA">
                <!--begin::Header-->
                <div class="card-header pt-2">
                    <!--begin::Title-->
                    <h3 class="card-title">
                        <span class="text-white fs-3 fw-bold me-2">Kalender Hari Ini</span>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="card-body pt-1 px-0 pb-0 mb-5">
                    <!--begin::Wrapper-->
                    <div class="row px-13 mb-5">
                        <!--begin::Stat-->
                        <div class="rounded py-6 px-4 my-1 me-6" style="border: 1px dashed rgba(255, 255, 255, 0.2)">
                            <!--begin::Number-->
                            <div class="d-flex align-items-center">
                                <div class="text-white fs-2 fw-bold counted">
                                    {{ hijriToString($hijri) }}
                                </div>
                            </div>
                            <!--end::Number-->

                            <!--begin::Label-->
                            <div class="fw-semibold fs-6 text-white opacity-50">Hijriah</div>
                            <!--end::Label-->
                        </div>
                        <!--end::Stat-->

                        <!--begin::Stat-->
                        <div class="rounded py-6 px-4 my-1" style="border: 1px dashed rgba(255, 255, 255, 0.2)">
                            <!--begin::Number-->
                            <div class="d-flex align-items-center">
                                <div class="text-white fs-2 fw-bold counted">
                                    {{ dateToString($masehi) }}
                                </div>
                            </div>
                            <!--end::Number-->

                            <!--begin::Label-->
                            <div class="fw-semibold fs-6 text-white opacity-50">Masehi</div>
                            <!--end::Label-->
                        </div>
                        <!--end::Stat-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card widget 1-->
        </div>
        <!--end::Col-->
        <div class="col-sm-6 mb-5 mb-xl-10">

            <!--begin::Alert-->
            @if ($errors->has('file'))
                <div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row p-5 mb-10">
                    <!--begin::Icon-->
                    <i class="ki-duotone ki-notification-bing fs-2hx text-danger me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    <!--end::Icon-->

                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <!--begin::Title-->
                        <h4 class="fw-semibold text-danger-emphasis ">Opps... Ada yang salah, nih!</h4>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <span>
                            {{ $errors->first('file') }}
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
            <!--end::Alert-->
            <!--begin::Card widget 1-->
            <div class="card card-flush border-1 h-lg-100">
                <!--begin::Header-->
                <div class="card-header pt-2">
                    <!--begin::Title-->
                    <h3 class="card-title">
                        <span class="fs-3 fw-bold me-2">Import Data Kalender</span>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <form method="post" enctype="multipart/form-data" action="{{ route('setting-management.hijri') }}">
                    <div class="card-body pt-1 px-0 pb-0 mb-5">
                        <div class="px-10">
                            @csrf
                            <input type="file" name="file" id="file" class="form-control" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Import Data</button>
                    </div>
                </form>
                <!--end::Body-->
            </div>
            <!--end::Card widget 1-->
        </div>
        <!--end::Col-->
    </div>
</x-default-layout>
