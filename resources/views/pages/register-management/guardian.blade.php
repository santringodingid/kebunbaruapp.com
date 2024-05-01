<x-default-layout>

    @section('title')
        Registrasi Wali
    @endsection

    @section('button')
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-guardian">
                    <i class="ki-outline ki-plus-square fs-3"></i>
                    Tambah Wali
                </button>
            </div>
        </div>
    @endsection

    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
        <livewire:register-management.guardian.index lazy= />
    </div>
    <!--end::Row-->

    <livewire:register-management.guardian.create/>
    <livewire:register-management.guardian.show lazy />

    @push('scripts')
        <script>
            document.addEventListener('livewire:init', function () {
                Livewire.on('success_store', function () {
                    $('#modal-add-guardian').modal('hide');
                });
            });

            Inputmask({
                "mask" : "9999999999999999"
            }).mask(".mask");
            Inputmask({
                "mask" : "9999-9999-9999"
            }).mask(".mask-number");

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
                        $('#region').val(0).trigger('change')
                        $('#modal-add-guardian').modal('hide');
                        Livewire.dispatch('reset');
                    }
                });
            }

            const submit = () => {
                Swal.fire({
                    title: "Yakin, nih?",
                    text: "Pastikan semua bidang inputan sudah valid",
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

            const editGuardian = (id, region) => {
                $('#region').val(region).trigger('change')
                Livewire.dispatch('edit_guardian', [id]);
                $('#modal-add-guardian').modal('show');
            }

            const showGuardian = id => {
                Livewire.dispatch('show_guardian', [id]);
                $('#modal-show-guardian').modal('show');
            }
        </script>
    @endpush
</x-default-layout>
