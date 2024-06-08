<x-default-layout>
    @section('title')
        Distribusi Pengurangan
    @endsection

    @section('button')
        @can('read payment management')
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-distribution">
                        <i class="ki-outline ki-plus-square fs-3"></i>
                        Tambah Distribusi
                    </button>
                </div>
            </div>
        @endcan
    @endsection

    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
        <!--begin::Col-->
        <div class="col-12 mb-5 mb-xl-10">
            <livewire:payment-management.distribution.index lazy />
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <livewire:payment-management.distribution.create />

    @push('scripts')
        <script>
            document.addEventListener('livewire:init', function () {
                Livewire.on('success-created', function (message) {
                    $('#modal-add-distribution').modal('hide');
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
                Swal.fire({
                    title: "Yakin, nih?",
                    text: "Semua bidang inputan akan direset, lho..",
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
                        $('#modal-add-distribution').modal('hide');
                        Livewire.dispatch('reset');
                    }
                });
            }

            const submit = () => {
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

            const destroy = id => {
                Swal.fire({
                    title: "Yakin, nih?",
                    text: "Distribusi yang dihapus tidak berpengaruh pada pengurangan pembayaran yang bersangkutan sebelumnya",
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
                        Livewire.dispatch('destroy', [id]);
                    }
                });
            }
        </script>
    @endpush
</x-default-layout>
