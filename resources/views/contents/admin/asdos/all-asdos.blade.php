@extends('index')
@section('content')
<div class="title pb-20">
    <h2 class="h3 mb-0">{{ $title }}</h2>
</div>
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="card-box mb-30">
    <div class="pd-20 d-flex justify-content-between">
        <h4 class="text-blue h4">Table Asisten Dosen</h4>
        <div>
            <a class="btn btn-primary" href="{{ route('admin.asdos.showadd')}}">Tambah Data Asisten Dosen</a>
        </div>
        <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Import Data Asisten Dosen</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-20">
        <table class="table stripe hover data-table-export nowrap">
            <thead>
                <tr>
                    <th class="table-plus datatable-nosort">No.</th>
                    <th class="text-center">NIK</th>
                    <th class="text-center">Nama Asdos</th>
                    <th class="text-center">Nama Asisten Dosen</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($asdoss as $asdos)
                <tr>
                    <td class="table-plus text-center">{{ $loop->iteration }}</td>
                    <td>{{ $asdos->nik }}</td>
                    <td>{{ $asdos->dosen->firstName }} {{ $asdos->dosen->lastName }}</td>
                    <td>{{ $asdos->firstName }} {{ $asdos->lastName }}</td>
                    <td>{{ $asdos->email }}</td>
                    <td class="text-center">
                        <div class="dropleft">
                            <button type="button" class="btn btn-outline-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <div class="dropdown-menu">
                                <!-- Dropdown menu links -->
                                <!-- <a class="dropdown-item" href="/admin/asdos/{{ $asdos->id }}/rekap/excel">Export Rekap Absen as Excel</a>
                                <a class="dropdown-item" href="/admin/asdos/{{ $asdos->id }}/rekap/pdf">Export Rekap Absen as PDF</a> -->
                                <a class="dropdown-item" href="{{route('admin.asdos.detail' , ['asdos' => $asdos->id])}}">Detail</a>
                                <a class="dropdown-item" href="{{route('admin.asdos.showedit', ['asdos' => $asdos->id])}}">Edit</a>
                                <form action="{{route('admin.asdos.delete', ['asdos' => $asdos->id])}}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button class="dropdown-item" onclick="return confirm('Apakah anda yakin akan menghapus data Asisten Dosen ini?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection