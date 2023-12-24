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
                    <th colspan="8">
                        <p style="margin: 0.2em;font-size: 12px;">Penggajian Dosen Pada Periode {{$input['bulan']}} - {{$input['tahun']}}</p>
                    </th>
                </tr>
                <tr>
                    <th class="text-left" colspan="3">Nama: {{$user->firstName}} {{$user->lastName}}</th>
                    <th class="text-left" colspan="3">Email: {{$user->email}}</th>
                    <th class="text-left" colspan="2"></th>
                </tr>
                <tr>
                    <th class="table-plus datatable-nosort text-center">No.</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Waktu</th>
                    <th class="text-center">Mapel - Kelas</th>
                    <th class="text-center">SKS</th>
                    <th class="text-center">Tipe</th>
                    <th class="text-center">Nominal</th>
                    <th class="text-center">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['details'] as $detail)
                <tr>
                    <td class="table-plus datatable-nosort text-center">{{$loop->iteration}}</td>
                    <td class="text-start">{{$detail->tanggal}}</td>
                    <td class="text-center">{{$detail->waktu}}</td>
                    <td class="text-start">{{$detail->mapelkelas}}</td>
                    <td class="text-center">{{$detail->sks}}</td>
                    <td class="text-left">{{$detail->tipe}}</td>
                    <td class="text-right">@currency($detail->nominal)</td>
                    <td class="text-left">{{$detail->keterangan}}</td>
                </tr>
                @endforeach
                <tr>
                    <td class="table-plus datatable-nosort text-center"></td>
                    <td class="text-start"></td>
                    <td class="text-center"></td>
                    <td class="text-start"></td>
                    <td class="text-center"></td>
                    <td class="text-left">Tambahan</td>
                    <td class="text-right">@currency($data['tambahan']['nominal'])</td>
                    <td class="text-left"></td>
                </tr>
                <tr>
                    <td class="table-plus datatable-nosort text-center"></td>
                    <td class="text-start"></td>
                    <td class="text-center"></td>
                    <td class="text-start"></td>
                    <td class="text-center"></td>
                    <td class="text-left">Total</td>
                    <td class="text-right">@currency($data['total'])</td>
                    <td class="text-left"></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
