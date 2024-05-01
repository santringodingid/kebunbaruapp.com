<x-default-layout>

    @section('title')
        Tarif Tahfidz
    @endsection

    @section('button')
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <button type="button" class="btn btn-light-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-tahfidz">
                    <i class="ki-outline ki-plus-square fs-3"></i>
                    Tambah Tarif
                </button>
            </div>
        </div>
    @endsection

    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
        <!--begin::Col-->
        <div class="col-12 mb-5 mb-xl-10">
            <livewire:payment-management.tahfidz.index lazy />
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <livewire:payment-management.tahfidz.create />
</x-default-layout>
