<x-default-layout>

    @section('title')
        User
    @endsection

    @section('button')
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <button type="button" class="btn btn-light-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                    <i class="ki-outline ki-plus-square fs-3"></i>
                    Tambah User
                </button>
            </div>
        </div>
    @endsection

    <div class="card">
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
                <livewire:user-management.user.index lazy />
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>

    <livewire:user-management.user.create />

    @push('scripts')
        <script>
            document.addEventListener('livewire:init', function () {
                Livewire.on('success', function () {
                    $('#kt_modal_add_user').modal('hide');
                });
            });

            // Add click event listener to delete buttons
            const destroyUser = id => {
                Swal.fire({
                    text: 'Are you sure you want to remove?',
                    icon: 'warning',
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-secondary',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('delete_user', [id]);
                    }
                });
            }

            const editUser = id => {
                Livewire.dispatch('update_user', [id]);
                $('#kt_modal_add_user').modal('show');
            }

            let modal = document.getElementById('kt_modal_add_user')
            modal.addEventListener('hidden.bs.modal', function (event) {
                Livewire.dispatch('reset');
            })
        </script>
    @endpush

</x-default-layout>
