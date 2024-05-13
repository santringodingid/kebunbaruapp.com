<x-default-layout>
    @section('title')
        Rekapitulasi Pembayaran
    @endsection
    @section('button')
{{--        <div class="p-10">--}}
{{--            <a class="btn btn-primary" href="{{ route('payment-management.recapitulation-config', '10') }}">Syawal</a>--}}
{{--            <a class="btn btn-primary" href="{{ route('payment-management.recapitulation-config', '11') }}">Dzul Qo'dah</a>--}}
{{--        </div>--}}
    @endsection
    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
        <!--begin::Col-->
        <div class="col-12 mb-5 mb-xl-10">
            <livewire:payment-management.recapitulation.index lazy />
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

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
        </script>
    @endpush
</x-default-layout>
