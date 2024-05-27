<div>
    <div class="row justify-content-between">
        <div class="col-sm-8 mb-1">
            <div class="row">
                <div class="col-sm-5">
                    <input type="text" wire:model.live.debounce="search" placeholder="Masukkan nama/ID/NIK..." class="form-control form-control-sm">
                </div>
                <div class="col-sm-2">
                    <select wire:model.live="period" class="form-control form-control-sm">
                        <option value="">.:Semua Periode:.</option>
                        @foreach($periods as $period)
                            <option value="{{ $period->id }}">{{ $period->diniyah }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mb-1">
            <div class="row justify-content-end">
{{--                <div class="col-sm-4 col-6 mb-5">--}}
{{--                    <button class="btn btn-light-primary btn-sm w-100">Import PDF</button>--}}
{{--                </div>--}}
                <div class="col-sm-4 col-6 mb-5">
                    <a href="{{ route('register-management.student-export') }}" target="_blank" class="btn btn-light-primary btn-sm w-100">Ekspor Excel</a>
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
                            <th>ID</th>
                            <th>NIK</th>
                            <th>NAMA</th>
                            <th>ALAMAT</th>
                            <th>ANGKATAN</th>
                            <th class="text-center">OPSI</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($students as $student)
                            <tr wire:key="{{ $student->id }}">
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->nik }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->region->village.', '.$student->region->city }}</td>
                                <td>{{ $student->period->diniyah }}</td>
                                <td class="text-center">
                                    <button title="Edit data" class="btn btn-icon btn-active-light-primary w-30px h-30px" onclick="editStudent('{{ $student->id }}', '{{ $student->region_id }}')">
                                        {!! getIcon('setting-3','fs-3') !!}
                                    </button>
                                    <button title="Detail data" class="btn btn-icon btn-active-light-primary w-30px h-30px" onclick="showStudent('{{ $student->id }}')">
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
                </div>
            </div>
            <div class="card-footer py-5 px-7">
                {{ $students->links() }}
            </div>
        </div>
    </div>
</div>
