@extends('index')
@section('content')
<div class="title pb-20">
    <h2 class="h3 mb-0">{{ $title }}</h2>
</div>
<div class="card-box mb-30">
    <div class="card-header d-flex justify-content-between">
        <h4 class="text-blue h4">Tabel Presensi</h4>
        <p>Nama: {{ $dosen->firstName}} {{ $dosen->lastName}} | Mapel: {{ $mapel->nama }} | Kelas: {{ $mapel->kelas->nama }}</p>
    </div>
    <div class="card-body ">
        <table class="table">
            <thead>
                <tr>
                    <th class="table-plus datatable-nosort text-center">No.</th>
                    <th class="text-center">Tanggal - Waktu</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center datatable-nosort">Keterangan Absen</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pertemuans as $pertemuan)
                <tr>
                    <td class="table-plus text-center">{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($pertemuan['detail']['tanggal'] . ' ' . $pertemuan['detail']['waktu'])->format('l, j F Y H:i') }}</td>
                    <td>{{ $pertemuan['detail']['keterangan'] }}</td>
                    <td class="text-center">
                        <select class="form-control" disabled>
                            <option selected hidden value="">{{ $pertemuan['absensi'] }}</option>
                        </select>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection