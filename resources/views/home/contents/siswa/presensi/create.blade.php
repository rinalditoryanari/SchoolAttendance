@extends('home.index1')
@section('content1')
<div class="title pb-20">
    <h2 class="h3 mb-0">{{ $title }}</h2>
</div>
<div class="card-box mb-30">
    <div class="card-header d-flex justify-content-between">
        <h4 class="text-blue h4">Tabel Presensi</h4>
        <p>Mapel: {{ $mapel->nama }} | Kelas: {{ $mapel->kelas->nama }}</p>
    </div>
    <div class="card-body ">
        @if($pertemuan->keterangan == "masuk")
        <div class="form-group row mb-4 mx-2">
            <label class="col-form-label col-12 col-md-2 col-lg-1 ">Mapel</label>
            <div class="col-sm-12 col-md-10 col-lg-11">
                <input type="textarea" class="form-control" name="materi" value="{{ $materi->materi }}" disabled>
            </div>
        </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th class="table-plus datatable-nosort text-center">No.</th>
                    <th class="text-center">Nama Siswa</th>
                    <th class="text-center datatable-nosort">Keterangan Absen</th>
                </tr>
            </thead>
            <tbody>
                <form action="/siswa/presensi" method="post" id="form1">
                    @csrf
                    <input type="hidden" name="pertemuan" value="{{ $pertemuan->id }}">
                    <input type="hidden" name="mapel" value="{{ $mapel->id }}">
                    @foreach ($siswas as $siswa)
                    <tr>
                        <td class="table-plus text-center">{{ $loop->iteration }}</td>
                        <td>{{ $siswa->firstName }} {{ $siswa->lastName }}</td>
                        <td class="text-center">
                            <input type="hidden" name="presensi[{{ $siswa->id }}][siswa]" value="{{ $siswa->id }}">
                            <select class="form-control" name="presensi[{{ $siswa->id }}][kehadiran]" <?php echo ($telat) ? 'disabled' : ''; ?>>
                                @if(count($presensi->toArray()) != 0)
                                <option selected hidden value="{{ $presensi[$loop->index]->absensi->id }}">{{ $presensi[$loop->index]->absensi->kode }} - {{ $presensi[$loop->index]->absensi->keterangan }}</option>
                                @endif
                                <!-- <option selected disabled>Pilih Kehadiran</option> -->
                                @foreach ($absensis as $absensi)
                                <option value="{{ $absensi->id }}">{{ $absensi->kode }} - {{ $absensi->keterangan }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    @endforeach
                </form>
            </tbody>
        </table>

        <div class="d-flex justify-content-end m-3">
            <button class="btn btn-outline-primary" type="submit" form="form1" value="Submit">Simpan</button>
        </div>
    </div>

</div>
@endsection