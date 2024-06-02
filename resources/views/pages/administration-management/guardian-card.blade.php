<x-default-layout>

    @section('title')
        Kartu Wali
    @endsection

    @section('button')
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-guardian-card">
                    <i class="ki-outline ki-plus-square fs-3"></i>
                    Buat kartu
                </button>
            </div>
        </div>
    @endsection
    <div>
        <livewire:administration-management.guardian-card.index lazy />
    </div>
    <livewire:administration-management.guardian-card.create />

    @push('scripts')
        <script>
            document.addEventListener('livewire:init', function () {
                Livewire.on('success-created', function (message) {
                    $('#modal-add-guardian-card').modal('hide')
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

            Inputmask({
                "mask" : "99999999"
            }).mask(".mask-id");

            const reset = () => {
                $('#modal-add-guardian-card').modal('hide')
                Livewire.dispatch('reset');
            }

            const submit = (status) => {
                if (status) {
                    Livewire.dispatch('submit');
                    return false;
                }

                Swal.fire({
                    title: "Yakin, nih?",
                    text: "Pastikan semua bidang inputan sudah diisi valid",
                    icon: "warning",
                    showCancelButton: true,
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-danger"
                    },
                    confirmButtonText: "Yakin, dong",
                    cancelButtonText: "Nggak jadi"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('submit');
                    }
                });
            }
        </script>
    @endpush
</x-default-layout>
