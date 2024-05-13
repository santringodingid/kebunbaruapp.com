<x-default-layout>

    @section('title')
        Pemabayaran
    @endsection

    @section('button')
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-payment">
                    <i class="ki-outline ki-plus-square fs-3"></i>
                    Tambah Pembayaran
                </button>
            </div>
        </div>
    @endsection

    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
        <livewire:payment-management.payment.index  lazy/>
    </div>
    <!--end::Row-->

    <livewire:payment-management.payment.create/>

    @push('scripts')
        <script>
            document.addEventListener('livewire:init', function () {
                Livewire.on('success-created', function (message) {
                    $('#modal-add-payment').modal('hide');
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
                $('#modal-add-payment').modal('hide');
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
