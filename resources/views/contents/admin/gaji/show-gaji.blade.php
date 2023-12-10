@extends('index')
@section('content')
<div class="title pb-20">
    <h2 class="h3 mb-0">{{ $title }}</h2>
</div>
<div class="card-box mb-30">
    <div class="pd-20">
        <h4 class="text-blue h4">Tabel Mapel</h4>
    </div>
    <div class="pb-2">
        <form class="mx-4" action="{{route('admin.gaji.list', ['user' => $user->id])}}" method="get">
            @csrf
            <div class="">
                @error('error')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @enderror
                <div class="form-group row mb-4">
                    <form action="{{route('admin.gaji.list', ['user' => $user->id])}}" method="get">
                        @csrf
                        <label class="col-form-label col-12 col-md-2 col-lg-2">Bulan</label>
                        <div class="col-sm-12 col-md-4 col-lg-3 mb-2">
                            <select name="bulan" id="bulan" class='form-control' required>
                                <option value="" hidden>Pilih Bulan</option>
                                <option value="1" {{($input['bulan'] == '1')? 'selected' : '' }}>Januari</option>
                                <option value="2" {{($input['bulan'] == '2')? 'selected' : '' }}>Februari</option>
                                <option value="3" {{($input['bulan'] == '3')? 'selected' : '' }}>Maret</option>
                                <option value="4" {{($input['bulan'] == '4')? 'selected' : '' }}>April</option>
                                <option value="5" {{($input['bulan'] == '5')? 'selected' : '' }}>Mei</option>
                                <option value="6" {{($input['bulan'] == '6')? 'selected' : '' }}>Juni</option>
                                <option value="7" {{($input['bulan'] == '7')? 'selected' : '' }}>Juli</option>
                                <option value="8" {{($input['bulan'] == '8')? 'selected' : '' }}>Agustus</option>
                                <option value="9" {{($input['bulan'] == '9')? 'selected' : '' }}>September</option>
                                <option value="10" {{($input['bulan'] == '10')? 'selected' : '' }}>Oktober</option>
                                <option value="11" {{($input['bulan'] == '11')? 'selected' : '' }}>November</option>
                                <option value="12" {{($input['bulan'] == '12')? 'selected' : '' }}>December</option>
                            </select>
                        </div>

                        <label class=" col-form-label col-12 col-md-2 col-lg-2">Tahun</label>
                        <div class="col-sm-12 col-md-4 col-lg-3 mb-2">
                            <select name="tahun" id="tahun" class='form-control' required>
                                @if($input)
                                <option value="{{$input['tahun']}}" hidden selected>{{$input['tahun']}}</option>
                                @endif

                                <option value="" hidden>Pilih Tahun</option>
                                @foreach($tahuns as $tahun)
                                <option value="{{$tahun}}" {{($input['tahun'] == $tahun)? 'selected' : '' }}>{{$tahun}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class=" d-flex justify-content-end col-12 col-lg-2 mb-2">
                            <button class="btn btn-outline-info" type="submit" id="btn-lihat">Lihat</button>
                        </div>
                    </form>
                </div>

            </div>
        </form>
    </div>
    <div class="pb-20">
        <table class="data-table table stripe hover nowrap">
            <thead>
                <tr>
                    <th class="table-plus datatable-nosort text-center">No.</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Waktu</th>
                    <th class="text-center">Mapel - Kelas</th>
                    <th class="text-center">SKS</th>
                    <th class="text-center">Tipe</th>
                    <th class="text-center">Nominal</th>
                    <th class="text-center">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @if($data != null)
                @foreach($data['details'] as $detail)
                <tr>
                    <th class="table-plus datatable-nosort text-center">{{$loop->iteration}}</th>
                    <th class="text-start">{{$detail->tanggal}}</th>
                    <th class="text-center">{{$detail->waktu}}</th>
                    <th class="text-start">{{$detail->mapelkelas}}</th>
                    <th class="text-center">{{$detail->sks}}</th>
                    <th class="text-left">{{$detail->tipe}}</th>
                    <th class="text-right">@currency($detail->nominal)</th>
                    <th class="text-left">{{$detail->keterangan}}</th>
                </tr>
                @endforeach
                <tr>
                    <th class="table-plus datatable-nosort text-center">0</th>
                    <th class="text-start"></th>
                    <th class="text-center"></th>
                    <th class="text-start"></th>
                    <th class="text-right"></th>
                    <th class="text-left">Total</th>
                    <th class="text-right">@currency($data['total'])</th>
                    <th class="text-left"></th>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection