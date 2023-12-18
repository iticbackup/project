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
    <form action="{{ route('inventaris.k3.detail.simpan',['id' => $inventaris->id]) }}" method="post">
    @csrf
    <?php $roles = \App\Models\Roles::find(auth()->user()->roles); ?>
    @foreach ($inventarisDetails as $inventarisDetail)
    @if ($inventarisDetail->jenis_barang == "APAR")
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-center" style="font-size: 12pt">FORMULIR</div>
                <div class="card-title text-center" style="font-size: 12pt">CHECK LIST APAR</div>
            </div>
            <div class="card-body">
                <div class="row">
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
                            <select name="jenis" class="form-control" id="">
                                <option value="0">-- Pilih --</option>
                                <option value="Powder">Powder</option>
                                <option value="CF-21">CF-21</option>
                                <option value="Karbon">Karbon</option>
                            </select>
                            {{-- <input type="text" name="jenis" class="form-control" placeholder="Jenis"> --}}
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
                            {{-- <input type="text" name="warna" class="form-control" placeholder="Warna"> --}}
                            <select name="warna" class="form-control" id="">
                                <option value="0">-- Pilih Warna --</option>
                                <option value="Merah">Merah</option>
                                <option value="Biru">Biru</option>
                                <option value="Kuning">Kuning</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Tempat :</label>
                            <input type="text" name="tempat" class="form-control" placeholder="Tempat" readonly value="{{ $inventaris->lokasi }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @elseif ($inventarisDetail->jenis_barang == "HYDRANT")
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-center" style="font-size: 12pt">FORMULIR</div>
                <div class="card-title text-center" style="font-size: 12pt">CHECK LIST HYDRANT</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Nomor Hydrant. :</label>
                            <input type="text" name="kode_hydrant" class="form-control" placeholder="Nomor Hydrant">
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
                            <input type="text" name="lokasi" class="form-control" placeholder="Lokasi" readonly value="{{ $inventaris->lokasi }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    @endforeach
    @if ($roles->id != 3)
    <div class="col-12">
        <div class="mb-3">
            <button type="submit" class="btn btn-primary btn-icon">Submit</button>
        </div>
    </div>
    @endif
    </form>
</div>
@endsection

@section('script')
<script src="{{ URL::asset('public/assets/js/app.js') }}"></script>

@endsection