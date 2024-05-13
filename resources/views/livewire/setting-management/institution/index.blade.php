<div class="table-responsive">
    <table class="table table-row-bordered table-row-gray-300 gy-7 mb-0">
        <thead>
        <tr class="fw-bold fs-6 text-gray-800">
            <th>NO</th>
            <th>KODE</th>
            <th>NAMA</th>
            <th>KOMISI</th>
            <th>AKSES JENIS</th>
            <th>AKSES STATUS</th>
            <th>OPSI</th>
        </tr>
        </thead>
        <tbody>
        @foreach($institutions as $institution)
            <tr wire:key="{{ $institution->id }}">
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $institution->code }}</td>
                <td>{{ $institution->shortname }}</td>
                <td>{{ $institution->commission }}</td>
                <td>{{ $institution->gender_access }}</td>
                <td>{{ $institution->status_access }}</td>
                <td>
                    <button title="Detail data" class="btn btn-icon btn-active-light-primary w-30px h-30px" onclick="edit('{{ $institution->id }}')">
                        {!! getIcon('setting-3','fs-3') !!}
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
