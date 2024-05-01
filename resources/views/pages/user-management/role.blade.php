<x-default-layout>

    @section('title')
        Role
    @endsection

    @section('button')
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <button type="button" class="btn btn-light-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">
                    <i class="ki-outline ki-plus-square fs-3"></i>
                    Tambah Role
                </button>
            </div>
        </div>
    @endsection
    <div>
        <livewire:user-management.role.index lazy />
    </div>

    <livewire:user-management.role.create />

</x-default-layout>
