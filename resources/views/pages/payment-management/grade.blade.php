<x-default-layout>
    @section('title')
        Rekapitulasi Per Kelas
    @endsection
    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
        <!--begin::Col-->
        <div class="col-12 mb-5 mb-xl-10">
            <livewire:payment-management.recapitulation.grade lazy />
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    @push('scripts')
        <script>
            document.addEventListener('livewire:init', function () {
                Livewire.on('success-created', function (message) {
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

            const posting = () => {
                Swal.fire({
                    title: "Yakin, nih?",
                    text: "Setelah posting semua transaksi tidak bisa dihapus",
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
