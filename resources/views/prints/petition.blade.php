<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KebunbaruApp – Print Out Permohonan Izin</title>
    <style>
        * {
            font-family: 'Corbel';
            /* font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; */
            font-size: 12pt;
        }

        .row {
            margin-left: auto;
            margin-right: auto;
            width: 800px;
            /* background-color: aqua; */
        }

        .header {
            display: block;
            /* margin-left: auto;
        margin-right: auto; */
            width: 100%;
        }

        .judul {
            text-align: center;
            margin-bottom: 0em;
            margin-top: 1em;
            font-weight: bold;
        }

        .noreg {
            text-align: center;
            margin-top: 0em;
        }

        .divisi {
            padding-left: 10px;
            margin-top: 20px;
            text-align: left;
        }

        .tebal {
            font-weight: bold;
        }

        .flex {
            display: flex;
            justify-content: start;
            flex: content;
        }
    </style>
</head>

<body>
@if($petition)
    <div class="row">
        <img class="header" src="{{ asset('storage/assets/student-header.png') }}" alt="">
        <div class="divjudul">
            <h3 class="judul"> <u>SURAT IZIN PULANG</u></h3>
            <h4 class="noreg" style="font-weight: normal; font-style: italic">Nomor : {{ $petition->reg_number }}</h4>
        </div>
        <div class="divisi">
            <p>Diberikan kepada :</p>
            <table border="0" width="100%" style="margin-left: 50px">
                <tr style="font-weight: bold">
                    <td style="height: 30px">Nama</td>
                    <td>:</td>
                    <td>{{ $petition?->student?->name }}</td>
                </tr>
                <tr>
                    <td style="height: 30px">ID P2K</td>
                    <td>:</td>
                    <td>{{ $petition->registration_id }}</td>
                </tr>
                <tr>
                    <td style="height: 30px">Nomor Induk</td>
                    <td>:</td>
                    <td>{{ $petition->student?->registration_number }}</td>
                </tr>
                <tr>
                    <td style="height: 30px">Tempat/Tanggal Lahir</td>
                    <td>:</td>
                    <td>
                        {{ $petition->student?->place_of_birth.', '.$petition->student?->date_of_birth->isoFormat('D MMMM Y') }}
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; height: 30px">Alamat</td>
                    <td style="vertical-align: top;">:</td>
                    <td>
                        {{ $petition->student->region->village }} {{ $petition->student->region->district }}, {{ str_replace(['Kabupaten', 'Kota '], '', $petition->student->region->city) }}
                    </td>
                </tr>
                <tr>
                    <td style="height: 30px">Pendidikan Diniyah</td>
                    <td>:</td>
                    <td>
                        {{ $petition->registration->grade_of_diniyah }} - {{ $petition->registration->diniyah->shortname }}
                    </td>
                </tr>
                <tr>
                    <td style="height: 30px">Pendidikan Ammiyah</td>
                    <td>:</td>
                    <td>
                        {{ $petition->registration->grade_of_formal }} - {{ $petition->registration->formal->shortname }}
                    </td>
                </tr>
                <tr style="font-weight: bold; height: 30px">
                    <td>
                        {{ $petition->is_health ? 'Dikarenakan' : 'Keperluan' }}
                    </td>
                    <td>:</td>
                    <td>
                        {{ $petition->reason }} {{ $petition->note ? ' – '.$petition->note : '' }}
                    </td>
                </tr>
                <tr>
                    <td style="height: 30px">Berlaku s.d. tanggal</td>
                    <td>:</td>
                    <td>___________________________________________________ ( ____ hari )</td>
                </tr>
                </tbody>
            </table>
            <p>Demikian, agar dipergunakan sebagaimana mestinya.</p>
            <p>Diberikan di Kebun baru, tanggal ______________________________________________ H.</p>
            <p style="text-align: center; font-style: italic; margin-top: 50px">Diketahui oleh,</p>
            <table width="100%" style="margin-top: 5px;">
                <tbody>
                <tr>
                    <td colspan="3" style="height: 10px;"></td>
                </tr>
                <tr style="text-align: center;">
                    <td style="width: 30%;"> <i>{{ $config->gender ? 'Kabag. Taklimiyah' : 'Wali Kelas' }}</i> </td>
                    <td style="width: 30%;">
                        <i>{{ $petition->is_health ? 'Kabag. Kesehatan' : 'Kabag. Kamtib' }}</i>
                    </td>
                    <td style="width: 30%;"><i>Kabid. Ma'hadiyah</i></td>
                </tr>
                <tr style="height: 80px; text-align: center;">
                    <td style="vertical-align: bottom;">
                        <b>{{ $config->gender ? $config->guardian : '(____________________________)' }}</b>
                    </td>
                    <td style="vertical-align: bottom;">
                        <b><u>{{ $petition->is_health ? $config->health : $config->kamtib }}</u></b>
                    </td>
                    <td style="vertical-align: bottom;">
                        <b><u>{{ $config->kabid }}</u></b>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="height: 40px;"></td>
                </tr>
                <tr style="text-align: center;">
                    <td style="width: 100%;" colspan="3">
                        <i>{{ $config->gender ? 'a.n.' : '' }} Pengasuh</i>
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td style="width: 100%;" colspan="3"> <i>Pondok Pesantren Miftahul Ulum Kebun baru</i> </td>
                </tr>
                <tr style="height: 80px; text-align: center;">
                    <td colspan="3" style="width: 100%; vertical-align: bottom;">
                        <b><u>{{ $config->chief }}</u></b>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div>
            <div class="flex" style="margin-top: 125px">
                <div>
                    {!! DNS2D::getBarcodeHTML($petition->id, 'QRCODE', 6, 6) !!}
                </div>
                <div style="margin-top: 30px; font-style: italic;">
                    <ul style="list-style-type: circle">
                        <li>Diterbitkan oleh {{ $petition->user->name }} pada {{ hijriToString(getHijri($petition->created_at->toDateString())) }} /
                            {{ $petition->created_at->isoFormat('D MMMM Y') }} pukul {{ $petition->created_at->format('H:i') }} WIB
                        </li>
                        <li>
                            Proses izin harus selesai paling lambat {{ hijriToString(getHijri($petition->expired_at->toDateString())) }} /
                            {{ $petition->expired_at->isoFormat('D MMMM Y') }} pukul {{ $petition->expired_at->format('H:i') }} WIB
                        </li>
                        <li>Setelah proses selesai, Surat Izin ini harus ditukar dengan Salinan Surat Izin ke Kantor Sekretariat Pesantren pada saat jam pelayanan.</li>
                    </ul>
                </div>
            </div>
            <div style="margin-top: 10px;">
                {{ $petition->id }}
            </div>
        </div>
    </div>

    <script>
        window.print()
        setTimeout(function() {
            window.close()
        }, 2000);
    </script>
@else
    <div>Data tidak ditemukan</div>
@endif
</body>

</html>
