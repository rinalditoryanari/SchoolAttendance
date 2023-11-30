@extends('index')
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
        <form action="{{route('asdos.presensi.absensi')}}" method="post" id="form1">
            @csrf
            @if($pertemuan->keterangan == "masuk")
            <div class="form-group row mb-4 mx-2">
                <label class="col-form-label col-12 col-md-2 col-lg-1 ">Materi</label>
                <div class="col-sm-12 col-md-10 col-lg-11">
                    <select class="form-control" id="materi" name="materi" required <?php echo ($telat) ? 'disabled' : ''; ?>>
                        @if(isset($presensi) != 0)
                        <option selected hidden value="{{ $presensi->materi->id }}">{{ $presensi->materi->materi }}</option>
                        @else
                        <option selected disabled value=""> Pilih MAteri Pembelajaran</option>
                        @endif
                        @foreach ($materis as $materi)
                        <option value="{{ $materi->id }}">{{ $materi->materi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endif
            @if($pertemuan->keterangan == "masuk")
            <div class="form-group row mb-4 mx-2">
                <label class="col-form-label col-12 col-md-2 col-lg-1 ">Waktu Masuk</label>
                <div class="col-sm-4 col-md-3 col-lg-2">
                    <input class="form-control" type="time" name="waktu" id="waktu" value="{{$pertemuan->waktu}}" required <?php echo ($telat) ? 'disabled' : ''; ?>>
                </div>
            </div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort text-center">No.</th>
                        <th class="text-center">Nama Dosen</th>
                        <th class="text-center">Nama Asisten Dosen</th>
                        <th class="text-center datatable-nosort">Keterangan Absen</th>
                    </tr>
                </thead>
                <tbody>
                    <input type="hidden" name="pertemuan" value="{{ $pertemuan->id }}">
                    <input type="hidden" name="mapel" value="{{ $mapel->id }}">
                    <tr>
                        <td class="table-plus text-center">1</td>
                        <td>{{ $asdos->dosen->firstName }} {{ $asdos->dosen->lastName }}</td>
                        <td>{{ $asdos->firstName }} {{ $asdos->lastName }}</td>
                        <td class="text-center">
                            <input type="hidden" name="presensi[asdos]" value="{{ $asdos->user->id }}">
                            @if($presensi AND $presensi->level === 'dosen')
                            <select class="form-control" name="presensi[kehadiran]" disabled>
                                @if(isset($presensi) != 0)
                                <option selected hidden value="{{ $presensi->absensi->id }}">{{ $presensi->absensi->kode }} - {{ $presensi->absensi->keterangan }}</option>
                                @endif
                            </select>
                            @else
                            <select class="form-control" name="presensi[kehadiran]" <?php echo ($telat) ? 'disabled' : ''; ?>>
                                @if(isset($presensi) != 0)
                                <option selected hidden value="{{ $presensi->absensi->id }}">{{ $presensi->absensi->kode }} - {{ $presensi->absensi->keterangan }}</option>
                                @endif
                                <!-- <option selected disabled>Pilih Kehadiran</option> -->
                                @foreach ($absensis as $absensi)
                                <option value="{{ $absensi->id }}">{{ $absensi->kode }} - {{ $absensi->keterangan }}</option>
                                @endforeach
                            </select>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="d-flex justify-content-end m-3">
                @if(!$presensi OR $presensi->level !== 'dosen')
                <button class="btn btn-outline-primary" type="submit" form="form1" value="Submit">Simpan</button>
                @endif
            </div>
        </form>
    </div>

</div>
@endsection