<div>
    <div class="row justify-content-between">
        <div class="col-sm-5 mb-5">
            <input type="text" wire:model.live.debounce="search" placeholder="Masukkan nama/ID" class="form-control form-control-sm">
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
                            <th>BERLAKU S.D.</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center">OPSI</th>
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
                                        'badge-light-primary' => $license->petition?->registration?->domicile_status == 1,
                                        'badge-light-danger' => $license->petition?->registration?->domicile_status == 0,
                                    ])>
                                        {{ $license->petition?->registration?->domicile_status ? 'P2K' : 'LP2K' }}
                                    </span>
                                    {{ $license->petition?->registration?->domicile }} - {{ $license->petition?->registration?->domicile_number }}
                                </td>
                                <td>{{ $license->petition?->reason }} — {{ $license->petition?->note }}</td>
                                <td>{{ $license->end_at->isoFormat('dddd, DD MMMM YYYY HH:mm') }}</td>
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
                                <td class="text-center">
                                    @if($license->getRawOriginal('status') == 0)
                                        <a title="Print Out" href="{{ route('print.license', $license->id) }}" target="_blank" class="btn btn-icon btn-active-light-primary w-30px h-30px">
                                            {!! getIcon('printer','fs-3') !!}
                                        </a>
                                        <button title="Ubah data" class="btn btn-icon btn-active-light-primary w-30px h-30px" onclick="edit('{{ $license->id }}')">
                                            {!! getIcon('setting-3','fs-3') !!}
                                        </button>
                                        <button title="Aktifkan" class="btn btn-icon btn-active-light-primary w-30px h-30px" onclick="activate('{{ $license->id }}')">
                                            {!! getIcon('check-square','fs-3') !!}
                                        </button>
                                    @elseif($license->getRawOriginal('status') == 1)
                                        <button disabled class="btn btn-icon btn-active-light-primary w-30px h-30px">
                                            {!! getIcon('archive-tick','text-success fs-3') !!}
                                        </button>
                                    @else
                                        <button disabled class="btn btn-icon btn-active-light-primary w-30px h-30px">
                                            {!! getIcon('archive-tick','text-success fs-3') !!}
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-danger">
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
