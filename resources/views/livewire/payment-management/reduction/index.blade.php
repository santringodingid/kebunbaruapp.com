<div>
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-rounded table-row-bordered gy-5 gs-7 mb-0">
                    <thead>
                    <tr class="fw-bold fs-6 text-gray-800">
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>DETIL</th>
                        <th>OPSI</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($reductions as $reduction)
                        <tr wire:key="{{ $reduction->id }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $reduction->name }}</td>
                            <td>
                                <ul>
                                @forelse($reduction->details as $detail)
                                    <li>{{ $detail->account->name }}</li>
                                @empty
                                    Detil tidak ada
                                @endforelse
                                </ul>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-danger">Tidak ada data untuk ditampilkan</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $reductions->links() }}
        </div>
    </div>
</div>

