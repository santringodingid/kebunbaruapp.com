<div>
    <div class="row justify-content-between">
        <div class="col-sm-5 mb-1">
            <input type="text" wire:model.live.debounce="search" placeholder="Masukkan ID/NIK/Nama..." class="form-control form-control-sm">
        </div>
        <div class="col-sm-6 mb-1">
            <div class="row justify-content-end">
                <div class="col-sm-4 col-6 mb-5">
                    <a href="{{ route('register-management.guardian-set') }}" class="btn btn-light-primary btn-sm w-100">Set Image</a>
                </div>
                <div class="col-sm-4 col-6 mb-5">
                    <a href="{{ route('register-management.guardian-export') }}" target="_blank" class="btn btn-light-primary btn-sm w-100">Ekspor Excel</a>
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
                            <th>HP/WA</th>
                            <th class="text-center">OPSI</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($guardians as $guardian)
                            <tr wire:key="{{ $guardian->id }}">
                                <td>{{ $guardian->id }}</td>
                                <td>{{ $guardian->nik }}</td>
                                <td>{{ $guardian->name }}</td>
                                <td>{{ $guardian->region->village.', '.$guardian->region->city }}</td>
                                <td>{{ $guardian->phone }}</td>
                                <td class="text-center">
                                    <button title="Edit data" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" onclick="editGuardian('{{ $guardian->id }}', '{{ $guardian->region_id }}')">
                                        {!! getIcon('setting-3','fs-3') !!}
                                    </button>
                                    <button title="Detail data" class="btn btn-icon btn-active-light-primary w-30px h-30px" onclick="showGuardian('{{ $guardian->id }}')">
                                        {!! getIcon('tablet-text-up','fs-3') !!}
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-5 px-7">
                {{ $guardians->links() }}
            </div>
        </div>
    </div>
</div>
