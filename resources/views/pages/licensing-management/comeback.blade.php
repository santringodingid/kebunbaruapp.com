<x-default-layout>

    @section('title')
        Kembali Perizinan
    @endsection

    @section('button')
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-comeback">
                    <i class="ki-outline ki-plus-square fs-3"></i>
                    Tambah kembali
                </button>
            </div>
        </div>
    @endsection

    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
        <livewire:licensing-management.comeback.index lazy />
    </div>
    <!--end::Row-->

    <livewire:licensing-management.comeback.create />

    @push('scripts')
        <script>
            document.addEventListener('livewire:init', function () {
                Livewire.on('success-created', function (message) {
                    $('#modal-add-comeback').modal('hide');
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

                Livewire.on('error-edit', function (message) {
                    Swal.fire({
                        text: message,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: 'OK!',
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                });
            });

            Inputmask({
                "mask" : "99-999"
            }).mask(".mask-id");

            Inputmask({
                "mask" : "99-99-9999 99:99:99"
            }).mask(".mask-date");

            const reset = () => {
                $('#modal-add-comeback').modal('hide');
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

            const edit = id => {
                Livewire.dispatch('edit', [id]);
                $('#modal-add-comeback').modal('show')
            }

            const setCompleted = id => {
                Swal.fire({
                    title: "Yakin, nih?",
                    text: "Pastikan tanggal kembali sudah divalidasi",
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
                        Livewire.dispatch('set-completed', [id]);
                    }
                });
            }

            const beforeSubmit = (e) => {
                e.preventDefault()
                let code = e.keyCode
                if(code == 13) {
                    submit(true)
                }
            }

            $('#modal-add-comeback').on('shown.bs.modal', () => {
                $('#reg').focus()
            })

            const add = id => {
                Swal.fire({
                    title: "Yakin, nih?",
                    text: "Pastikan kamu telah memvalidasi",
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
                        Livewire.dispatch('add', [id]);
                        $('#modal-add-comeback').modal('show');
                    }
                });
            }
        </script>
    @endpush
</x-default-layout>
