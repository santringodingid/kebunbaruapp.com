<div>
    <div class="row justify-content-between mb-4">
        <div class="col-10 mb-1">
            <div class="row justify-content-start g-2">
                <div class="col-4 col-sm-2">
                    <select wire:model.live.debounce="grade" class="form-control form-control-sm">
                        <option value="">.:Kelas:.</option>
                        @for ($i = 1; $i < 7; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                        <option value="RA">RA</option>
                        <option value="TPQ">TPQ</option>
                        <option value="Jilid">Jilid</option>
                        <option value="Takhossus">Takhossus</option>
                        <option value="Lulus">Lulus</option>
                    </select>
                </div>
                <div class="col-8 col-sm-3">
                    <select wire:model.live.debounce="institution" class="form-control form-control-sm">
                        <option value="">.:Tingkat:.</option>
                        @foreach($diniyahs as $diniyah)
                            <option value="{{ $diniyah->id }}"> {{ $diniyah->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-2 mb-1">
            <a href="{{ route('payment-management.fare-export') }}" target="_blank" class="btn btn-light-primary btn-sm w-100">
                <i class="ki-outline ki-file-down fs-3"></i>
                <span class="d-none d-sm-inline">Ekspor Excel</span>
            </a>
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
                        <th>NO</th>
                        <th>KELAS</th>
                        <th>TINGKAT</th>
                        <th>DOMISILI</th>
                        <th>NOMINAL</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($fares as $fare)
                        <tr wire:key="{{ $fare->id }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $fare->grade }}</td>
                            <td>{{ $fare?->institution?->name }}</td>
                            <td>
                        <span @class([
                            'badge',
                            'badge-light-primary' => $fare->domicile_status == 1,
                            'badge-light-danger' => $fare->domicile_status == 0,
                        ])>
                            {{ $fare->domicile_status ? 'P2K' : 'LP2K' }}
                        </span>
                            </td>
                            <td class="text-end">{{ $fare->amount }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-danger">Tidak ada data untuk ditampilkan</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $fares->links() }}
        </div>
    </div>
    </div>
</div>

