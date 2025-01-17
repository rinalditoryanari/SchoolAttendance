@extends('index')
@section('content')
<div class="title pb-20">
    <h2 class="h3 mb-0">{{ $title }}</h2>
</div>
<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue h4">Form Kelas</h4>
        </div>
        <div class="pull-right">
        </div>
    </div>
    <form method="POST" action="{{route('admin.kelas.edit', ['kelas'=>$kelas->id])}}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group @error('kode') has-danger @enderror">
                    <label for="kode" class="form-control-label">Kode Kelas</label>
                    <input value="{{ old('kode', $kelas->kode) }}" name="kode" id="kode" type="text" class="form-control @error('kode') form-control-danger @enderror" autofocus required>
                    @error('kode')
                    <div class="form-control-feedback">{{ $message }}</div>
                    @enderror
                    {{-- <small class="form-text text-muted">Example help text that remains unchanged.</small> --}}
                </div>
                <div class="form-group @error('nama') has-danger @enderror">
                    <label for="nama" class="form-control-label">Nama</label>
                    <input value="{{ old('nama', $kelas->nama) }}" name="nama" id="nama" type="nama" class="form-control @error('nama') form-control-danger @enderror" required>
                    @error('nama')
                    <div class="form-control-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-warning">Edit Data</button>
            </div>
        </div>
    </form>
</div>
@endsection