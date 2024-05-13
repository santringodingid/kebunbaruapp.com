<x-default-layout>

    @section('title')
        Registrasi Diniyah
    @endsection

    @section('button')
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-diniyah">
                    <i class="ki-outline ki-plus-square fs-3"></i>
                    Tambah Registrasi
                </button>
            </div>
        </div>
    @endsection

    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
        <livewire:register-management.diniyah.index  lazy/>
    </div>
    <!--end::Row-->

    <livewire:register-management.diniyah.create/>

    @push('scripts')
        <script>
            document.addEventListener('livewire:init', function () {
                Livewire.on('success-created', function (message) {
                    $('#modal-add-diniyah').modal('hide');
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
                $('#modal-add-diniyah').modal('hide');
                Livewire.dispatch('reset');
            }

            const submit = (status) => {
                if(status) {
                    Livewire.dispatch('submit');
                    return false
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

            const addRegistration = id => {
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
                        $('#modal-add-diniyah').modal('show');
                    }
                });
            }
        </script>
    @endpush
</x-default-layout>
