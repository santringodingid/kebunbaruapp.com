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
        @foreach($pesantrens as $pesantren)
            <tr wire:key="{{ $pesantren->id }}">
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $pesantren->account->name }}</td>
                <td class="text-end">{{ $pesantren->nominal }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $pesantrens->links() }}
</div>
