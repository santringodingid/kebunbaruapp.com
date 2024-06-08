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
                            <th>MUWALLI</th>
                            <th>TANGGAL</th>
                            <th class="text-center">OPSI</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($guardianCards as $gc)
                            <tr wire:key="{{ $gc?->id }}" class="align-middle">
                                <td>{{ $gc?->id }}</td>
                                <td>{{ $gc?->guardian?->name }}</td>
                                <td>
                                    <ul>
                                        @if($gc?->guardian?->allStudent)
                                            @foreach($gc?->guardian?->allStudent as $s)
                                                <li>{{ $s?->name }}</li>
                                            @endforeach
                                        @else
                                            <li class="text-danger">Tidak ada data</li>
                                        @endif
                                    </ul>
                                </td>
                                <td>{{ $gc?->created_at->isoFormat('dddd, DD MMMM YYYY HH:mm') }}</td>
                                <td class="text-center">
                                    <button disabled class="btn btn-icon btn-active-light-primary w-30px h-30px">
                                        {!! getIcon('archive-tick','text-success fs-3') !!}
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
                {{ $guardianCards->links() }}
            </div>
        </div>
    </div>
</div>
