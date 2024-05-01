<x-default-layout>

    @section('title')
        Tahun Periode
    @endsection

    @section('button')
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <button type="button" class="btn btn-light-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-period">
                    <i class="ki-outline ki-plus-square fs-3"></i>
                    Tambah Instansi
                </button>
            </div>
        </div>
    @endsection

    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
        <!--begin::Col-->
        <div class="col-12 mb-5 mb-xl-10">
            <livewire:setting-management.period.index lazy />
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <livewire:setting-management.period.create />

    @push('scripts')
            <script>
                Inputmask({
                    "mask" : "9999-9999"
                }).mask(".period");

                document.addEventListener('livewire:init', function () {
                    Livewire.on('success', function () {
                        $('#modal-add-period').modal('hide');
                    });
                });
            </script>
    @endpush
</x-default-layout>
