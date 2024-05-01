<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr class="fw-bold fs-6 text-gray-800">
            <th>NO</th>
            <th>DINIYAH</th>
            <th>AMMIYAH</th>
            <th>OPSI</th>
        </tr>
        </thead>
        <tbody>
        @foreach($periods as $period)
            <tr wire:key="{{ $period->id }}">
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $period->diniyah }}</td>
                <td>{{ $period->ammiyah }}</td>
                <td>Edit</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $periods->links() }}
</div>
