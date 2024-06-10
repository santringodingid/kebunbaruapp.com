<div>
    <div class="row g-2">
        <div class="col-7 col-sm-3">
            <input type="text" wire:model.live.debounce="search" placeholder="Masukkan nama/ID/NIK" class="form-control form-control-sm">
        </div>
        <div class="col-5 col-sm-2">
            <select wire:model.live="domicile" class="form-control form-control-sm">
                <option value="">.:Semua Domisili:.</option>
                @foreach($domiciles as $domicile)
                    <option value="{{ $domicile->name }}">{{ $domicile->name }}</option>
                @endforeach
                <option value="Rumah Orang Tua">Rumah Orang Tua</option>
            </select>
        </div>
        <div class="col-4 col-sm-2">
            <select wire:model.live="diniyah" class="form-control form-control-sm">
                <option value="">.:Tingkat Diniyah:.</option>
                @foreach($diniyahs as $diniyah)
                    <option value="{{ $diniyah->id }}">{{ $diniyah->shortname }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-4 col-sm-2">
            <select wire:model.live="ammiyah" class="form-control form-control-sm">
                <option value="">.:Tingkat Ammiyah:.</option>
                @foreach($ammiyahs as $ammiyah)
                    <option value="{{ $ammiyah->id }}">{{ $ammiyah->shortname }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-2 col-sm-1 mb-5">
            <select wire:model.live="status" class="form-control form-control-sm">
                <option value="">.:Status:.</option>
                <option value="0">Berhenti</option>
                <option value="1">Aktif</option>
                <option value="2">Tugas</option>
                <option value="3">Pengurus</option>
            </select>
        </div>
        <div class="col-2 col-sm-2 mb-1">
            <a target="_blank" href="{{ route('register-management.registration-export') }}" class="btn btn-light-primary btn-sm w-100">
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
                            <th>ID</th>
                            <th>NIK</th>
                            <th>NAMA</th>
                            <th>DOMISILI</th>
                            <th>DINIYAH</th>
                            <th>AMMIYAH</th>
                            <th>STATUS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($statuses as $status)
                            <tr wire:key="{{ $status->id }}">
                                <td>{{ $status->id }}</td>
                                <td>{{ \Illuminate\Support\Str::mask($status->student?->nik, '*', -12, 10) }}</td>
                                <td>{{ $status->student?->name }}</td>
                                <td>
                                    <span @class([
                                        'badge',
                                        'badge-light-primary' => $status->getRawOriginal('domicile_status') == 1,
                                        'badge-light-danger' => $status->getRawOriginal('domicile_status') == 0,
                                    ])>
                                        {{ $status->domicile_status }}
                                    </span>
                                            {{ $status->domicile.' - '.$status->domicile_number }}
                                            <span @class([
                                        'badge',
                                        'badge-sm',
                                        'badge-circle',
                                        'badge-outline',
                                        'badge-danger' => !$status->is_new_domicile,
                                        'badge-success' => $status->is_new_domicile,
                                    ])>
                                        {{ $status->is_new_domicile ? 'B' : 'L' }}
                                    </span>
                                </td>
                                <td>
                                    {{ $status->grade_of_diniyah.' - '.$status->diniyah->name }}
                                    <span @class([
                                'badge',
                                'badge-sm',
                                'badge-circle',
                                'badge-outline',
                                'badge-danger' => !$status->is_new_diniyah,
                                'badge-success' => $status->is_new_diniyah,
                            ])>
                                {{ $status->is_new_diniyah ? 'B' : 'L' }}
                            </span>
                                </td>
                                <td>
                                    {{ $status->grade_of_formal.' - '.$status->formal->name }}
                                    <span @class([
                                'badge',
                                'badge-sm',
                                'badge-circle',
                                'badge-outline',
                                'badge-danger' => !$status->is_new_formal,
                                'badge-success' => $status->is_new_formal,
                            ])>
                                {{ $status->is_new_formal ? 'B' : 'L' }}
                            </span>
                                </td>
                                <td class="text-center">
                            <span @class([
                                'badge',
                                'badge-light-danger' => $status->student->getRawOriginal('status') == 0,
                                'badge-light-success' => $status->student->getRawOriginal('status') == 1,
                                'badge-light-primary' => $status->student->getRawOriginal('status') == 2,
                            ])>
                                {{ $status->student->status }}
                            </span>
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
