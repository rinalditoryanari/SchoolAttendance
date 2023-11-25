@extends('index')
@section('content')
<div class="title pb-20">
    <h2 class="h3 mb-0">{{ $title }}</h2>
</div>
<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue h4">Form Mapel</h4>
        </div>
        <div class="pull-right">
        </div>
    </div>
    <form method="POST" action="{{route('admin.mapel.add')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group @error('kelas_id') has-danger @enderror">
                    <label for="kelas_id">Kelas Mapel</label>
                    <select required name="kelas_id" id="kelas_id" class="selectpicker form-control" data-style="btn-outline-primary">
                        <option selected disabled hidden>Pilih Kelas Mapel...</option>
                        @foreach ($kelas as $kelas)
                        @if (old('kelas_id') == $kelas->id)
                        <option value="{{ $kelas->id }}" selected>{{ $kelas->nama }}</option>
                        @else
                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('kelas_id')
                    <div class="form-control-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-danger">Harus diisi</small>
                </div>
                <div class="form-group @error('dosen_id') has-danger @enderror">
                    <label for="dosen_id">Dosen Mapel</label>
                    <select required name="dosen_id" id="dosen_id" class="selectpicker form-control" data-style="btn-outline-primary">
                        <option selected disabled hidden>Pilih Dosen Mapel...</option>
                        @foreach ($dosens as $dosen)
                        @if (old('dosen_id') == $dosen->id)
                        <option value="{{ $dosen->id }}" selected>Bpk/Ibu {{ $dosen->firstName }} {{ $dosen->lastName }}</option>
                        @else
                        <option value="{{ $dosen->id }}">Bpk/Ibu {{ $dosen->firstName }} {{ $dosen->lastName }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('dosen_id')
                    <div class="form-control-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-danger">Harus diisi</small>
                </div>
                <div class="form-group @error('kode') has-danger @enderror">
                    <label for="kode" class="form-control-label">Kode Mapel</label>
                    <input value="{{ old('kode') }}" name="kode" id="kode" type="text" class="form-control @error('kode') form-control-danger @enderror" autofocus required>
                    @error('kode')
                    <div class="form-control-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-danger">Harus diisi</small>
                </div>
                <div class="form-group @error('nama') has-danger @enderror">
                    <label for="nama" class="form-control-label">Nama Mapel</label>
                    <input value="{{ old('nama') }}" name="nama" id="nama" type="text" class="form-control @error('nama') form-control-danger @enderror" required>
                    @error('nama')
                    <div class="form-control-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-danger">Harus diisi</small>
                </div>

                <button type="submit" class="btn btn-primary">Tambahkan Data</button>
            </div>
        </div>
    </form>
</div>
@endsection