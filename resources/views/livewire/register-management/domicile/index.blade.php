<div>
    <div class="row justify-content-between">
        <div class="col-sm-5 mb-5">
            <input type="text" wire:model.live.debounce="search" placeholder="Masukkan nama..." class="form-control form-control-sm">
        </div>
        <div class="col-sm-6 mb-5">
            <div class="row justify-content-end">
                <div class="col-sm-4 col-6 mb-5">
                    <button class="btn btn-light-primary btn-sm w-100">Import PDF</button>
                </div>
                <div class="col-sm-4 col-6 mb-5">
                    <button class="btn btn-light-primary btn-sm w-100">Import Excel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mb-5 mb-xl-10">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr class="fw-bold fs-6 text-gray-800">
                    <th>ID</th>
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
                        <td>{{ $domicile->student?->name }}</td>
                        <td>{{ $domicile->domicile_status ? 'P2K' : 'LP2K' }}</td>
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
            {{ $domiciles->links() }}
        </div>
    </div>
</div>
