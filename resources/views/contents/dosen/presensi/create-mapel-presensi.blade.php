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
        <form action="{{route('dosen.presensi.absensi')}}" method="post" id="form1">
            @csrf
            @if($pertemuan->keterangan == "masuk")
            <div class="form-group row mb-4 mx-2">
                <label class="col-form-label col-12 col-md-2 col-lg-1 ">Materi</label>
                <div class="col-sm-12 col-md-10 col-lg-11">
                    <select class="form-control" id="materi" name="materi" required <?php echo ($telat) ? 'disabled' : ''; ?>>
                        @if($presensiDosen != null)
                        <option selected hidden value="{{ $presensiDosen->materi->id }}">{{ $presensiDosen->materi->materi }}</option>
                        @elseif($presensiAsdos != null)
                        <option selected hidden value="{{ $presensiAsdos->materi->id }}">{{ $presensiAsdos->materi->materi }}</option>
                        @else
                        <option selected disabled value=""> Pilih MAteri Pembelajaran</option>
                        @foreach ($materis as $materi)
                        <option value="{{ $materi->id }}">{{ $materi->materi }}</option>
                        @endforeach
                        @endif
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

                    <!-- For Dosen -->
                    <tr>
                        <td class="table-plus text-center"></td>
                        <td>{{ $dosen->firstName }} {{ $dosen->lastName }}</td>
                        <td></td>
                        <td class="text-center">
                            <input type="hidden" name="presensi[dosen]" value="{{ $dosen->user->id }}">
                            <select class="form-control" name="presensi[kehadiran]" <?php echo ($telat) ? 'disabled' : ''; ?>>
                                <!-- <option selected disabled>Pilih Kehadiran</option> -->
                                @foreach ($absensis as $absensi)
                                @if($presensiAsdos != null && $absensi->id == 2)
                                @else
                                <option value="{{ $absensi->id }}" {{($presensiDosen != null && $presensiDosen->absensi_id === $absensi->id)? 'selected':''}}>{{ $absensi->kode }} - {{ $absensi->keterangan }}</option>
                                @endif
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    @if($presensiAsdos != null )
                    <!-- For Asdos -->
                    <tr>
                        <td class="table-plus text-center"></td>
                        <td>{{ $dosen->firstName }} {{ $dosen->lastName }}</td>
                        <td>{{ $presensiAsdos->user->firstName }} {{ $presensiAsdos->user->lastName }}</td>
                        <td>
                            <select class="form-control" name="" disabled>
                                <option selected hidden>{{ $presensiAsdos->absensi->kode }} - {{ $presensiAsdos->absensi->keterangan }}</option>
                            </select>
                        </td>
                    </tr>
                    @endif

                </tbody>
            </table>

            <div class="d-flex justify-content-end m-3">
                <button class="btn btn-outline-primary" type="submit" form="form1" value="Submit" <?php echo ($telat) ? 'hidden' : ''; ?>>Simpan</button>
            </div>
        </form>
    </div>

</div>
@endsection