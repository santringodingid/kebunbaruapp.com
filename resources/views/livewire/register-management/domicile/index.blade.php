<div>
    <div class="row g-2">
        <div class="col-6 col-sm-4 mb-5">
            <input type="text" wire:model.live.debounce="search" placeholder="Masukkan nama/ID/NIK..." class="form-control form-control-sm">
        </div>
        <div class="col-3 col-sm-2 mb-5">
            <select wire:model.live="domicile" class="form-control form-control-sm">
                <option value="">.:Semua Domisili:.</option>
                @foreach($domicileList as $domicile)
                    <option value="{{ $domicile->name }}">{{ $domicile->name }}</option>
                @endforeach
                <option value="Rumah Orang Tua">Rumah Orang Tua</option>
            </select>
        </div>
        <div class="col-3 col-sm-2 mb-5">
            <select wire:model.live="status" class="form-control form-control-sm">
                <option value="">.:Semua Status:.</option>
                <option value="1">Baru</option>
                <option value="0">Lama</option>
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
                            <th>ID</th>
                            <th>NIK</th>
                            <th>NAMA</th>
                            <th>STATUS DOMISILI</th>
                            <th>DOMISILI</th>
                            <th>STATUS</th>
                            <th class="text-center">OPSI</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($domiciles as $domicile)
                            <tr wire:key="{{ $domicile->id }}">
                                <td>{{ $domicile->id }}</td>
                                <td>{{ \Illuminate\Support\Str::mask($domicile->student?->nik, '*', -12, 10) }}</td>
                                <td>{{ $domicile->student?->name }}</td>
                                <td>{{ $domicile->domicile_status }}</td>
                                <td>{{ $domicile->domicile }} - {{ $domicile->domicile_number }}</td>
                                <td class="text-center">
                                    @if($domicile->is_new_domicile)
                                        <span class="badge badge-light-primary">Baru</span>
                                    @else
                                        <span class="badge badge-light-danger">Lama</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button title="Detail data" class="btn btn-icon btn-active-light-primary w-30px h-30px" onclick="showDomicile('{{ $domicile->id }}')">
                                        {!! getIcon('tablet-text-up','fs-3') !!}
                                    </button>
                                    <button title="Detail data" class="btn btn-icon btn-active-light-primary w-30px h-30px" onclick="addRegistration('{{ $domicile->student->id }}')">
                                        {!! getIcon('plus-square','fs-3') !!}
                                    </button>
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
                {{ $domiciles->links() }}
            </div>
        </div>
    </div>
</div>
