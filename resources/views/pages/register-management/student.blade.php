<x-default-layout>

    @section('title')
        Registrasi Santri/Murid
    @endsection

    @section('button')
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-student">
                    <i class="ki-outline ki-plus-square fs-3"></i>
                    Tambah Santri/Murid
                </button>
            </div>
        </div>
    @endsection

    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
        <livewire:register-management.student.index  lazy/>
    </div>
    <!--end::Row-->

    <livewire:register-management.student.create/>
    <livewire:register-management.student.show />

    @push('scripts')
        <script>
            document.addEventListener('livewire:init', function () {
                Livewire.on('success-swal-created', function () {
                    $('#region').val(0).trigger('change')
                    $('#modal-add-student').modal('hide');
                });
            });

            Inputmask({
                "mask" : "9999999999999999"
            }).mask(".mask");
            Inputmask({
                "mask" : "99-99-9999"
            }).mask(".mask-date");
            Inputmask({
                "mask" : "99999999"
            }).mask(".mask-id");

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
                        $('#modal-add-student').modal('hide');
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

            const editStudent = (id, region) => {
                $('#region').val(region).trigger('change')
                Livewire.dispatch('edit_student', [id]);
                $('#modal-add-student').modal('show');
            }

            const showStudent = id => {
                Livewire.dispatch('show_student', [id]);
                $('#modal-show-student').modal('show');
            }
        </script>
    @endpush
</x-default-layout>
