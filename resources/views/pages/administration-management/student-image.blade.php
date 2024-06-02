<x-default-layout>

    @section('title')
        Foto Santri
    @endsection

    @section('button')
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-student-image">
                    <i class="ki-outline ki-plus-square fs-3"></i>
                    Upload Foto
                </button>
            </div>
        </div>
    @endsection
    <div>
        <livewire:administration-management.student-image.index lazy />
    </div>
    <livewire:administration-management.student-image.create />

    @push('scripts')
        <script>
            document.addEventListener('livewire:init', function () {
                Livewire.on('success-created', function (message) {
                    $('#modal-add-student-image').modal('hide')
                    Swal.fire({
                        text: message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: 'OK!',
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                });
            });

            const reset = () => {
                $('#modal-add-student-image').modal('hide')
                Livewire.dispatch('reset');
            }
        </script>
    @endpush
</x-default-layout>
