@extends('index')
@section('content')
<div class="title pb-20">
    <h2 class="h3 mb-0">{{ $title }}</h2>
</div>
<div class="card-box mb-30">
    <div class="pd-20">
        <h4 class="text-blue h4">Tabel Mapel</h4>
    </div>
    <div class="pb-20">
        <table class="data-table table stripe hover nowrap">
            <thead>
                <tr>
                    <th class="table-plus datatable-nosort text-center">No.</th>
                    <th class="text-center">Mapel</th>
                    <th class="text-center">Dosen</th>
                    <th class="text-center">Kelas</th>
                    <th class="text-center">Minimal Kehadiran</th>
                    <th class="text-center">SKS</th>
                    <th class="text-center datatable-nosort">Lanjutkan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mapels as $mapel)
                <tr>
                    <td class="table-plus text-center">{{ $loop->iteration }}</td>
                    <td>{{ $mapel->nama }}</td>
                    <td>{{ $mapel->dosen->firstName }} {{ $mapel->dosen->lastName }}</td>
                    <td class="table-plus text-center">{{ $mapel->kelas->nama }}</td>
                    <td class="table-plus text-center">{{ $mapel->presensi_count . "/"}}{{($mapel->min_pertemuan == null) ? 0 : $mapel->min_pertemuan}}</td>
                    <td class="table-plus text-center">{{ $mapel->sks_count }}</td>
                    <td class="text-center">
                        <a href="{{route('dosen.presensi.detail', ['mapel' => $mapel->id] )}}" class="btn btn-sm btn-outline-primary">Pilih</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection