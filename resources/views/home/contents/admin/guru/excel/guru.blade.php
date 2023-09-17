<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th colspan="{{(3 + $pertemuans->count() +$absensis->count())}}">Rekap Absensi Guru</th>
            </tr>
            <tr>
                <th colspan="{{(3 + $pertemuans->count() +$absensis->count())/3}}">Nama: {{$guru->firstName}} {{$guru->lastName}}</th>
                <th colspan="{{(3 + $pertemuans->count() +$absensis->count())/3}}">Email: {{$guru->email}}</th>
                <th colspan="{{(3 + $pertemuans->count() +$absensis->count())/3}}">No. Telefon: {{$guru->phone}}</th>
            </tr>
            <tr>
                <th rowspan='2'>Nomor</th>
                <th rowspan='2'>Mata Pelajaran</th>
                <th rowspan='2'>Kelas</th>
                <th rowspan='2'>Kode</th>
                <th colspan='{{$pertemuans->count()}}'>Tanggal Pertemuan</th>
                <th colspan='{{$absensis->count()}}'>Total Absensi</th>
            </tr>
            <tr>
                @foreach ($pertemuans as $pertemuan)
                <th>{{$pertemuan}}</th>
                @endforeach
                @foreach ($absensis as $absensi)
                <th>{{$absensi->kode}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($mapels as $mapel)
            <tr>
                <td>{{$loop->index}}</td>
                <td>{{$mapel['detail']['nama']}}</td>
                <td>{{$mapel['kelas']['nama']}}</td>
                <td>{{$mapel['kelas']['kode']}}</td>
                @foreach ($mapel['pertemuans'] as $pertemuanHarian)
                <td>{{$pertemuanHarian['absensi']}}</td>
                @endforeach
                @foreach ($absensis as $absensi)
                @if(isset($mapel['rekap'][$absensi->kode]))
                <td>{{$mapel['rekap'][$absensi->kode]}}</td>
                @else
                <td>0</td>
                @endif
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>