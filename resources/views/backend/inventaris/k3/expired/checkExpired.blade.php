@extends('layouts.backend.app')
@section('title')
    {{-- Inventaris K3 - {{ $inventaris->kode_barcode }} --}}
    Pengecekkan APAR
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Pengecekkan APAR
        @endslot
        @slot('li_3')
            @yield('title')
        @endslot
        @slot('title')
            @yield('title')
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@yield('title')</h4>
                </div>
                <div class="card-body">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Jenis Barang</th>
                                    <td>:</td>
                                    <td>{{ $inventaris_k3_detail->jenis_barang }}</td>
                                </tr>
                                <tr>
                                    <th>Status Barang</th>
                                    <td>:</td>
                                    <td>{!! $inventaris_k3_detail->status == 'Y' ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Tidak Aktif</span>' !!}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-center">Detail Pengecekkan</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <a href="{{ route('inventaris.k3.check_expired_create',['id' => $inventaris_k3_detail->inventaris_k3_id]) }}" class="btn btn-primary">Buat Baru</a>
                                </div>
                                <div class="row">
                                    @foreach ($form_aparts as $form_apart)
                                    <div class="col-md-4">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th style="background-color: #DDDDDD; color: #000">Kode Tabung</th>
                                                <td class="text-center">:</td>
                                                <td>{{ $form_apart->kode_tabung }}</td>
                                            </tr>
                                            <tr>
                                                <th style="background-color: #DDDDDD; color: #000">Lokasi</th>
                                                <td class="text-center">:</td>
                                                <td>{{ $form_apart->tempat }}</td>
                                            </tr>
                                            <tr>
                                                <th style="background-color: #DDDDDD; color: #000">Jenis</th>
                                                <td class="text-center">:</td>
                                                <td>{{ $form_apart->jenis }}</td>
                                            </tr>
                                            <tr>
                                                <th style="background-color: #DDDDDD; color: #000">Warna</th>
                                                <td class="text-center">:</td>
                                                <td>{{ $form_apart->warna }}</td>
                                            </tr>
                                            <tr>
                                                <th style="background-color: #DDDDDD; color: #000">Berat</th>
                                                <td class="text-center">:</td>
                                                <td>{{ $form_apart->berat }}</td>
                                            </tr>
                                            <tr>
                                                <th style="background-color: #DDDDDD; color: #000">Periode</th>
                                                <td class="text-center">:</td>
                                                <td>{{ $form_apart->periode }}</td>
                                            </tr>
                                            <tr>
                                                <th style="background-color: #DDDDDD; color: #000">Expired</th>
                                                <td class="text-center">:</td>
                                                <td>
                                                    @php
                                                        $date = \Carbon\Carbon::now()->format('Y-m-d');
                                                        if ($form_apart->expired >= $date) {
                                                            $start = $date;
                                                            $end = $form_apart->expired;
                                                            // $check = \Carbon\CarbonPeriod::create($start, $end, \Carbon\CarbonPeriod::EXCLUDE_END_DATE);
                                                            $check = \Carbon\Carbon::create($start)->floatDiffInDays($end);
                                                            $status = '<span class="badge bg-danger">'.$check.' Day</span>';
                                                        }else{
                                                            $status = 'Expired';
                                                        }
                                                    @endphp
                                                    {!! \Carbon\Carbon::create($form_apart->expired)->isoFormat('DD MMMM YYYY').' '.$status !!}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="background-color: #DDDDDD; color: #000">Status</th>
                                                <td class="text-center">:</td>
                                                <td>{!! $form_apart->status == 'Y' ? '<span class="badge bg-primary">Aktif</span>' : '<span class="badge bg-success">Close Periode</span>' !!}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    @endforeach
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
<script src="{{ URL::asset('public/assets/js/app.js') }}"></script>
@endsection