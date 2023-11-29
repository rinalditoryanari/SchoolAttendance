@extends('index')
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
                    <th class="text-center">Nama Mahasiswa</th>
                    <th class="text-center datatable-nosort">Keterangan Absen</th>
                </tr>
            </thead>
            <tbody>
                <form action="/siswa/presensi" method="post" id="form1">
                    @csrf
                    @foreach ($mahasiswas as $mahasiswa)
                    <tr>
                        <td class="table-plus text-center">{{ $loop->iteration }}</td>
                        <td>{{ $mahasiswa->firstName }} {{ $mahasiswa->lastName }}</td>
                        <td class="text-center">
                            <input type="hidden" name="presensi[{{ $mahasiswa->user->id }}][siswa]" value="{{ $mahasiswa->user->id }}">
                            <select class="form-control" name="presensi[{{ $mahasiswa->user->id }}][kehadiran]" disabled>
                                @if(count($presensi->toArray()) != 0)
                                <option selected hidden value="">{{ $presensi[$loop->index]->absensi->kode }} - {{ $presensi[$loop->index]->absensi->keterangan }}</option>
                                @else
                                <option selected hidden value="">Tidak Absen</option>
                                @endif
                            </select>
                        </td>
                    </tr>
                    @endforeach
                </form>
            </tbody>
        </table>
    </div>

</div>
@endsection