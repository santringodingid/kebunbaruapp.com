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
        @foreach($schools as $school)
            <tr wire:key="{{ $school->id }}">
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $school->account->name }}</td>
                <td class="text-end">{{ $school->nominal }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $schools->links() }}
</div>
