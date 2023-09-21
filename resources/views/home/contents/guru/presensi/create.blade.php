@extends('home.index')
@section('content')
<div class="title pb-20">
    <h2 class="h3 mb-0">{{ $title }}</h2>
</div>
<div class="card-box mb-30">
    <div class="card-header d-flex justify-content-between">
        <h4 class="text-blue h4">Tabel Presensi</h4>
        <p>Mapel: {{ $mapel->nama }} | Kelas: {{ $mapel->kelas->nama }}</p>
    </div>
    <div class="card-body ">
        <form action="/guru/presensi" method="post" id="form1">
            @csrf
            @if($pertemuan->keterangan == "masuk")
            <div class="form-group row mb-4 mx-2">
                <label class="col-form-label col-12 col-md-2 col-lg-1 ">Materi</label>
                <div class="col-sm-12 col-md-10 col-lg-11">
                    <input type="textarea" class="form-control" name="materi" value="{{ ($presensi) ? $presensi->materi : ''; }}" <?php echo ($telat) ? 'disabled' : ''; ?> required>
                </div>
            </div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort text-center">No.</th>
                        <th class="text-center">Nama Guru</th>
                        <th class="text-center datatable-nosort">Keterangan Absen</th>
                    </tr>
                </thead>
                <tbody>
                    <input type="hidden" name="pertemuan" value="{{ $pertemuan->id }}">
                    <input type="hidden" name="mapel" value="{{ $mapel->id }}">
                    <tr>
                        <td class="table-plus text-center">1</td>
                        <td>{{ $guru->firstName }} {{ $guru->lastName }}</td>
                        <td class="text-center">
                            <input type="hidden" name="presensi[guru]" value="{{ $guru->id }}">
                            <select class="form-control" name="presensi[kehadiran]" <?php echo ($telat) ? 'disabled' : ''; ?>>
                                @if(count($presensi->toArray()) != 0)
                                <option selected hidden value="{{ $presensi->absensi->id }}">{{ $presensi->absensi->kode }} - {{ $presensi->absensi->keterangan }}</option>
                                @endif
                                <!-- <option selected disabled>Pilih Kehadiran</option> -->
                                @foreach ($absensis as $absensi)
                                <option value="{{ $absensi->id }}">{{ $absensi->kode }} - {{ $absensi->keterangan }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="d-flex justify-content-end m-3">
                <button class="btn btn-outline-primary" type="submit" form="form1" value="Submit">Simpan</button>
            </div>
        </form>
    </div>

</div>
@endsection