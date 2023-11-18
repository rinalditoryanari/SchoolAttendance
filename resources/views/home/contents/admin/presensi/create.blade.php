@extends('home.index')
@section('content')
<div class="title pb-20">
    <h2 class="h3 mb-0">{{ $title }}</h2>
</div>
<div class="card-box mb-30">
    <div class="card-header d-flex justify-content-between">
        <h4 class="text-blue h4">Tambah Presensi</h4>
    </div>

    <div class="card-body ">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form class="mx-4" action="/admin/presensi/tambah" method="post">
            @csrf
            <div class="pb-4">
                @error('mapel')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @enderror
                <div class="form-group row mb-4">
                    <label class="col-form-label col-12 col-md-2 col-lg-1 ">Mapel</label>
                    <div class="col-sm-12 col-md-10 col-lg-11">
                        <select class="form-control" id="mapel" name="mapel">
                            <option selected disabled value=""> Pilih Mata Pelajaran - Kelas - Guru</option>
                            @foreach ($mapels as $mapel)
                            <option value="{{ $mapel->id }}" text="{{ $mapel->kode }} - {{ $mapel->kelas->nama }} - {{ $mapel->nama }} - {{ $mapel->user->firstName }} {{ $mapel->user->lastName }}">{{ $mapel->kode }} - {{ $mapel->kelas->nama }} - {{ $mapel->nama }} - {{ $mapel->user->firstName }} {{ $mapel->user->lastName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label col-12 col-md-2 col-lg-1 ">Minimal Pertemuan</label>
                    <div class="col-sm-6 col-md-5 col-lg-5">
                        <input type="number" class="form-control" name="min_pertemuan" id="min_pertemuan" required>
                    </div>
                </div>
            </div>

            <!-- PERTEMUAN -->
            <div class="pb-4">
                <div class="mb-4">
                    <div class="card-title">
                        <h4 class="h5">Tambah Pertemuan</h4>
                    </div>
                    <div class="form-group row mb-4">

                        <label class="col-form-label col-12 col-md-2 col-lg-1">Tanggal</label>
                        <div class="col-sm-12 col-md-4 col-lg-5 mb-2">
                            <input type="date" class="choose form-control" id="tanggal" name="tanggal">
                        </div>

                        <label class="col-form-label col-12 col-md-2 col-lg-1">SKS</label>
                        <div class="col-sm-12 col-md-4 col-lg-5 mb-2">
                            <input type="number" class="choose form-control" id="sks" name="sks">
                        </div>


                        <label class="col-form-label col-12 col-md-2 col-lg-1" hidden>Id</label>
                        <div class="col-sm-12 col-md-4 col-lg-5" hidden>
                            <input type="text" class="choose form-control" id="id" name="id">
                        </div>

                        <div class="d-flex justify-content-end col-12 p-2">
                            <button class="btn btn-outline-warning mx-2" type="button" id="btn-pertemuan-kosong">Kosongkan</button>
                            <button class="btn btn-outline-info mx-2" type="button" id="btn-pertemuan-tambah">Tambah</button>
                            <button class="btn btn-outline-info mx-2" type="button" id="btn-pertemuan-edit" hidden>Edit</button>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="card-title">
                        <h4 class="h5">Jadwal Pertemuan</h4>
                    </div>
                    @error('pertemuan')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @enderror
                    <div class="" id="pertemuan-table"></div>
                </div>
            </div>

            <!-- MATERI -->
            <div class="pb-4">
                <div class="mb-4">
                    <div class="card-title">
                        <h4 class="h5">Tambah Materi Pembelajaran</h4>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label col-12 col-md-2 col-lg-1" hidden>Id</label>
                        <div class="col-sm-12 col-md-4 col-lg-5" hidden>
                            <input type="text" class="choose form-control" id="id-materi" name="id-materi">
                        </div>
                        <label class="col-form-label col-12 col-md-2 col-lg-1">Materi</label>
                        <div class="d-flex justify-content-between col-12 col-md-10 col-lg-11">
                            <input type="textarea" class="choose form-control" id="materi" name="materi">
                            <button class="btn btn-outline-warning" type="button" id="btn-materi-kosong">Kosongkan</button>
                            <button class="btn btn-outline-info" type="button" id="btn-materi-tambah">Tambah</button>
                            <button class="btn btn-outline-info" type="button" id="btn-materi-edit" hidden>Edit</button>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="card-title">
                        <h4 class="h5">Materi Pembelajaran</h4>
                    </div>
                    @error('materi')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @enderror
                    <div class="" id="materi-table"></div>
                </div>
                <div id="table"></div>
            </div>

            <!-- SUBMIT -->
            <div class="d-flex justify-content-end m-3">
                <button class="btn btn-primary" type="submit" value="Submit">Simpan</button>
            </div>
        </form>
    </div>

</div>
@endsection

@push('scripts')
<script src="{{ asset('src/scripts/admin-addAbsen.js') }}"></script>
<script src="{{ asset('src/scripts/admin-addMateri.js') }}"></script>

@endpush