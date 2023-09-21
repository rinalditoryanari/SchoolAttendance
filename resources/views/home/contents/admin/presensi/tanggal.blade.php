@extends('home.index')
@section('content')
<div class="title pb-20">
    <h2 class="h3 mb-0">{{ $title }}</h2>
</div>
<div class="card-box mb-30">
    <div class="card-header d-flex justify-content-between">
        <h4 class="text-blue h4">Tabel Pilih Presensi</h4>
        <div class=" d-flex justify-content-end">
            <a href="/admin/presensi/{{$mapel->id}}/rekap/guru" class="btn btn-sm btn-outline-info">Rekap Guru</a>
            <a href="/admin/presensi/{{$mapel->id}}/rekap/siswa" class="btn btn-sm btn-outline-primary">Rekap Siswa</a>
        </div>
    </div>
    <div class="card-body ">
        <table class="data-table table stripe hover nowrap">
            <thead>
                <tr>
                    <th class="table-plus datatable-nosort text-center">No.</th>
                    <th class="text-center">Kelas</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Mapel</th>
                    <th class="text-center">Guru</th>
                    <th class="text-center">Ket.</th>
                    <th class="text-center datatable-nosort">Lanjutkan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pertemuans as $pertemuan)
                <tr>
                    <td class="table-plus text-center">{{ $loop->iteration }}</td>
                    <td>{{ $pertemuan->mapel->kelas->nama }}</td>
                    <td>{{ \Carbon\Carbon::parse($pertemuan->tanggal . ' ' . $pertemuan->waktu)->format('l, j F Y H:i') }}</td>
                    <td>{{ $pertemuan->mapel->kode }} - {{ $pertemuan->mapel->nama }}</td>
                    <td>{{ $pertemuan->mapel->user->firstName }} {{ $pertemuan->mapel->user->lastName }}</td>
                    <td>{{ $pertemuan->keterangan }}</td>
                    <td class="text-center">
                        <a href="/admin/presensi/{{$pertemuan->mapel->id}}/{{$pertemuan->id}}/guru" class="btn btn-sm btn-outline-primary">Guru</a>
                        <a href="/admin/presensi/{{$pertemuan->mapel->id}}/{{$pertemuan->id}}/siswa" class="btn btn-sm btn-outline-primary">Siswa</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection