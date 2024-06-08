<div>
    <div class="row justify-content-between">
        <div class="col-10 col-sm-10 mb-5">
            <div class="row g-2">
                <div class="col-5 col-sm-4">
                    <input type="text" wire:model.live.debounce="search" placeholder="Cari nama/ID..." class="form-control form-control-sm">
                </div>
                <div class="col-3 col-sm-2">
                    <select wire:model.live="grade" class="form-control form-control-sm">
                        <option value="">.:Semua Kelas:.</option>
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
                <div class="col-4 col-sm-3">
                    <select wire:model.live="institution" class="form-control form-control-sm">
                        <option value="">.:Semua Tingkat:.</option>
                        @if($diniyahs)
                            @foreach($diniyahs as $item)
                                <option value="{{ $item->id }}">{{ $item->shortname }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="col-2 col-sm-2 mb-1">
            <form action="{{ route('payment-management.grade-export') }}" method="post" target="_blank">
                @csrf
                <input type="hidden" name="grade" value="{{ $selectedGrade }}">
                <input type="hidden" name="institution" value="{{ $selectedInstitution }}">
                <button type="submit" target="_blank" class="btn btn-light-primary btn-sm w-100">
                    <i class="ki-outline ki-file-down fs-3"></i>
                    <span class="d-none d-sm-inline">Ekspor Excel</span>
                </button>
            </form>
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
                            <th>ID</th>
                            <th>NAMA</th>
                            <th>KELAS</th>
                            <th>DOMISILI</th>
                            <th>ALAMAT</th>
                            <th>STATUS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($recapitulations as $recapitulation)
                            <tr wire:key="{{ $recapitulation->id }}">
                                <td class="align-middle">{{ $loop->index + 1 }}</td>
                                <td class="align-middle">{{ $recapitulation->id }}</td>
                                <td class="align-middle">{{ $recapitulation->name }}</td>
                                <td class="align-middle">{{ $recapitulation->grade }} - {{ $recapitulation->institution }}</td>
                                <td class="align-middle">
                                    {{ $recapitulation->domicile_status ? 'P2K' : 'LP2K' }},
                                    {{ $recapitulation->domicile }} - {{ $recapitulation->domicile_number }}
                                </td>
                                <td class="align-middle">
                                    {{ $recapitulation->village }} - {{ \Illuminate\Support\Str::replace(['Kabupaten '], 'Kab. ', $recapitulation->city) }}
                                </td>
                                <td class="align-middle">
                                    {!!
                                        !$recapitulation->payment ? '<span class="badge badge-light-danger">Tidak Bayar</span>'
                                        : ($recapitulation->status ? '<span class="badge badge-light-success">Lunas</span>'
                                        : '<span class="badge badge-light-primary">Belum Lunas</span>')
                                    !!}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-danger">
                                    Tidak ada data untuk ditampilkan
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-5 px-7">
                {{ $recapitulations->links() }}
            </div>
        </div>
    </div>
</div>
