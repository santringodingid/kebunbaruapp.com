<div>
    <div class="row justify-content-between">
        <div class="col-sm-4 mb-5">
            <input type="text" wire:model.live.debounce="search" placeholder="Masukkan nama/ID..." class="form-control form-control-sm">
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
                            <th>INV</th>
                            <th>ID</th>
                            <th>NAMA</th>
                            <th>DOMISILI</th>
                            <th>DINIYAH</th>
                            <th>NOMINAL</th>
                            <th class="text-center">OPSI</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($payments as $payment)
                            <tr wire:key="{{ $payment->id }}">
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->registration_id }}</td>
                                <td>{{ $payment->registrationHasOne?->student->name }}</td>
                                <td>
                                    <span @class([
                                        'badge',
                                        'badge-light-danger' => $payment->registrationHasOne->getRawOriginal('domicile_status') == 0,
                                        'badge-light-primary' => $payment->registrationHasOne->getRawOriginal('domicile_status') == 1,
                                    ])>
                                        {{ $payment->registrationHasOne->domicile_status }}
                                    </span>
                                    {{ $payment->registrationHasOne->domicile.' - '.$payment->registrationHasOne->domicile_number }}
                                </td>
                                <td>{{ $payment->registrationHasOne->grade_of_diniyah }} - {{ $payment->registrationHasOne?->diniyah?->shortname }}</td>
                                <td class="text-end">{{ $payment->amount }}</td>
                                <td class="text-center">
                                    <a title="Print Invoice" class="btn btn-icon btn-active-light-primary w-30px h-30px" href="{{ route('print.payment', $payment->id) }}" target="_blank">
                                        {!! getIcon('printer','fs-3') !!}
                                    </a>
                                    @if(!$payment->is_recapped)
                                        <button title="Hapus transaksi" class="btn btn-icon btn-active-light-danger w-30px h-30px" onclick="destroy('{{ $payment->id }}')">
                                            {!! getIcon('trash','fs-3 text-danger') !!}
                                        </button>
                                    @endif
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
                {{ $payments->links() }}
            </div>
        </div>
    </div>
</div>
