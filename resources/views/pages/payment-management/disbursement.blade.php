<x-default-layout>

    @section('title')
        Distribusi Akun
    @endsection

    @section('button')
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <button type="button" class="btn btn-light-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-disbursement">
                    <i class="ki-outline ki-plus-square fs-3"></i>
                    Tambah Distribusi
                </button>
            </div>
        </div>
    @endsection

    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
        <!--begin::Col-->
        <div class="col-12 mb-5 mb-xl-10">
            <livewire:payment-management.disbursement.index lazy />
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <livewire:payment-management.disbursement.create />
</x-default-layout>
