<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr class="fw-bold fs-6 text-gray-800">
            <th>NO</th>
            <th>NAMA</th>
            <th>JENIS</th>
            <th>INSTANSI</th>
        </tr>
        </thead>
        <tbody>
        @foreach($disbursements as $disbursement)
            <tr wire:key="{{ $disbursement->id }}">
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $disbursement->account->name }}</td>
                <td>{{ $disbursement->gender ? 'Putri' : 'Putra' }}</td>
                <td>{{ $disbursement->institution->name ?? 'Madrasah' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $disbursements->links() }}
</div>
