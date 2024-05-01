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
        @foreach($infaqs as $infaq)
            <tr wire:key="{{ $infaq->id }}">
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $infaq->account->name }}</td>
                <td>
                    <span @class([
                        'badge',
                        'badge-light-primary' => $infaq->domicile_status == 1,
                        'badge-light-danger' => $infaq->domicile_status == 0,
                    ])>
                        {{ $infaq->domicile_status ? 'P2K' : 'LP2K' }}
                    </span>
                </td>
                <td class="text-end">{{ $infaq->nominal }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $infaqs->links() }}
</div>
