<div class="d-flex align-items-center gap-2 gap-lg-3">
    <div class="d-flex justify-content-end">
        <button
            type="button" class="btn btn-primary btn-sm"
            data-bs-toggle="tooltip" data-bs-placement="left"
            data-bs-custom-class="tooltip-inverse"
            title="Pindah permanen seluruh transaksi ke buku rekapitulasi"
            onclick="posting()"
        >
            <span wire:loading.remove>
                Posting pembayaran
            </span>
            <span class="indicator-progress" wire:loading>
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                Sedang dikirim...
            </span>
        </button>
    </div>
</div>
