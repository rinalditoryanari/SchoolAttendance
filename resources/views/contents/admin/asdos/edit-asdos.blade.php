@extends('index')
@section('content')
<div class="title pb-20">
    <h2 class="h3 mb-0">{{ $title }}</h2>
</div>
<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue h4">Form Asisten Dosen</h4>
        </div>
        <div class="pull-right">
        </div>
    </div>
    <form method="POST" action="{{route('admin.asdos.edit', ['asdos' => $asdos->id])}}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group @error('nik') has-danger @enderror">
                    <label for="nik" class="form-control-label">NIK</label>
                    <input value="{{ old('nik', $asdos->nik) }}" name="nik" id="nik" type="text" class="form-control @error('nik') form-control-danger @enderror" autofocus required>
                    @error('nik')
                    <div class="form-control-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group @error('password') has-danger @enderror">
                    <label for="password" class="form-control-label">Password</label>
                    <input name="password" id="password" type="password" class="form-control @error('password') form-control-danger @enderror" required>
                    @error('password')
                    <div class="form-control-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group @error('firstName') has-danger @enderror">
                    <label for="firstName" class="form-control-label">Nama Depan Siswa</label>
                    <input value="{{ old('firstName', $asdos->firstName) }}" required name="firstName" id="firstName" type="text" class="form-control @error('firstName') form-control-danger @enderror">
                    @error('firstName')
                    <div class="form-control-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group @error('lastName') has-danger @enderror">
                    <label for="lastName" class="form-control-label">Nama Belakang Siswa</label>
                    <input value="{{ old('lastName', $asdos->lastName) }}" required name="lastName" id="lastName" type="text" class="form-control @error('lastName') form-control-danger @enderror">
                    @error('lastName')
                    <div class="form-control-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-danger">Harus diisi</small>
                </div>
                <div class="form-group @error('status') has-danger @enderror">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="selectpicker form-control" data-style="btn-outline-primary">
                        <option selected disabled hidden>Pilih Status...</option>
                        <option {{ $asdos->status == 'mahasiswa' ? 'selected' : '' }} value="mahasiswa">Mahasiswa</option>
                        <option {{ $asdos->status == 'non mahasiswa' ? 'selected' : '' }} value="non mahasiswa">Non Mahasiswa</option>
                    </select>
                    @error('status')
                    <div class="form-control-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group @error('dosen_id') has-danger @enderror">
                    <label for="dosen_id">Dosen</label>
                    <select name="dosen_id" id="dosen_id" class="selectpicker form-control" data-style="btn-outline-primary">
                        <option selected disabled hidden>Pilih Dosen...</option>
                        @foreach($dosens as $dosen)
                        <option {{ old('dosen_id', $asdos->dosen_id)==$dosen->id  ? 'selected' : '' }} value="{{ $dosen->id }}">{{ $dosen ->firstName }} {{ $dosen ->lastName }} </option>
                        @endforeach
                    </select>
                    @error('dosen_id')
                    <div class="form-control-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group @error('jns_kelamin') has-danger @enderror">
                    <label for="jns_kelamin">Jenik Kelamin</label>
                    <select name="jns_kelamin" id="jns_kelamin" class="selectpicker form-control" data-style="btn-outline-primary">
                        <option selected disabled hidden>Pilih Jenik Kelamin...</option>
                        <option {{ old('jns_kelamin', $asdos->jns_kelamin) == 'Laki-laki' ? 'selected' : '' }} value="Laki-laki">Laki-laki</option>
                        <option {{ old('jns_kelamin', $asdos->jns_kelamin) == 'Perempuan' ? 'selected' : '' }} value="Perempuan">Perempuan</option>
                    </select>
                    @error('jns_kelamin')
                    <div class="form-control-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group @error('alamat') has-danger @enderror">
                    <label for="alamat" class="form-control-label">Alamat</label>
                    <input value="{{ old('alamat', $asdos->alamat) }}" name="alamat" id="alamat" type="text" class="form-control @error('alamat') form-control-danger @enderror">
                    @error('alamat')
                    <div class="form-control-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group @error('phone') has-danger @enderror">
                    <label for="phone" class="form-control-label">No. Telefon Ortu</label>
                    <input placeholder="0812-3456-7891" value="{{ old('phone', $asdos->phone) }}" name="phone" id="phone" type="tel" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}" class="form-control @error('phone') form-control-danger @enderror">
                    @error('phone')
                    <div class="form-control-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group @error('email') has-danger @enderror">
                    <label for="email" class="form-control-label">Alamat Email Ortu</label>
                    <input value="{{ old('email', $asdos->email) }}" name="email" id="email" type="text" class="form-control @error('email') form-control-danger @enderror">
                    @error('email')
                    <div class="form-control-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-warning">Edit Data</button>
            </div>
        </div>
    </form>
</div>
@endsection