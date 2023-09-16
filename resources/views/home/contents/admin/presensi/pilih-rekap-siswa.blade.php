@extends('home.index')
@section('content')
<div class="title pb-20">
    <h2 class="h3 mb-0">{{ $title }}</h2>
</div>
<div class="card-box mb-30">
    <div class="pd-20 d-flex justify-content-between">
        <h4 class="text-blue h4">Tabel Presensi</h4>
        <p>Mapel: {{ $mapel->nama }} | Kelas: {{ $mapel->kelas->nama }}</p>
    </div>
    <div class="pb-20">
        <table class="table">
            <thead>
                <tr>
                    <th class="table-plus datatable-nosort text-center">No.</th>
                    <th class="text-center">Nama Siswa</th>
                    <th class="text-center datatable-nosort">Rekap Absen</th>
                </tr>
            </thead>
            <tbody>
                <form action="/siswa/presensi" method="post" id="form1">
                    @csrf
                    @foreach ($siswas as $siswa)
                    <tr>
                        <td class="table-plus text-center">{{ $loop->iteration }}</td>
                        <td>{{ $siswa->firstName }} {{ $siswa->lastName }}</td>
                        <td class="text-center">
                            <a href="/admin/presensi/{{$mapel->id}}/rekap/siswa/{{$siswa->id}}" class="btn btn-sm btn-outline-primary">Lihat Rekap Siswa</a>
                        </td>
                    </tr>
                    @endforeach
                </form>
            </tbody>
        </table>
    </div>

</div>
@endsection