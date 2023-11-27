<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">

    <style>
        .my-class {
            overflow: auto;
            width: 100%;
            font-size: 10px;
        }

        .my-class table {
            border: 2px double #000000;
            height: 100%;
            width: 100%;
            border-collapse: collapse;
            border-spacing: 1px;
        }

        .my-class table thead {
            border: 2px double #000000;
            height: 100%;
            width: 100%;
            border-collapse: collapse;
            border-spacing: 1px;
            text-align: center;
        }

        .my-class table tbody {
            border-collapse: collapse;
            border-spacing: 0.2px;
            text-align: left;
        }

        .my-class th {
            border: 2px double #000000;
            background-color: #94CBDF;
            color: #000000;
            padding: 5px;
        }

        .my-class td {
            border: 2px double #000000;
            background-color: #FFFFFF;
            color: #000000;
            padding: 5px;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="my-class">
        <table>
            <thead>
                <tr>
                    <th colspan="{{(4 + $pertemuans->count() +$absensis->count())}}">
                        <p style="margin: 0.2em;font-size: 12px;">Rekap Absensi Dosen ({{date('Y-m-d')}})</p>
                    </th>
                </tr>
                <tr>
                    <th class="text-left" colspan="{{round((4 + $pertemuans->count() +$absensis->count())/3)}}">Nama: {{$dosen->firstName}} {{$dosen->lastName}}</th>
                    <th class="text-left" colspan="{{(4 + $pertemuans->count() +$absensis->count()) - 2*round((4 + $pertemuans->count() +$absensis->count())/3)}}">Email: {{$dosen->email}}</th>
                    <th class="text-left" colspan="{{round((4 + $pertemuans->count() +$absensis->count())/3)}}">No. Telefon: {{$dosen->phone}}</th>
                </tr>
                <tr>
                    <th rowspan='2'>No</th>
                    <th rowspan='2'>Mata Pelajaran</th>
                    <th rowspan='2'>Kelas</th>
                    <th rowspan='2'>Kode</th>
                    <th colspan='{{$pertemuans->count()}}'>Tanggal Pertemuan</th>
                    <th colspan='{{$absensis->count()}}'>Total Absensi</th>
                </tr>
                <tr>
                    @if(count($pertemuans) != 0)
                    @foreach ($pertemuans as $pertemuan)
                    <th>{{$pertemuan}}</th>
                    @endforeach
                    @else
                    <th>-</th>
                    @endif
                    @foreach ($absensis as $absensi)
                    <th>{{$absensi->kode}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($mapels as $mapel)
                <tr>
                    <td class="text-right">{{$loop->index + 1}}</td>
                    <td>{{$mapel['detail']['nama']}}</td>
                    <td>{{$mapel['kelas']['nama']}}</td>
                    <td>{{$mapel['kelas']['kode']}}</td>

                    @if(count($mapel['pertemuans']) != 0)
                    @foreach ($mapel['pertemuans'] as $pertemuanHarian)
                    <td class="text-center">{{$pertemuanHarian['absensi']}}</td>
                    @endforeach
                    @else
                    <th>-</th>
                    @endif

                    @foreach ($absensis as $absensi)
                    @if(isset($mapel['rekaps'][$absensi->kode]))
                    <td class="text-center">{{$mapel['rekaps'][$absensi->kode]}}</td>
                    @else
                    <td class="text-center">0</td>
                    @endif
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>