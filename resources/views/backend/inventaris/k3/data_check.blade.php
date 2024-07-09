@extends('layouts.backend.app')
@section('title')
    Data Pengecekkan
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Inventaris
        @endslot
        @slot('li_3')
            @yield('title')
        @endslot
        @slot('title')
            @yield('title')
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Kode</th>
                                    <th rowspan="2">Location</th>
                                    <th colspan="4">Fire Extinguisher Condition</th>
                                </tr>
                                <tr>
                                    <th>Press</th>
                                    <th>Nozzle</th>
                                    <th>Segel</th>
                                    <th>Tuas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventaris_k3_apars as $key => $inventaris_k3_apar)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $inventaris_k3_apar->kode_barcode }}</td>
                                    <td>{{ $inventaris_k3_apar->lokasi }}</td>
                                    @foreach ($inventaris_k3_apar->inventaris_k3_detail as $key_inventaris_k3_detail => $inventaris_k3_detail)
                                        {{-- @dd($inventaris_k3_detail->detail_form_apar->detail_form_apart_detail) --}}
                                    <td>
                                        @if (empty($inventaris_k3_detail->detail_form_apar->detail_form_apart_detail))
                                        -
                                        @else
                                        {{ $inventaris_k3_detail->detail_form_apar->detail_form_apart_detail }}
                                        @endif
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                                {{-- @foreach ($inventaris_k3s as $key => $inventaris_k3)
                                    <tr>
                                        <td rowspan="{{ $inventaris_k3->inventaris_k3_detail->count()+1 }}">{{ $key+1 }}</td>
                                        <td rowspan="{{ $inventaris_k3->inventaris_k3_detail->count()+1 }}">{{ $inventaris_k3->kode_barcode }}</td>
                                        <td rowspan="{{ $inventaris_k3->inventaris_k3_detail->count()+1 }}">{{ $inventaris_k3->lokasi }}</td>
                                    </tr>
                                    @foreach ($inventaris_k3->inventaris_k3_detail as $key_inventaris_k3_detail => $inventaris_k3_detail)
                                    <tr>
                                        <td>{{ $inventaris_k3_detail->jenis_barang }}</td>
                                    </tr>
                                    @endforeach
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
