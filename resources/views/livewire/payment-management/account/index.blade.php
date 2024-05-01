<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr class="fw-bold fs-6 text-gray-800">
            <th>NO</th>
            <th>ID</th>
            <th>NAMA</th>
            <th>OPSI</th>
        </tr>
        </thead>
        <tbody>
        @foreach($accounts as $account)
            <tr wire:key="{{ $account->id }}">
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $account->id }}</td>
                <td>{{ $account->name }}</td>
                <td>Edit</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $accounts->links() }}
</div>
