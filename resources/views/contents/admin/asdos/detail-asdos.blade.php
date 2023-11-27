@extends('index')
@section('content')
<div class="title pb-20">
    <h2 class="h3 mb-0">{{ $title }}</h2>
</div>
<div class="card-box mb-30">
    <div class="pd-20 d-flex justify-content-between">
        <h4 class="text-blue h4">Detail guru</h4>
        <div class="dropleft">
            <button type="button" class="btn btn-outline-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-three-dots"></i>
            </button>
            <div class="dropdown-menu">
                <!-- Dropdown menu links -->
                <a class="dropdown-item" href="{{route('admin.asdos.showadd')}}">Tambah</a>
                <a class="dropdown-item" href="{{route('admin.asdos.showedit', ['asdos' => $asdos->id])}}">Edit</a>
                <form action="{{route('admin.asdos.delete', ['asdos' => $asdos->id])}}" method="post">
                    @method('delete')
                    @csrf
                    <button class="dropdown-item" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">Hapus</button>
                </form>
            </div>
            <a class="btn btn-outline-primary" href="{{route('admin.asdos.showall')}}"><i class="bi bi-arrow-return-left"></i></a>
        </div>
    </div>
    <div class="pb-20">
        <table class="table stripe hover data-table-export nowrap">
            <thead>
                <tr>
                    <th class="table-plus datatable-nosort">No.</th>
                    <th class="text-center">Data</th>
                    <th class="text-center">Isi Data</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>NIK :</td>
                    <td>{{ $asdos->nik }}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Nama Depan :</td>
                    <td>{{ $asdos->firstName }}</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Nama Belakang :</td>
                    <td>{{ $asdos->lastName }}</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Nama Dosen :</td>
                    <td>{{ $asdos->dosen->firstName }} {{ $asdos->dosen->lastName }}</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Status :</td>
                    <td>{{ $asdos->status }}</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Jenis Kelamin :</td>
                    <td>{{ $asdos->jns_kelamin }}</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Alamat :</td>
                    <td>{{ $asdos->alamat }}</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Email :</td>
                    <td>{{ $asdos->email }}</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Alamat :</td>
                    <td>{{ $asdos->alamat }}</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>No. Telefon :</td>
                    <td>{{ $asdos->phone }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection