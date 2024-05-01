<x-default-layout>

    @section('title')
        Upload Asset
    @endsection

    <div class="row g-5 g-xl-10">
        <div class="col-sm-6 mb-5 mb-xl-10">

            <!--begin::Alert-->
            @if ($errors->has('images'))
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
                            {{ $errors->first('images') }}
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
                        <span class="fs-3 fw-bold me-2">Upload Image Atribut</span>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <form method="post" enctype="multipart/form-data" action="{{ route('setting-management.asset') }}">
                    <div class="card-body pt-1 px-0 pb-0 mb-5">
                        <div class="px-10">
                            @csrf
                            <input type="file" name="images[]" class="form-control" required multiple>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
                <!--end::Body-->
            </div>
            <!--end::Card widget 1-->
        </div>
        <!--end::Col-->
    </div>
</x-default-layout>
