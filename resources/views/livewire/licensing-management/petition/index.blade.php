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
                            <th>KADALUARSA</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center">OPSI</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($petitions as $petition)
                            <tr wire:key="{{ $petition->id }}" class="align-middle">
                                <td>{{ $petition->id }}</td>
                                <td>
                                    {{ $petition->student?->name }}
                                    <br>
                                    <small class="text-muted fs-9">{{ $petition->registration_id }}</small>
                                </td>
                                <td>
                                    <span @class([
                                        'badge',
                                        'badge-light-primary' => $petition->registration?->domicile_status == 1,
                                        'badge-light-danger' => $petition->registration?->domicile_status == 0,
                                    ])>
                                        {{ $petition->registration?->domicile_status ? 'P2K' : 'LP2K' }}
                                    </span>
                                    {{ $petition->registration?->domicile }} - {{ $petition->registration?->domicile_number }}
                                </td>
                                <td>{{ $petition->reason }} — {{ $petition->note }}</td>
                                <td>
                                    {{ $petition->expired_at->isoFormat('dddd, DD MMMM YYYY HH:mm') }}
                                </td>
                                <td class="text-center">
                                    <span @class([
                                        'badge',
                                        'badge-light-danger' => $petition->getRawOriginal('status') == 0,
                                        'badge-light-warning' => $petition->getRawOriginal('status') == 1,
                                        'badge-light-primary' => $petition->getRawOriginal('status') == 2,
                                        'badge-light-success' => $petition->getRawOriginal('status') == 3,
                                    ])>
                                        {{ $petition->status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($petition->getRawOriginal('status') == 0)
                                        <button title="Hapus data" class="btn btn-icon btn-active-light-primary w-30px h-30px" onclick="destroy('{{ $petition->id }}')">
                                            {!! getIcon('trash','fs-3') !!}
                                        </button>
                                    @elseif($petition->getRawOriginal('status') == 1)
                                        <a title="Print Out" href="{{ route('print.petition', $petition->id) }}" target="_blank" class="btn btn-icon btn-active-light-primary w-30px h-30px">
                                            {!! getIcon('printer','fs-3') !!}
                                        </a>
                                        <button title="Ubah data" class="btn btn-icon btn-active-light-primary w-30px h-30px" onclick="edit('{{ $petition->id }}')">
                                            {!! getIcon('setting-3','fs-3') !!}
                                        </button>
                                        <button title="Hapus data" class="btn btn-icon btn-active-light-primary w-30px h-30px" onclick="destroy('{{ $petition->id }}')">
                                            {!! getIcon('trash','fs-3') !!}
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
                {{ $petitions->links() }}
            </div>
        </div>
    </div>
</div>
