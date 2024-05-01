<x-default-layout>
    @section('title')
        Tarif
    @endsection

    @section('button')
        @can('create payment management')
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <a href="{{ route('payment-management.fare.create') }}" class="btn btn-primary btn-sm">
                    <i class="ki-outline ki-plus-square fs-3"></i>
                    Tambah Tarif
                </a>
            </div>
        </div>
        @endcan
    @endsection

    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
        <!--begin::Col-->
        <div class="col-12 mb-5 mb-xl-10">
            <livewire:payment-management.fare.index lazy />
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

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

                const setAutoNumeric = (el) => {
                    if (AutoNumeric.getAutoNumericElement(el) === null) {
                        new AutoNumeric(el, {
                            digitGroupSeparator: '.',
                            decimalPlaces: 0,
                            decimalCharacter: ','
                        })
                    }
                }

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
                            $('#modal-add-fare').modal('hide');
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
            </script>
    @endpush
</x-default-layout>
