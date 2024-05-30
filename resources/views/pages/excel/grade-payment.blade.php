<div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NAMA</th>
                <th>KELAS</th>
                <th>TINGKAT</th>
                <th>STATUS DOMISILI</th>
                <th>DOMISILI</th>
                <th>ALAMAT</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
        @forelse($recapitulations as $recapitulation)
            <tr>
                <td>{{ $recapitulation->id }}</td>
                <td>{{ $recapitulation->name }}</td>
                <td>{{ $recapitulation->grade }}</td>
                <td>{{ $recapitulation->institution }}</td>
                <td>{{ $recapitulation->domicile_status ? 'P2K' : 'LP2K' }}</td>
                <td>{{ $recapitulation->domicile .' - '.$recapitulation->domicile_number }}</td>
                <td>{{ $recapitulation->village.' '.$recapitulation->city }}</td>
                <td>
                    {{
                        !$recapitulation->payment ? 'TIDAK BAYAR' : ($recapitulation->status ? 'LUNAS' : 'BELUM LUNAS')
                    }}
                </td>
            </tr>
        @empty
            <tr><td>Tidak ada data untuk ditampilkan</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
