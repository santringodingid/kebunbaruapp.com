<x-default-layout>
    @section('title')
        Beranda
    @endsection
        <div class="row mt-5">
            <div class="col-12 col-sm-7 mb-5 mb-sm-0">
                <div class="card border-transparent py-20 px-8" data-bs-theme="light" style="background-color: #1C325E;">
                    <!--begin::Body-->
                    <div class="card-body d-flex ps-xl-15">
                        <!--begin::Wrapper-->
                        <div class="m-0">
                            <div class="fs-2 text-white">
                                <span class="">
                                    Selamat datang,
                                    <span class="text-danger">
                                        {{ $data['name'] }}
                                    </span>
                                </span>
                                <br>Semoga harimu makin baik makin asyik...
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <div class="col-12 col-sm-5">
                <!--begin::Slider Widget 1-->
                <div id="kt_sliders_widget_1_slider" class="card card-flush carousel carousel-custom carousel-stretch slide h-xl-100" data-bs-ride="carousel" data-bs-interval="5000">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <h4 class="card-title d-flex align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Data Statistik</span>
                        </h4>
                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Carousel Indicators-->
                            <ol class="p-0 m-0 carousel-indicators carousel-indicators-bullet carousel-indicators-active-primary">
                                <li data-bs-target="#kt_sliders_widget_1_slider" data-bs-slide-to="0" class="ms-1 active" aria-current="true"></li>
                                <li data-bs-target="#kt_sliders_widget_1_slider" data-bs-slide-to="1" class="ms-1"></li>
                                <li data-bs-target="#kt_sliders_widget_1_slider" data-bs-slide-to="2" class="ms-1"></li>
                            </ol>
                            <!--end::Carousel Indicators-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-6">
                        <!--begin::Carousel-->
                        <div class="carousel-inner mt-n5">
                            <!--begin::Item-->
                            <div class="carousel-item show active">
                                <h4 class="fw-bold text-gray-800 mb-3">Santri Baru</h4>
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center mb-5">
                                    <!--begin::Info-->
                                    <div class="m-0">
                                        <span>Under maintenance</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="carousel-item">
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center mb-5">
                                    <!--begin::Info-->
                                    <div class="m-0">
                                        <!--begin::Subtitle-->
                                        <h4 class="fw-bold text-gray-800 mb-3">Santri Boyong</h4>
                                        <!--end::Subtitle-->
                                        <!--begin::Items-->
                                        <div class="m-0">
                                            <span>Under maintenance</span>
                                        </div>
                                        <!--end::Items-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="carousel-item">
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center mb-5">
                                    <!--begin::Info-->
                                    <div class="m-0">
                                        <!--begin::Subtitle-->
                                        <h4 class="fw-bold text-gray-800 mb-3">Murid Baru</h4>
                                        <!--end::Subtitle-->
                                        <div class="m-0">
                                            <span>Under maintenance</span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Carousel-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Slider Widget 1-->
            </div>
        </div>
</x-default-layout>
