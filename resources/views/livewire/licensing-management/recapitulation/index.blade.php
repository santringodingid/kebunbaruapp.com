<div>
    <div class="row justify-content-between">
        <div class="col-sm-6 mb-5">
            <div class="row">
                <div class="col-4">
                    <select wire:model.live="hijri" class="form-control form-control-sm">
                        <option value="">.:Bulan:.</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ sprintf('%02d', $i) }}">{{ hijriMonth($i) }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mb-1">
            <div class="row justify-content-end">
                <div class="col-sm-4 col-6 mb-5">
                    <a href="{{ route('licensing-management.recapitulation-export') }}" target="_blank" class="btn btn-light-primary btn-sm w-100">Ekspor Excel</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mb-5 mb-xl-10" wire:loading.delay>
        <div class="card">
            <div class="card-body">
                <div>
                    <div class="d-flex align-items-center text-muted">
                        <span>Data sedang dimuat...</span>
                        <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mb-5 mb-xl-10" wire:loading.remove>
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-rounded table-row-bordered gy-5 gs-7 mb-0">
                        <thead>
                        <tr class="fw-bold fs-6 text-gray-800">
                            <th>REG</th>
                            <th>NAMA</th>
                            <th>DOMISILI</th>
                            <th>ALASAN</th>
                            <th class="text-center">STATUS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($licenses as $license)
                            <tr wire:key="{{ $license->id }}" class="align-middle">
                                <td>{{ $license->id }}</td>
                                <td>
                                    {{ $license->petition?->student?->name }}
                                    <br>
                                    <small class="fs-9 text-muted">{{ $license->petition?->registration_id }}</small>
                                </td>
                                <td>
                                    <span @class([
                                        'badge',
                                        'badge-light-primary' => $license->petition?->registration?->getRawOriginal('domicile_status') == 1,
                                        'badge-light-danger' => $license->petition?->registration?->getRawOriginal('domicile_status') == 0,
                                    ])>
                                        {{ $license->petition?->registration?->domicile_status }}
                                    </span>
                                    {{ $license->petition?->registration?->domicile }} - {{ $license->petition?->registration?->domicile_number }}
                                </td>
                                <td>{{ $license->petition?->reason }} — {{ $license->petition?->note }}</td>
                                <td class="text-center">
                                    <span @class([
                                        'badge',
                                        'badge-light-danger' => $license->getRawOriginal('status') == 0,
                                        'badge-light-primary' => $license->getRawOriginal('status') == 1,
                                        'badge-light-success' => $license->getRawOriginal('status') == 2,
                                    ])>
                                        {{ $license->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-danger">
                                    Tidak ada data untuk ditampilkan
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-5 px-7">
                {{ $licenses->links() }}
            </div>
        </div>
    </div>
</div>
