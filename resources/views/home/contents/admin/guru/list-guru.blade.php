@extends('home.index')
@section('content')
<div class="title pb-20">
    <h2 class="h3 mb-0">{{ $title }}</h2>
</div>
<div class="card-box mb-30">
    <div class="pd-20 d-flex justify-content-between">
        <h4 class="text-blue h4">Tabel Guru</h4>
        {{--<a href="" class="btn btn-sm btn-outline-primary">Tambah</a>--}}
    </div>
    <div class="pb-20">
        <table class="data-table table">
            <thead>
                <tr>
                    <th class="table-plus datatable-nosort text-center">No.</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Nik</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Jenis Kelamin</th>
                    <th class="text-center">Kontak</th>
                    <th class="text-center datatable-nosort">Rekap Absen</th>
                    {{--<th class="text-center">Aksi</th>--}}
                </tr>
            </thead>
            <tbody>
                @foreach ($gurus as $guru)
                <tr>
                    <td class="table-plus text-center">{{ $loop->iteration }}</td>
                    <td>{{ $guru->firstName }} {{ $guru->lastName }}</td>
                    <td>{{ $guru->nik }}</td>
                    <td>{{ $guru->email }}</td>
                    <td>{{ $guru->jns_kelamin }}</td>
                    <td>{{ $guru->phone }}</td>
                    <td class="text-center">
                        <a href="/admin/guru/{{$guru->id}}/rekap/excel" class="btn btn-sm btn-outline-primary">Excel</a>
                        <a href="/admin/guru/{{$guru->id}}/rekap/pdf" class="btn btn-sm btn-outline-primary">PDF</a>
                    </td>
                    {{-- <td class="text-center">
                        <a href="" class="btn btn-sm btn-outline-primary">Edit</a>
                        <a href="" class="btn btn-sm btn-outline-primary">Hapus</a>
                    </td>--}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection