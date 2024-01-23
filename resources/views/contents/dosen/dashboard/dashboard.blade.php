@extends('index')
@section('content')
<div class="title pb-20">
    <h2 class="h3 mb-0">{{ $title }}</h2>
</div>

<div class="row pb-10">
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">{{ $mahasiswa }}</div>
                    <div class="font-14 text-secondary weight-500">Total Mahasiswa</div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#00eccf"><i class="icon-copy dw dw-monkey"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">{{ $kelas }}</div>
                    <div class="font-14 text-secondary weight-500">Total Kelas</div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#ff5b5b"><span class="icon-copy dw dw-school"></span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">{{ $dosen }}</div>
                    <div class="font-14 text-secondary weight-500">Total Dosen</div>
                </div>
                <div class="widget-icon">
                    <div class="icon"><i class="icon-copy dw dw-user3" aria-hidden="true"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">{{ $mapel }}</div>
                    <div class="font-14 text-secondary weight-500">Total Mapel</div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#09cc06"><i class="icon-copy dw dw-open-book" aria-hidden="true"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card-box pb-10">
    <div class="h5 pd-20 mb-0">Mahasiswa Tidak Hadir</div>
    <table class="table hover data-table-export nowrap">
        <thead>
            <tr>
                <th class="table-plus text-center">No.</th>
                <th class="text-center">Nama Mahasiswa</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Kelas Mahasiswa</th>
                <th class="text-center">Mapel</th>
                <th class="text-center">Dosen</th>
                <th class="text-center">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presensis as $presensi)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $presensi->mahasiswa->firstName }} {{ $presensi->mahasiswa->lastName }}</td>
                <td>{{ $presensi->absensi->keterangan }}</td>
                <td>{{ $presensi->pertemuan->mapel->kelas->nama }}</td>
                <td>{{ $presensi->pertemuan->mapel->nama }}</td>
                <td>{{ $presensi->pertemuan->mapel->dosen->firstName }} {{ $presensi->pertemuan->mapel->dosen->lastName }} </td>
                <td>{{ $presensi->pertemuan->tanggal }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection