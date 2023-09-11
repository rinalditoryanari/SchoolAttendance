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
                    <th class="text-center">Nama Guru</th>
                    <th class="text-center datatable-nosort">Keterangan Absen</th>
                </tr>
            </thead>
            <tbody>
                <form action="/guru/presensi" method="post" id="form1">
                    @csrf
                    <input type="hidden" name="pertemuan" value="{{ $pertemuan->id }}">
                    <input type="hidden" name="mapel" value="{{ $mapel->id }}">
                    <tr>
                        <td class="table-plus text-center">1</td>
                        <td>{{ $guru->firstName }} {{ $guru->lastName }}</td>
                        <td class="text-center">
                            <select class="form-control" name="presensi[kehadiran]" disabled>
                                @if($presensi)
                                <option selected hidden value="">{{ $presensi->absensi->kode }} - {{ $presensi->absensi->keterangan }}</option>
                                @else
                                <option selected hidden value="">Tidak Absen</option>
                                @endif
                            </select>
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>

</div>
@endsection