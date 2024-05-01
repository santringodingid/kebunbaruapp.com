<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr class="fw-bold fs-6 text-gray-800">
            <th>NO</th>
            <th>NAMA</th>
            <th>DOMISILI</th>
            <th>NOMINAL BAWAAN</th>
        </tr>
        </thead>
        <tbody>
        @foreach($registrations as $registration)
            <tr wire:key="{{ $registration->id }}">
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $registration->account->name }}</td>
                <td>
                    <span @class([
                        'badge',
                        'badge-light-primary' => $registration->domicile_status == 1,
                        'badge-light-danger' => $registration->domicile_status == 0,
                    ])>
                        {{ $registration->domicile_status ? 'P2K' : 'LP2K' }}
                    </span>
                </td>
                <td class="text-end">{{ $registration->nominal }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $registrations->links() }}
</div>
