<div>
    <div class="row g-2">
        <div class="col-4 col-sm-3 mb-5">
            <input type="text" wire:model.live.debounce="search" placeholder="Masukkan nama/ID" class="form-control form-control-sm">
        </div>
        <div class="col-3 col-sm-2 mb-5">
            <select wire:model.live="isLate" class="form-control form-control-sm">
                <option value="">.:Semua Status:.</option>
                <option value="0">Disiplin</option>
                <option value="1">Indisipliner</option>
            </select>
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
                            <th>TGL. KEMBALI</th>
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
                                    {{ $license->petition?->registration?->domicile }} - {{ $license->petition?->registration?->domicile_number }}
                                </td>
                                <td>
                                    {{ $license->petition?->reason }}
                                    <br>
                                    <span class="text-muted">
                                        ({{ $license->petition?->note }})
                                    </span>
                                </td>
                                <td>
                                    @if($license?->finish_at)
                                        {{ $license?->finish_at?->isoFormat('dddd') }}
                                        <br>
                                        <span class="text-muted">
                                            {{ $license?->finish_at?->isoFormat('DD MMMM YYYY HH:mm') }}
                                        </span>
                                    @else
                                        ––
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($license?->finish_at)
                                        <span @class([
                                        'badge',
                                        'badge-light-success' => $license->getRawOriginal('is_late') == 0,
                                        'badge-light-danger' => $license->getRawOriginal('is_late') == 1,
                                    ])>
                                        {{ $license->is_late  }}
                                    </span>
                                    @else
                                        Pending
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($license->getRawOriginal('status') != 2)
                                        @if($license->finish_at)
                                            <button title="Ubah data" class="btn btn-icon btn-active-light-primary w-30px h-30px" onclick="edit('{{ $license->id }}')">
                                                {!! getIcon('setting-3','fs-3') !!}
                                            </button>
                                        @else
                                            <button title="Proses kembali" class="btn btn-icon btn-active-light-primary w-30px h-30px" onclick="add('{{ $license->id }}')">
                                                {!! getIcon('plus-square','fs-3') !!}
                                            </button>
                                        @endif
                                        <button title="Selesaikan" class="btn btn-icon btn-active-light-primary w-30px h-30px" onclick="setCompleted('{{ $license->id }}')">
                                            {!! getIcon('check-square','fs-3') !!}
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
                                <td colspan="7" class="text-center text-danger">
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
