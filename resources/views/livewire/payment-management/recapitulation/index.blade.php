<div>
    <div class="row justify-content-between">
        <div class="col-10 col-sm-6 mb-5">
            <div class="row">
                <div class="col-6 col-sm-4">
                    <select wire:model.live="hijri" class="form-control form-control-sm">
                        <option value="">.:Bulan:.</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ sprintf('%02d', $i) }}">{{ hijriMonth($i) }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="col-2 mb-1">
            <form action="{{ route('payment-management.recapitulation-export') }}" method="post" target="_blank">
                @csrf
                <input type="hidden" name="hijri" value="{{ $selectedHijri }}">
                <button type="submit" target="_blank" class="btn btn-light-primary btn-sm w-100">
                    <i class="ki-outline ki-file-down fs-3"></i>
                    <span class="d-none d-sm-inline">Ekspor PDF</span>
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
                            <th>INSTANSI</th>
                            <th>DETIL</th>
                            <th class="text-center">TOTAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                        $amount = 0;
                        @endphp
                        @forelse($recapitulations as $recapitulation)
                            <tr wire:key="{{ $recapitulation['id'] }}">
                                <td class="align-middle">{{ $loop->index + 1 }}</td>
                                <td class="align-middle">{{ $recapitulation['institution'] }}</td>
                                <td class="align-middle">
                                    <div class="row justify-content-between">
                                        @foreach($recapitulation['details'] as $detail)
                                            <div class="col-8">{{ $detail->name }}</div>
                                            <div class="col-4 text-end">{{ Number::format($detail?->total, 0, 0, 'id') }}</div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="text-end align-middle">{{ Number::format($recapitulation['total'], 0, 0, 'id') }}</td>
                            </tr>
                            @php
                                $amount += $recapitulation['total'];
                            @endphp
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-danger">
                                    Tidak ada data untuk ditampilkan
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer fw-bold">
                TOTAL SELURUH: {{ Number::format($amount, 0, 0, 'id') }}
            </div>
        </div>
    </div>
</div>
