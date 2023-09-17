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
                <th colspan="{{(3 + $pertemuans->count() +$absensis->count())}}">Rekap Absensi</th>
            </tr>
            <tr>
                <th colspan="{{(3 + $pertemuans->count() +$absensis->count())/3}}">Kelas: {{$kelas->kode}} {{$kelas->nama}}</th>
                <th colspan="{{(3 + $pertemuans->count() +$absensis->count())/3}}">Mata Pelajaran: {{$mapel->nama}}</th>
                <th colspan="{{(3 + $pertemuans->count() +$absensis->count())/3}}">Wali Kelas: {{$mapel->user->firstName}} {{$mapel->user->lastName}}</th>
            </tr>
            <tr>
                <th colspan="{{(3 + $pertemuans->count() +$absensis->count())/3}}">Jumlah Siswa: {{$jumlah['siswa']}}</th>
                <th colspan="{{(3 + $pertemuans->count() +$absensis->count())/3}}">Laki-Laki: {{$jumlah['laki']}}</th>
                <th colspan="{{(3 + $pertemuans->count() +$absensis->count())/3}}">Perempuan: {{$jumlah['perempuan']}}</th>
            </tr>
            <tr>
                <th rowspan='2'>Nomor</th>
                <th rowspan='2'>Nama</th>
                <th rowspan='2'>Jenis Kelamin</th>
                <th colspan='{{$pertemuans->count()}}'>Tanggal Pertemuan</th>
                <th colspan='{{$absensis->count()}}'>Total Absensi</th>
            </tr>
            <tr>
                @foreach ($pertemuans as $pertemuan)
                <th>{{$pertemuan->tanggal}}</th>
                @endforeach
                @foreach ($absensis as $absensi)
                <th>{{$absensi->kode}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($siswas as $siswa)
            <tr>
                <td>{{$loop->index}}</td>
                <td>{{$siswa['detail']['firstName']}} {{$siswa['detail']['lastName']}}</td>
                <td>{{$siswa['detail']['jnsKelamin']}}</td>
                @foreach ($siswa['pertemuans'] as $pertemuanHarian)
                <td>{{$pertemuanHarian['absensi']}}</td>
                @endforeach
                @foreach ($absensis as $absensi)
                @if(isset($siswa['rekap'][$absensi->kode]))
                <td>{{$siswa['rekap'][$absensi->kode]}}</td>
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