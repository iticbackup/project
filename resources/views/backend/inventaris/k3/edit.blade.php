@extends('layouts.backend.app')
@section('title')
    Inventaris K3 - {{ $inventaris->kode_barcode }} - Edit
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Inventaris K3 - Edit
        @endslot
        @slot('li_3')
            @yield('title')
        @endslot
        @slot('title')
            @yield('title')
        @endslot
    @endcomponent

    <div class="row">
        {{-- Formulir APAR --}}
        <form action="{{ route('inventaris.k3.edit_update',['id' => $inventaris->id]) }}" method="post">
            @csrf
            <?php $roles = \App\Models\Roles::find(auth()->user()->roles); ?>
            @foreach ($inventarisDetails as $inventarisDetail)
                @if ($inventarisDetail->jenis_barang == 'APAR')
                    <div class="col-12">
                        @if (Session::has('success'))
                            <div class="alert custom-alert custom-alert-success icon-custom-alert shadow-sm fade show d-flex justify-content-between"
                                role="alert">
                                <div class="media">
                                    <i class="fa fa-check alert-icon text-success align-self-center font-30 me-3"></i>
                                    <div class="media-body align-self-center">
                                        <h5 class="mb-1 fw-bold mt-0">Success</h5>
                                        <span>{{ session('success') }}</span>
                                    </div>
                                </div>
                                <button type="button" class="btn-close align-self-center" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert custom-alert custom-alert-danger icon-custom-alert shadow-sm fade show d-flex justify-content-between"
                                role="alert">
                                <div class="media">
                                    <i class="fa fa-times alert-icon text-danger align-self-center font-30 me-3"></i>
                                    <div class="media-body align-self-center">
                                        <h5 class="mb-1 fw-bold mt-0">Error</h5>
                                        <span>{{ session('error') }}</span>
                                    </div>
                                </div>
                                <button type="button" class="btn-close align-self-center" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title text-center" style="font-size: 12pt">FORMULIR</div>
                                <div class="card-title text-center" style="font-size: 12pt">CHECK LIST APAR</div>
                                <div class="card-title text-center" style="font-size: 12pt">PERIODE {{ $formApar->periode }}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tabung No. :</label>
                                            <input type="text" name="kode_tabung" class="form-control"
                                                placeholder="Tabung No." value="{{ $formApar->kode_tabung }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Berat :</label>
                                            <input type="text" name="berat" class="form-control" placeholder="Berat"
                                                value="{{ $formApar->berat }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Jenis :</label>
                                            <select name="jenis" class="form-control" id=""
                                                value="{{ $formApar->jenis }}">
                                                <option>-- Pilih --</option>
                                                <option value="Powder" {{ $formApar->jenis == 'Powder' ? 'selected' : '' }}>
                                                    Powder</option>
                                                <option value="CF-21" {{ $formApar->jenis == 'CF-21' ? 'selected' : '' }}>
                                                    CF-21</option>
                                                <option value="Karbon" {{ $formApar->jenis == 'Karbon' ? 'selected' : '' }}>
                                                    Karbon</option>
                                            </select>
                                            {{-- <input type="text" name="jenis" class="form-control" placeholder="Jenis"> --}}
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Expired :</label>
                                            <input type="date" name="expired" class="form-control"
                                                value="{{ $formApar->expired }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Warna :</label>
                                            {{-- <input type="text" name="warna" class="form-control" placeholder="Warna"> --}}
                                            <select name="warna" class="form-control" id="">
                                                <option>-- Pilih Warna --</option>
                                                <option value="Merah" {{ $formApar->warna == 'Merah' ? 'selected' : '' }}>
                                                    Merah</option>
                                                <option value="Biru" {{ $formApar->warna == 'Biru' ? 'selected' : '' }}>
                                                    Biru</option>
                                                <option value="Kuning"
                                                    {{ $formApar->warna == 'Kuning' ? 'selected' : '' }}>Kuning</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tempat :</label>
                                            <input type="text" name="tempat" class="form-control" placeholder="Tempat"
                                                value="{{ $formApar->tempat }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif ($inventarisDetail->jenis_barang == 'HYDRANT')
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title text-center" style="font-size: 12pt">FORMULIR</div>
                                <div class="card-title text-center" style="font-size: 12pt">CHECK LIST HYDRANT</div>
                                <div class="card-title text-center" style="font-size: 12pt">PERIODE
                                    {{ $formHydrant->periode }}</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nomor Hydrant. :</label>
                                            <input type="text" name="kode_hydrant" class="form-control"
                                                placeholder="Nomor Hydrant" value="{{ $formHydrant->kode_hydrant }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Periode :</label>
                                            <input type="text" name="periode" class="form-control"
                                                placeholder="Periode" value="{{ $formHydrant->periode }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Lokasi :</label>
                                            <input type="text" name="lokasi" class="form-control"
                                                placeholder="Lokasi" value="{{ $formHydrant->lokasi }}">
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
                        <button type="submit" class="btn btn-primary btn-icon"><i class="fas fa-upload"></i>
                            Update</button>
                        <a href="{{ route('inventaris.k3') }}" class="btn btn-secondary btn-icon"><i
                                class="fas fa-arrow-left"></i> Back</a>
                    </div>
                </div>
            @endif
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('public/assets/js/app.js') }}"></script>
@endsection
