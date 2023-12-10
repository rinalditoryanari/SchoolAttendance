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
                    <th class="table-plus text-center">No.</th>
                    <th class="text-center">NIK</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Posisi</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengajars as $pengajar)
                <tr>
                    <td class="table-plus text-center">{{ $loop->iteration }}</td>
                    <td class="table-plus ">{{ $pengajar->nik }}</td>
                    <td class="table-plus">{{ $pengajar->firstName }} {{ $pengajar->lastName }}</td>
                    <td class="table-plus">{{ ($pengajar->status === 'dosen') ? "Dosen" : "Asisten Dosen" }}</td>
                    <td class="table-plus text-center">
                        <a class="btn btn-outline-primary" href="{{route('admin.gaji.list', ['user' => $pengajar->user_id])}}">Penggajian</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection