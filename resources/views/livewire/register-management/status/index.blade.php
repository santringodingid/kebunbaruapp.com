<div>
    <div class="row justify-content-between">
        <div class="col-sm-5 mb-5">
            <input type="text" wire:model.live.debounce="search" placeholder="Masukkan nama/ID/NIK..." class="form-control form-control-sm">
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
                        @forelse($statuses as $status)
                            <tr wire:key="{{ $status->id }}">
                                <td>{{ $status->id }}</td>
                                <td>{{ \Illuminate\Support\Str::mask($status->student?->nik, '*', -12, 10) }}</td>
                                <td>{{ $status->student?->name }}</td>
                                <td>{{ $status->domicile_status }}</td>
                                <td>{{ $status->domicile.' - '.$status->domicile_number }}</td>
                                <td class="text-center">
                            <span @class([
                                'badge',
                                'badge-light-danger' => $status->student->getRawOriginal('status') == 0,
                                'badge-light-success' => $status->student->getRawOriginal('status') == 1,
                                'badge-light-primary' => $status->student->getRawOriginal('status') == 2,
                                'badge-light-warning' => $status->student->getRawOriginal('status') == 3,
                            ])>
                                {{ $status->student->status }}
                            </span>
                                </td>
                                <td class="text-center">
                                    <button title="Detail data" class="btn btn-icon btn-active-light-primary w-30px h-30px" onclick="showDomicile('{{ $status->id }}')">
                                        {!! getIcon('tablet-text-up','fs-3') !!}
                                    </button>
                                    <button title="Detail data" class="btn btn-icon btn-active-light-primary w-30px h-30px" onclick="addRegistration('{{ $status->student->id }}')">
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
                {{ $statuses->links() }}
            </div>
        </div>
    </div>
</div>
