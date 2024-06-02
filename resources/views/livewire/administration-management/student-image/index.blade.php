<div>
    <div class="row justify-content-between">
        <div class="col-sm-4 mb-5">
            <input type="text" wire:model.live.debounce="search" placeholder="Masukkan nama/ID..." class="form-control form-control-sm">
        </div>
    </div>
    <div class="row gx-5 gx-xl-6">
        @foreach($students as $student)
            <div class="col-6 col-sm-6 col-xxl-2 mb-6">
                <!--begin::Card widget 14-->
                <div class="card card-flush h-xl-100">
                    <!--begin::Body-->
                    <div class="card-body text-center p-5">
                        <!--begin::Overlay-->
                        @if(file_exists('storage/'.$student->image_of_profile))
                            <img src="{{ asset('storage/'.$student->image_of_profile) }}" alt="" class="w-100 rounded">
                        @else
                            <img src="{{ asset('storage/assets/spinner.gif') }}" alt="" class="w-10 rounded py-20 my-4">
                        @endif

                        <!--end::Overlay-->
                        <!--begin::Info-->
                        <div class="d-flex align-items-end flex-stack mb-1 mt-6">
                            <!--begin::Title-->
                            <div class="text-start">
                                <span class="fw-bold text-gray-800 fs-6 d-block">
                                    {{ \Illuminate\Support\Str::limit($student->name, 13) }}
                                </span>
                                <span class="text-gray-500 mt-1 fw-bold fs-8">
                                    {{ $student->id }}
                                </span>
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card widget 14-->
            </div>
        @endforeach
    </div>
    <div class="row mt-5">
        <div class="col-12">
            {{ $students->links() }}
        </div>
    </div>
</div>