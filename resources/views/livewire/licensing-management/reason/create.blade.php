<div class="py-5 px-8">
        <div class="row">
            <div class="col-12 col-sm-9">
                <form wire:submit.prevent="store" autocomplete="off" onkeydown="return event.key != 'Enter';">
                    <input type="text" class="form-control form-control-sm text-capitalize" wire:model="name" />
                </form>
            </div>
            <div class="col-12 col-sm-3">
                <button type="button" class="btn btn-primary btn-sm w-100" onclick="submit()">
                    <span class="indicator-label" wire:loading.remove>
                        Simpan
                    </span>
                    <span class="indicator-progress" wire:loading>
                        Proses...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </div>
</div>
