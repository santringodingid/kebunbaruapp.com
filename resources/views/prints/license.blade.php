<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KebunbaruApp – Print Out Surat Izin</title>
    <style>
        * {
            /*font-family: 'Courier New', Courier, monospace;*/
            /*font-family: 'Corbel', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;*/
            font-size: 12pt;
        }

        .container {
            width: 148mm;
            height: 210mm;
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

        .col-10 {
            flex: 0 0 83%;
            max-width: 83%;
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

        .col-2 {
            flex: 0 0 16.6%;
            max-width: 16.6%;
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

        .mb-1 {
            margin-bottom: 1rem;
        }

        .mb-2 {
            margin-bottom: 2rem;
        }

        .tablestripped th {
            vertical-align: top;
            border-top: 1px solid #999797;
            border-bottom: 1px solid #999797;
        }

        .tablestripped td {
            vertical-align: top;
            border-top: 1px solid #999797;
        }

        .tablebottom td,
        .tablebottom th {
            vertical-align: top;
            border-top: 1px dashed #999797;
        }

        #line-bottom {
            border-top: 1px solid #999797;
        }

        .table-xl th {
            padding: 0.5rem;
        }

        .table-xl td {
            padding: 0.3rem;
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

        .mb-5 {
            margin-bottom: 40px;
        }

        .pl-5 {
            padding-left: 20px;
        }

        .align-top {
            vertical-align: top;
        }

        .pt-5 {
            padding-top: 30px;
        }

        .mb-3 {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
@if($license)
<div class="container">
    <div class="row">
        <div class="col-12" style="margin-bottom: 30px;">
            <img src="{{ asset('storage/assets/payment-header.png') }}" style="width: 70%;">
        </div>
        <div class="col-12 text-center mb-3">
            <h6>
                <u>SALINAN SURAT IZIN</u>
            </h6>
            <i>Nomor: {{ $license->petition->reg_number }}</i>
        </div>
        <div class="col-12">
            <p>Yang bertanda tangan di bawah ini, Kami pengurus Pondok Pesantren Miftahul Ulum Kebun baru menerangkan bahwa anak tersebut di bawah ini:</p>
        </div>
        <div class="col-12">
            <table class="table mb-0" border="0">
                <tbody>
                <tr>
                    <td class="pl-5">Nama</td>
                    <td>:</td>
                    <td><b>{{ $license->petition->student->name }}</b></td>
                </tr>
                <tr>
                    <td class="pl-5">ID P2K</td>
                    <td>:</td>
                    <td>{{ $license->petition->registration_id }}</td>
                </tr>
                <tr>
                    <td class="pl-5">Tetala</td>
                    <td>:</td>
                    <td>{{ $license->petition->student->place_of_birth }}, {{ $license->petition->student->date_of_birth->isoFormat('D MMMM Y') }}</td>
                </tr>
                <tr>
                    <td class="pl-5">Usia</td>
                    <td>:</td>
                    <td>
                        {{ setAge($license->petition->student->date_of_birth) }}
                    </td>
                </tr>
                <tr>
                    <td class="pl-5 align-top">Alamat</td>
                    <td class="align-top">:</td>
                    <td>
                        {{ $license->petition->student->region->village }} {{ $license->petition->student->region->district }}
                        {{ \Illuminate\Support\Str::replace(['Kota ', 'Kabupaten '], '', $license->petition->student->region->city) }}
                    </td>
                </tr>
                <tr>
                    <td class="pl-5">Domisili</td>
                    <td>:</td>
                    <td>
                        P2K, {{ $license->petition->registration->domicile }} - {{ $license->petition->registration->domicile_number }}
                    </td>
                </tr>
                <tr>
                    <td class="pl-5">Pend. Diniyah</td>
                    <td>:</td>
                    <td>
                        {{ $license->petition->registration->grade_of_diniyah }} – {{ $license->petition->registration->diniyah->shortname }}
                    </td>
                </tr>
                <tr>
                    <td class="pl-5">Pend. Ammiyah</td>
                    <td>:</td>
                    <td>
                        {{ $license->petition->registration->grade_of_formal }} – {{ $license->petition->registration->formal->shortname }}
                    </td>
                </tr>
                <tr>
                    <td class="pl-5">
                        {{ $license->petition->is_health ? 'Dikarenakan' : 'Keperluan' }}
                    </td>
                    <td>:</td>
                    <td>
                        {{ $license->petition->reason }} – {{ $license->petition->note }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-12">
        <p>
            Telah diberi izin untuk pulang/bepergian selama <b>{{ $license->start_at->diff($license->end_at) }}</b>, berlaku sejak tanggal ditetapkan
            dan harus kembali ke pondok pesantren selambat-lambatnya : <br> {{ $license->end_at->isoFormat('dddd, DD MMMM YYYY') }} pukul <b>{{ $license->end_at->isoFormat('HH:mm') }}</b>.
        </p>
    </div>
    <div class="col-12">
        <p>Demikian mohon maklum adanya.</p>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table" style="margin-bottom: 8px">
                <tr>
                    <td style="text-align: end">Kebun baru, {{ hijriToString($license->start_at_hijri) }} / {{ dateToString($license->start_at->format('Y-m-d')) }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <table class="table">
                <tr>
                    <td>
                        <i>Sekretaris</i>
                        <br><br><br><br><br>
                        <b><u>{{ $license->createdBy->name }}</u></b>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-6" style="font-style: italic">
                    <ol type="1">
                        <li>Yang bersangkutan</li>
                        <li>Sekolah Ammiyah</li>
                        <li>Madrasah Diniyah</li>
                    </ol>
                </div>
                <div class="col-6" style="padding-top: 10px;">
                    <div style="float: right">
                        {!! DNS2D::getBarcodeHTML($license->id, 'QRCODE', 6, 6) !!}
                        <div style="margin-top: 10px">{{ $license->id }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<p style="page-break-after: always;">&nbsp;</p>

<script>
    window.print()
    setTimeout(() => {
    	window.close()
    }, 2000);
</script>
@endif
</body>

</html>
