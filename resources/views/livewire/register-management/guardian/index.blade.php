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
            {{ $guardians->links() }}
        </div>
    </div>
</div>
