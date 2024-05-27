<x-default-layout>
    @section('title')
        Rekapitulasi Pembayaran
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
</x-default-layout>
