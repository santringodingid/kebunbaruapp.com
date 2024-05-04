<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Salinan Formulir</title>
    <style>
        * {
            font-family: 'Courier New', Courier, monospace;
            font-size: 13pt;
            /* font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; */
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
            margin-top: 0px;
            text-align: left;
        }

        .tebal {
            font-weight: bold;
        }
    </style>
</head>
<body>
@if($student)
<div class="row">
    <img class="header" src="{{ asset('storage/assets/student-header.png') }}" alt="Header">
    <div class="divjudul">
        <table border="0" style="width: 100%;">
            <tr>
                <td>
                    <h3 class="judul">SALINAN FORMULIR PENDAFTARAN</h3>
                    <h5 class="noreg"><i>No. Registrasi : {{ 'REG-'.$student->registration_number }}</i></h5>
                </td>
            </tr>
        </table>
    </div>
    <div class="divisi">
        <table border="0">
            <thead>
            <tr>
                <th style="width: 30%;">NOMOR ID | INDUK</th>
                <th style="width: 10%; text-align:center">:</th>
                <th style="width: 60%;">{{ $student->id.' | '.$student->registration_number }}</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Tanggal Masuk</td>
                <td style="text-align:center">:</td>
                <td>{{ hijriToString($student->created_at_hijri) }}</td>
            </tr>
            <tr>
                <td>Angkatan Periode</td>
                <td style="text-align:center">:</td>
                <td>{{ $student->period->diniyah }} | {{ $student->period->ammiyah }}</td>
            </tr>
            <tr>
                <td>Nomor KK</td>
                <td style="text-align:center">:</td>
                <td>{{ $student->kk }}</td>
            </tr>
            <tr>
                <td>Nomor NIK</td>
                <td style="text-align:center">:</td>
                <td>{{ $student->nik }}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td style="text-align:center">:</td>
                <td class="tebal">{{ $student->name }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td style="text-align:center">:</td>
                <td>
                    {{ $student->gender ? 'Perempuan' : 'Laki-laki' }}
                </td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td style="text-align:center">:</td>
                <td>
                    {{ $student->place_of_birth.', '.$student->date_of_birth->isoFormat('D MMMM Y') }}
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td style="text-align:center">:</td>
                <td>
                    {{ $student->address }}
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    {{ $student->region->village }} {{ $student->region->district }} {{ \Illuminate\Support\Str::replace(['Kota ', 'Kabupaten'], '', $student->region->city) }}
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    {{ $student->region->province }}, {{ $student->region->portal_code }}
                </td>
            </tr>
            <tr>
                <td>Pendidikan Akhir</td>
                <td style="text-align:center">:</td>
                <td>
                    {{ $student->last_education }}
                </td>
            </tr>
            <tr>
                <td>Status Domisili</td>
                <td style="text-align:center">:</td>
                <td>
                    {{ $student->domicile_status ? 'LP2K (Non Asrama)' : 'P2K (Asrama)' }}
                </td>
            </tr>
            <tr>
                <td>Domisili</td>
                <td style="text-align:center">:</td>
                <td>
                    {{ $student->domicile }} - {{ $student->domicile_number }}
                </td>
            </tr>
            <tr>
                <td>Rencana Diniyah</td>
                <td style="text-align:center">:</td>
                <td>
                    {{ $student->grade_of_diniyah }} - {{ $student->diniyah->name }}
                </td>
            </tr>
            <tr>
                <td>Rencana Ammiyah</td>
                <td style="text-align:center">:</td>
                <td>
                    {{ $student->grade_of_formal }} - {{ $student->formal->name }}
                </td>
            </tr>
            <tr>
                <td>Nama Ayah</td>
                <td style="text-align:center">:</td>
                <td>
                    {{ $student->father }}
                </td>
            </tr>
            <tr>
                <td>Nama Ibu</td>
                <td style="text-align:center">:</td>
                <td>
                    {{ $student->mother }}
                </td>
            </tr>
            <tr style="height: 15px;">
                <td colspan="3"></td>
            </tr>
            <tr>
                <td>NIK Wali</td>
                <td style="text-align:center">:</td>
                <td>
                    {{ $student->guardian->nik }}
                </td>
            </tr>
            <tr>
                <td>Nama Wali</td>
                <td style="text-align:center">:</td>
                <td class="tebal">
                    {{ $student->guardian->name }}
                </td>
            </tr>
            <tr>
                <td>Nomor HP</td>
                <td style="text-align:center">:</td>
                <td>
                    {{ $student->guardian->phone }}
                </td>
            </tr>
            <tr>
                <td>Nomor HP</td>
                <td style="text-align:center">:</td>
                <td>
                    {{ $student->guardian->wa_number }}
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td style="text-align:center">:</td>
                <td>
                    {{ $student->guardian->address }}
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    {{ $student->guardian->region->village }} {{ $student->guardian->region->district }} {{ \Illuminate\Support\Str::replace(['Kota ', 'Kabupaten'], '', $student->guardian->region->city ) }}
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    {{ $student->guardian->region->province }}, {{ $student->guardian->region->portal_code }}
                </td>
            </tr>
            <tr>
                <td>Pendidikan Akhir</td>
                <td style="text-align:center">:</td>
                <td>
                    {{ $student->guardian->last_education }}
                </td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td style="text-align:center">:</td>
                <td>
                    {{ $student->guardian->employment }}
                </td>
            </tr>
            <tr>
                <td>Hubungan Perwalian</td>
                <td style="text-align:center">:</td>
                <td>
                    {{ $student->guardian_relationship }}
                </td>
            </tr>
            <tr style="height: 25px;">
                <td colspan="3"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Diterima di Kebun baru</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Tanggal : {{ hijriToString($student->created_at_hijri) }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><i>Panitia P2SMB</i></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><i>Ketua</i></td>
            </tr>
            <tr style="height: 65px;">
                <td colspan="3"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><b><u>{{ $student->committee }}</u></b></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    window.print()
    setTimeout(function() {
        window.close()
    }, 2000);
</script>
@else
{{ 'Data tak ditemukan' }}
<script>
    window.close()
</script>
@endif

</body>
</html>

