@extends('index')
@section('content')
<div class="title pb-20">
    <h2 class="h3 mb-0">{{ $title }}</h2>
</div>
<div class="card-box mb-30">
    <div class="pd-20">
        <h4 class="text-blue h4">Tabel Mapel</h4>
    </div>
    <div class="pb-2">
        <form class="mx-4" action="{{route('dosen.sks.show')}}" method="get">
            @csrf
            <div class="">
                @error('mapel')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @enderror
                <div class="form-group row mb-4">
                    <label class="col-form-label col-12 col-md-2 col-lg-2">Tanggal Awal</label>
                    <div class="col-sm-12 col-md-4 col-lg-3 mb-2">
                        <input type="date" class="choose form-control" id="tglawal" name="tglawal" value="{{($tanggal) ? $tanggal['tglawal'] : null}}">
                    </div>

                    <label class="col-form-label col-12 col-md-2 col-lg-2">Tanggal Akhir</label>
                    <div class="col-sm-12 col-md-4 col-lg-3 mb-2">
                        <input type="date" class="choose form-control" id="tglakhir" name="tglakhir" value="{{($tanggal) ? $tanggal['tglakhir'] : null}}">
                    </div>

                    <div class="d-flex justify-content-end col-12 col-lg-2 mb-2">
                        <button class="btn btn-outline-info" type="submit" id="btn-lihat">Lihat</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <div class="pb-20">
        <table class="data-table table stripe hover nowrap">
            <thead>
                <tr>
                    <th class="table-plus datatable-nosort text-center">No.</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Waktu</th>
                    <th class="text-center">Mapel - Kelas</th>
                    <th class="text-center">Pengajar</th>
                    <th class="text-center">SKS</th>
                    <th class="text-center">Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                @if($pertemuans)
                @foreach($pertemuans as $pertemuan)
                <tr>
                    <td class="table-plus text-center">{{ $loop->iteration }}</td>
                    <td class="table-plus text-center">{{ $pertemuan->tanggal }}</td>
                    <td class="table-plus text-center">{{ $pertemuan->waktu }}</td>
                    <td class="table-plus">{{ $pertemuan->mapel->nama }} - {{$pertemuan->mapel->kelas->nama}}</td>
                    <td class="table-plus">{{$pertemuan->nama}}</td>
                    <td class="table-plus text-center">{{ $pertemuan->sks }}</td>
                    <td class="table-plus text-center">{{ $pertemuan->presensi}}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection