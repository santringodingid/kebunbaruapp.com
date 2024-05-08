<div>
    <div class="row justify-content-between">
        <div class="col-sm-5 mb-5">
            <input type="text" wire:model.live.debounce="search" placeholder="Masukkan nama/ID..." class="form-control form-control-sm">
        </div>
    </div>
    <div class="col-12 mb-5 mb-xl-10">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-rounded table-row-bordered gy-5 gs-7 mb-0">
                        <thead>
                        <tr class="fw-bold fs-6 text-gray-800">
                            <th>NO</th>
                            <th>ID</th>
                            <th>NAMA</th>
                            <th>DOMISILI</th>
                            <th>PENGURANGAN</th>
                            <th>JUMLAH</th>
                            <th class="text-center">OPSI</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($distributions as $distribution)
                            <tr wire:key="{{ $distribution->id }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $distribution->registration_id }}</td>
                                <td>{{ $distribution?->student->name }}</td>
                                <td>
                                    <span @class([
                                        'badge',
                                        'badge-light-danger' => $distribution->registration->domicile_status == 0,
                                        'badge-light-primary' => $distribution->registration->domicile_status == 1,
                                    ])>
                                        {{ $distribution->registration->domicile_status ? 'P2K' : 'LP2K' }}
                                    </span>
                                    {{ $distribution->registration->domicile.' - '.$distribution->registration->domicile_number }}
                                </td>
                                <td>{{ $distribution?->reduction?->name }}</td>
                                <td class="text-end">{{ $distribution?->amount }}</td>
                                <td class="text-center">
                                    Edit
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
            <div class="card-footer px-7 py-5">
                {{ $distributions->links() }}
            </div>
        </div>
    </div>
</div>
