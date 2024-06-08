<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Out Invoice</title>
    <style>
        * {
            font-family: 'Courier New', Courier, monospace;
            /* font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; */
            font-size: 11pt;
            /* color: cyan; */
        }

        .container {
            width: 800px;
            display: relative;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .col-8 {
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
        }

        .col-7 {
            flex: 0 0 58.333333%;
            max-width: 58.333333%;
        }

        .col-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .col-5 {
            flex: 0 0 41.666667%;
            max-width: 41.666667%;
        }

        .col-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }

        .logo {
            width: 100%;
            margin-top: 8px;
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0.1rem;
            margin-bottom: 0.1rem;
            margin-block-start: 0px;
            margin-block-end: 0px;
            font-family: inherit;
            font-weight: bold;
            color: inherit;
        }

        .invoice-title {
            font-size: 2.5rem;
        }

        .text-right {
            text-align: end;
        }

        hr {
            margin-top: 0.6rem;
            margin-bottom: 0.6rem;
            border: 0;
            border-top: 1px solid rgb(0 0 0 / 82%)
        }

        table {
            border-collapse: collapse;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            background-color: transparent;
        }

        .tablestripped {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            background-color: transparent;
        }

        .tablebottom {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            background-color: transparent;
        }

        .mb-0 {
            margin-bottom: 0px;
        }

        .mt-2 {
            margin-top: 3rem;
        }

        .mb-2 {
            margin-bottom: 2rem;
        }

        .tablestripped td,
        .tablestripped th {
            vertical-align: top;
            border-top: 1px solid #999797;
        }

        .tablebottom td,
        .tablebottom th {
            vertical-align: top;
            border-top: 1px dashed #999797;
        }

        .table-xl td,
        .table-xl th {
            padding: 0.5rem;
        }

        .table-sm td,
        .table-sm th {
            padding: 0.2rem;
        }

        .text-start {
            text-align: start;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: end;
        }

        .text-bold {
            font-weight: bold;
        }

        .notes {
            padding-left: 25px;
            padding-top: 10px;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-5">
            <img class="logo" src="{{ asset('storage/assets/payment-header.png') }}" alt="">
        </div>
        <div class="col-7 text-right">
            <span class="invoice-title text-bold" style="display: block">KUITANSI</span>
            <span style="font-style: italic; font-size: 1.0rem">NO.: {{ $payment->id }}</span>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-6">
            <table class="table">
                <tr>
                    <td>ID P2K</td>
                    <td>{{ $payment->registration_id }}</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><b>{{ $payment->registrationHasOne->student->name }}</b></td>
                </tr>
                <tr>
                    <td>Domisili</td>
                    <td>
                        {{ $payment->registrationHasOne->domicile_status ? 'P2K' : 'LP2K' }}, {{ $payment->registrationHasOne->domicile }} - {{ $payment->registrationHasOne->domicile_number }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-6">
            <table class="table">
                <tr>
                    <td>Kelas</td>
                    <td>
                        {{ $payment->registrationHasOne->grade_of_diniyah }} - {{ $payment->institution->shortname }}
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>
                        {{ $payment->registrationHasOne->student->region->village }}, {{ $payment->registrationHasOne->student->region->city }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="tablebottom table-xl">
                <thead>
                <tr>
                    <th style="font-weight: normal">NO</th>
                    <th style="font-weight: normal" class="text-start">KETERANGAN</th>
                    <th style="font-weight: normal" class="text-end">NOMINAL</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>{{ \Illuminate\Support\Str::title($payment->payment_notes) }}</td>
                    <td class="text-end">{{ $payment->payment_amount }}</td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>
                        @if($payment->reduction_amount > 0)
                        {{ \Illuminate\Support\Str::title($payment->reduction_notes) }}
                        @else
                            Pengurangan
                        @endif
                    </td>
                    <td class="text-end">-{{ $payment->reduction_amount }}</td>
                </tr>
                <tr class="text-bold">
                    <td class="text-center">3</td>
                    <td>JUMLAH</td>
                    <td class="text-end">{{ $payment->amount }}</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <i>
                            Terbilang : {{ \Illuminate\Support\Str::title(\Illuminate\Support\Number::spell($payment->getRawOriginal('amount'), 'id')) }} Rupiah
                        </i>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-7">
            <div style="display: flex">
                <div>
                    {!! DNS2D::getBarcodeHTML($payment->id, 'QRCODE', 5, 5) !!}
                </div>
                <div style="margin-left: 20px; padding-top: 30px">
                    Kuitansi ini adalah bukti pembayaran yang <b>SAH</b>. Mohon simpan dengan baik.
                </div>
            </div>
        </div>

        <div class="col-5">
            <div class="text-center">
                {{ hijriToString($payment->created_at_hijri) }} H
                <br>
                Kasir <br>
                <p style="margin-top: 60px;">
                    <u><b>{{ $payment->user->name }}</b></u>
                </p>
            </div>
        </div>
    </div>

    <div class="row mt-2 mb-2">
        <div class="col-12 text-center">
            <span style="font-style: italic; font-size: 8pt; color: #080000">
                -----------------------------------------------------Potong di sini-----------------------------------------------------
            </span>
        </div>
    </div>

    <div class="row">
        <div class="col-5">
            <img class="logo" src="{{ asset('storage/assets/payment-header.png') }}" alt="">
        </div>
        <div class="col-7 text-right">
            <span class="invoice-title text-bold" style="display: block">KUITANSI</span>
            <span style="font-style: italic; font-size: 1.0rem">NO.: {{ $payment->id }}</span>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-6">
            <table class="table">
                <tr>
                    <td>ID P2K</td>
                    <td>{{ $payment->registration_id }}</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><b>{{ $payment->registrationHasOne->student->name }}</b></td>
                </tr>
                <tr>
                    <td>Domisili</td>
                    <td>
                        {{ $payment->registrationHasOne->domicile_status ? 'P2K' : 'LP2K' }}, {{ $payment->registrationHasOne->domicile }} - {{ $payment->registrationHasOne->domicile_number }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-6">
            <table class="table">
                <tr>
                    <td>Kelas</td>
                    <td>
                        {{ $payment->registrationHasOne->grade_of_diniyah }} - {{ $payment->institution->shortname }}
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>
                        {{ $payment->registrationHasOne->student->region->village }}, {{ $payment->registrationHasOne->student->region->city }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="tablebottom table-xl">
                <thead>
                <tr>
                    <th style="font-weight: normal">NO</th>
                    <th style="font-weight: normal" class="text-start">KETERANGAN</th>
                    <th style="font-weight: normal" class="text-end">NOMINAL</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>{{ \Illuminate\Support\Str::title($payment->payment_notes) }}</td>
                    <td class="text-end">{{ $payment->payment_amount }}</td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>
                        @if($payment->reduction_amount > 0)
                            {{ \Illuminate\Support\Str::title($payment->reduction_notes) }}
                        @else
                            Pengurangan
                        @endif
                    </td>
                    <td class="text-end">-{{ $payment->reduction_amount }}</td>
                </tr>
                <tr class="text-bold">
                    <td class="text-center">3</td>
                    <td>JUMLAH</td>
                    <td class="text-end">{{ $payment->amount }}</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <i>
                            Terbilang : {{ \Illuminate\Support\Str::title(\Illuminate\Support\Number::spell($payment->getRawOriginal('amount'), 'id')) }} Rupiah
                        </i>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-7">
            <div style="display: flex">
                <div>
                    {!! DNS2D::getBarcodeHTML($payment->id, 'QRCODE', 5, 5) !!}
                </div>
                <div style="margin-left: 20px; padding-top: 30px">
                    Kuitansi ini adalah bukti pembayaran yang <b>SAH</b>. Mohon simpan dengan baik.
                </div>
            </div>
        </div>

        <div class="col-5">
            <div class="text-center">
                {{ hijriToString($payment->created_at_hijri) }} H
                <br>
                Kasir <br>
                <p style="margin-top: 60px;">
                    <u><b>{{ $payment->user->name }}</b></u>
                </p>
            </div>
        </div>
    </div>
</div>
<script>
    window.print()
    setTimeout(function() {
        window.close()
    }, 2000);
</script>
</body>

</html>
