<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr class="fw-bold fs-6 text-gray-800">
            <th>NO</th>
            <th>NAMA</th>
            <th>NOMINAL</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tahfidzs as $tahfidz)
            <tr wire:key="{{ $tahfidz->id }}">
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $tahfidz->account->name }}</td>
                <td class="text-end">{{ $tahfidz->nominal }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $tahfidzs->links() }}
</div>
