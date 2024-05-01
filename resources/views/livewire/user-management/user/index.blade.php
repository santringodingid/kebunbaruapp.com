<div class="table-responsive">
    <table class="table table-row-bordered table-row-gray-300 gy-7 mb-0 align-middle">
        <thead>
        <tr class="fw-bold fs-6 text-gray-800">
            <th>NAMA</th>
            <th>ROLE</th>
            <th>TERAKHIR LOGIN</th>
            <th>OPSI</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr wire:key="{{ $user->id }}">
                <td class="d-flex align-items-center">
                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        @if($user->profile_photo_path)
                            <div class="symbol-label">
                                <img src="{{ asset('storage/'.$user->profile_photo_path) }}" class="w-100"/>
                            </div>
                        @else
                            <div class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?', $user->name) }}">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <!--end::Avatar-->
                    <!--begin::User details-->
                    <div class="d-flex flex-column">
                        <span class="text-gray-900 mb-1 fw-bold">
                            {{ $user->name }}
                        </span>
                        <span>{{ $user->email }}</span>
                    </div>
                </td>
                <td>
                    {{ ucwords($user->roles()->first()?->name) }}
                </td>
                <td>
                    <div class="badge badge-light fw-bold">
                        {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : $user->updated_at->diffForHumans() }}
                    </div>
                </td>
                <td>
                    <button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" onclick="editUser('{{ $user->id }}')">
                        {!! getIcon('setting-3','fs-3') !!}
                    </button>
                    <button class="btn btn-icon btn-active-light-primary w-30px h-30px" onclick="destroyUser('{{ $user->id }}')" data-kt-action="delete_row">
                        {!! getIcon('trash','fs-3') !!}
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
