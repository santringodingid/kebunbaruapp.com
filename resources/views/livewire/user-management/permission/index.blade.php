<div class="table-responsive">
    <table class="table table-row-bordered table-row-gray-300 gy-7 mb-0">
        <thead>
        <tr class="fw-bold fs-6 text-gray-800">
            <th>NO</th>
            <th>PERMISSION</th>
            <th>ASSIGNED TO</th>
            <th>OPSI</th>
        </tr>
        </thead>
        <tbody>
        @foreach($permissions as $permission)
            <tr wire:key="{{ $permission->id }}">
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $permission->name }}</td>
                <td>
                    @foreach($permission->roles as $role)
                        <span class="badge fs-7 m-1 fw-normal {{ app(\App\Actions\GetThemeType::class)->handle('badge-light-?', $role->name) }}">
                            {{ $role->name }}
                        </span>
                    @endforeach
                </td>
                <td>
                    <button class="btn btn-icon btn-active-light-primary w-30px h-30px" onclick="destroyPermission('{{ $permission->name  }}')">
                        {!! getIcon('trash','fs-3') !!}
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
