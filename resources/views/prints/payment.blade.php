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
            font-size: 3.5rem;
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

        .text-center {
            text-align: center;
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
            <h1 class="invoice-title">KUITANSI</h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-7">
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
                <tr>
                    <td>Kelas</td>
                    <td>
                            {{ $payment->registrationHasOne->grade_of_diniyah }} - {{ $payment->institution->name }}
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
        <div class="col-5">
            <table class="table">
                <tr>
                    <td>Nomor</td>
                    <td>{{ $payment->id }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>{{ hijriToString($payment->created_at_hijri) }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="tablestripped table-xl">
                <thead>
                <tr>
                    <th style="font-weight: normal">NO</th>
                    <th style="font-weight: normal">KETERANGAN</th>
                    <th style="font-weight: normal">JUMLAH</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>{{ \Illuminate\Support\Str::upper($payment->notes) }}</td>
                    <td class="text-center text-bold">Rp. {{ $payment->amount }}</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Terbilang :</b>
                        <i>
                            {{ \Illuminate\Support\Str::title(\Illuminate\Support\Number::spell($payment->getRawOriginal('amount'), 'id')) }} Rupiah
                        </i>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
            <div class="col-7">
            <div>
                <b>Catatan :</b> <br>
                Kuitansi ini adalah bukti pembayaran yang SAH. <br>
                Mohon simpan dengan baik.
            </div>
        </div>

        <div class="col-5">
            <div class="text-center">
                Kebun Baru, {{ hijriToString($payment->created_at_hijri) }} H <br>
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
            <h1 class="invoice-title">KUITANSI</h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-7">
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
                <tr>
                    <td>Kelas</td>
                    <td>
                        {{ $payment->registrationHasOne->grade_of_diniyah }} - {{ $payment->institution->name }}
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
        <div class="col-5">
            <table class="table">
                <tr>
                    <td>Nomor</td>
                    <td>{{ $payment->id }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>{{ hijriToString($payment->created_at_hijri) }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="tablestripped table-xl">
                <thead>
                <tr>
                    <th style="font-weight: normal">NO</th>
                    <th style="font-weight: normal">KETERANGAN</th>
                    <th style="font-weight: normal">JUMLAH</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>{{ \Illuminate\Support\Str::upper($payment->notes) }}</td>
                    <td class="text-center text-bold">Rp. {{ $payment->amount }}</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Terbilang :</b>
                        <i>
                            {{ \Illuminate\Support\Str::title(\Illuminate\Support\Number::spell($payment->getRawOriginal('amount'), 'id')) }} Rupiah
                        </i>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-7">
            <div>
                <b>Catatan :</b> <br>
                Kuitansi ini adalah bukti pembayaran yang SAH. <br>
                Mohon simpan dengan baik.
            </div>
        </div>

        <div class="col-5">
            <div class="text-center">
                Kebun Baru, {{ hijriToString($payment->created_at_hijri) }} H <br>
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
