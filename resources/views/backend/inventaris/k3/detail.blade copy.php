@extends('layouts.backend.app')
@section('title') Inventaris K3 - {{ $inventaris->kode_barcode }} @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Inventaris K3 @endslot
@slot('li_3') @yield('title') @endslot
@slot('title') @yield('title') @endslot
@endcomponent

<div class="row">
    {{-- Formulir APAR --}}
    <form action="#" method="post">
    @csrf
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-center" style="font-size: 12pt">FORMULIR</div>
                <div class="card-title text-center" style="font-size: 12pt">CHECK LIST APAR</div>
                {{-- <button type="button" class="btn btn-primary" onclick="buat()" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fas fa-plus"></i> Tambah</button>
                <button type="button" class="btn btn-primary" onclick="reload()"><i class="fas fa-undo"></i> Refresh</button>
                <a href="{{ route('inventaris.k3.printBarcode') }}" class="btn btn-primary"><i class="fas fa-print"></i> Print Barcode</a> --}}
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="" method="post">
                        @csrf
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Tabung No. :</label>
                                <input type="text" name="kode_tabung" class="form-control" placeholder="Tabung No.">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Berat :</label>
                                <input type="text" name="berat" class="form-control" placeholder="Berat">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis :</label>
                                <input type="text" name="jenis" class="form-control" placeholder="Jenis">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Expired :</label>
                                <input type="date" name="expired" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Warna :</label>
                                <input type="text" name="warna" class="form-control" placeholder="Warna">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Tempat :</label>
                                <input type="text" name="tempat" class="form-control" placeholder="Tempat">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary btn-icon">Submit</button>
                            </div>
                        </div>
                    </form>
                    {{-- <div class="col-12">
                        <div class="mb-3">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0 table-centered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 2.5%">NO</th>
                                            <th class="text-center" style="width: 5%">BULAN</th>
                                            <th class="text-center" style="width: 5%">TGL.</th>
                                            <th class="text-center" style="width: 5%">PRESS</th>
                                            <th class="text-center" style="width: 5%">NOZZEL</th>
                                            <th class="text-center" style="width: 5%">SEGEL</th>
                                            <th class="text-center" style="width: 5%">TUAS</th>
                                            <th class="text-center" style="width: 5%">KET.</th>
                                            <th class="text-center" style="width: 5%">TTD.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($form_aparts as $key => $form_apart)
                                        <tr>
                                            <td>{{ $form_apart['no'] }}</td>
                                            <td>{{ $form_apart['bulan'] }}</td>
                                            <td><input type="date" name="tanggal[]" class="form-control" placeholder="Tanggal"></td>
                                            <td>
                                                <select name="pressure[]" class="form-control" id="">
                                                    <option>-- Status --</option>
                                                    <option value="Y">Ya</option>
                                                    <option value="N">Tidak</option>
                                                </select>
                                            </td>
                                            <td><input type="text" name="nozzel[]" class="form-control" placeholder="NOZZEL"></td>
                                            <td><input type="text" name="segel[]" class="form-control" placeholder="SEGEL"></td>
                                            <td><input type="text" name="tuas[]" class="form-control" placeholder="TUAS"></td>
                                            <td><input type="text" name="keterangan[]" class="form-control" placeholder="Keterangan"></td>
                                            <td><input type="text" name="ttd[]" class="form-control" placeholder="TTD"></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            {{-- <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-icon">Submit</button>
            </div> --}}
        </div>
    </div>
    </form>

    {{-- Formulir Hydrant --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-center" style="font-size: 12pt">FORMULIR</div>
                <div class="card-title text-center" style="font-size: 12pt">CHECK LIST HYDRANT</div>
                {{-- <button type="button" class="btn btn-primary" onclick="buat()" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fas fa-plus"></i> Tambah</button>
                <button type="button" class="btn btn-primary" onclick="reload()"><i class="fas fa-undo"></i> Refresh</button>
                <a href="{{ route('inventaris.k3.printBarcode') }}" class="btn btn-primary"><i class="fas fa-print"></i> Print Barcode</a> --}}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Nomor Hydrant. :</label>
                            <input type="text" name="kode_tabung" class="form-control" placeholder="Nomor Hydrant">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Periode :</label>
                            <input type="text" name="periode" class="form-control" placeholder="Periode">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Lokasi :</label>
                            <input type="text" name="lokasi" class="form-control" placeholder="Lokasi">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0 table-centered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 2.5%" rowspan="2">NO</th>
                                            <th class="text-center" style="width: 5%" rowspan="2">BULAN</th>
                                            <th class="text-center" style="width: 5%" rowspan="2">TGL.</th>
                                            <th class="text-center" style="width: 5%" colspan="2">SELANG</th>
                                            <th class="text-center" style="width: 5%" colspan="2">KRAN</th>
                                            <th class="text-center" style="width: 5%" colspan="2">NOZZEL</th>
                                            <th class="text-center" style="width: 5%" rowspan="2">CHECKER</th>
                                            <th class="text-center" style="width: 5%" rowspan="2">KETERANGAN</th>
                                            {{-- <th class="text-center" style="width: 5%">NOZZEL</th>
                                            <th class="text-center" style="width: 5%">SEGEL</th>
                                            <th class="text-center" style="width: 5%">TUAS</th>
                                            <th class="text-center" style="width: 5%">KET.</th>
                                            <th class="text-center" style="width: 5%">TTD.</th> --}}
                                        </tr>
                                        <tr>
                                            <th class="text-center">Besar</th>
                                            <th class="text-center">Kecil</th>
                                            <th class="text-center">Besar</th>
                                            <th class="text-center">Kecil</th>
                                            <th class="text-center">Besar</th>
                                            <th class="text-center">Kecil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($form_aparts as $key => $form_apart)
                                        <tr>
                                            <td>{{ $form_apart['no'] }}</td>
                                            <td>{{ $form_apart['bulan'] }}</td>
                                            <td><input type="date" name="tanggal[]" class="form-control" placeholder="Tanggal"></td>
                                            <td>
                                                <select name="pressure[]" class="form-control" id="">
                                                    <option>-- Status --</option>
                                                    <option value="Y">Ya</option>
                                                    <option value="N">Tidak</option>
                                                </select>
                                            </td>
                                            <td><input type="text" name="nozzel[]" class="form-control" placeholder="NOZZEL"></td>
                                            <td><input type="text" name="segel[]" class="form-control" placeholder="SEGEL"></td>
                                            <td><input type="text" name="tuas[]" class="form-control" placeholder="TUAS"></td>
                                            <td><input type="text" name="keterangan[]" class="form-control" placeholder="Keterangan"></td>
                                            <td><input type="text" name="ttd[]" class="form-control" placeholder="TTD"></td>
                                        </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection