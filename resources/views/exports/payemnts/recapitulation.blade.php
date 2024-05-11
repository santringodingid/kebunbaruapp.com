<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Keuangan Bulan {{ $month }}</title>
    <style>
        * {
            font-family: Corbel, "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", "Bitstream Vera Sans", "Liberation Sans", Verdana, "Verdana Ref", sans-serif;
            font-size: 11pt;
        }


        .text-center {
            text-align: center;
        }

        table,
        td,
        th {
            border: 1px solid;

        }

        th {
            padding: 5px 0px;
        }

        td {
            padding: 4px 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .text-right {
            text-align: right;
        }

        .no-border-right {
            border-right: 0px;
        }

        .no-border-left {
            border-left: 0px;
        }

        h5 {
            margin: 4px;
        }

        h6 {
            margin: 4px 0px 8px 0px;
        }

        .mb-5 {
            margin-bottom: 20px;
        }

        .font-weight-bold {
            font-weight: bold;
        }

        .page-break {
            page-break-after: always;
        }

        .d-flex {
            display: flex;
            align-items: flex-end;
        }
    </style>
</head>

<body>
<div>
    <section>
        <h5 class="text-center">
            REKAPITULASI KEUANGAN {{ $gender }} <br>
            BULAN {{ \Illuminate\Support\Str::upper($month) }}
        </h5>
    </section>
        @if($results)
            @foreach($results as $result)
            <section class="mb-5">
                <h6>{{ $loop->index + 1 }} - {{ $result['institution'] }}</h6>
                <table border="1">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>URAIAN</th>
                        <th colspan="2">JUMLAH</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($result['details'] as $detail)
                            <tr>
                                <td class="text-center">{{ $loop->index + 1 }}</td>
                                <td>{{ $detail->name }}</td>
                                <td class="no-border-right">Rp</td>
                                <td class="text-right no-border-left">
                                    {{ Number::format($detail?->total, 0, 0, 'id') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr class="font-weight-bold">
                        <td colspan="2" class="text-center">TOTAL</td>
                        <td class="no-border-right">Rp</td>
                        <td class="text-right no-border-left">
                            {{ Number::format($result['total'], 0, 0, 'id') }}
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </section>
            @endforeach
        @endif

    @if($results)
        <section class="mb-5">
            <h6>I. KESIMPULAN</h6>
            <table border="1">
                <thead>
                <tr>
                    <th>NO</th>
                    <th>INSTANSI</th>
                    <th colspan="2">JUMLAH</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $amount = 0;
                @endphp
                @foreach($results as $result)
                    <tr>
                        <td class="text-center">
                            {{ $loop->index +1 }}
                        </td>
                        <td>{{ $result['institution'] }}</td>
                        <td class="no-border-right">Rp</td>
                        <td class="text-right no-border-left">
                            {{ Number::format($result['total'], 0, 0, 'id') }}
                        </td>
                    </tr>
                    @php
                    $amount += $result['total']
                    @endphp
                @endforeach
                </tbody>
                <tfoot>
                <tr class="font-weight-bold">
                    <td colspan="2" class="text-center">TOTAL</td>
                    <td class="no-border-right">Rp</td>
                    <td class="text-right no-border-left">
                        {{ Number::format($amount, 0, 0, 'id') }}
                    </td>
                </tr>
                </tfoot>
            </table>
        </section>

    @endif
    <section>
        <div class="text-center">
            Pamekasan, {{ hijriToString(session('hijri')) }} <br>
            Bendahara
            <br><br><br><br>
            <b><u>{{ $user }}</u></b>
        </div>
    </section>
</div>
</body>

</html>
