@extends('layouts.backend.app')
@section('title')
    Inventaris K3 - {{ $inventaris->kode_barcode }}
@endsection

@section('css')
    <link href="{{ URL::asset('public/assets/css/iziToast.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('public/assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('public/assets/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css">

    <style>
        @media screen and (max-width: 900px) {
            th {
                height: 50px;
            }

            td {
                height: 50px;
            }
        }
    </style>
@endsection

<?php 
    $openinventarisk3 = env('OPEN_INVENTARIS_K3');
    // dd(date("h:i:s"));
    // if($openinventarisk3 == "yes"){
    //     $status = '"yes"';
    // }else{
    //     $status = 'false';
    // }
?>

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Inventaris K3 - Form
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
            @if ($openinventarisk3 == "yes")
            <div class="alert custom-alert custom-alert-primary icon-custom-alert shadow-sm fade show d-flex justify-content-between" role="alert">  
                <div class="media">
                    <i class="la la-exclamation-triangle alert-icon text-primary align-self-center font-30 me-3"></i>
                    <div class="media-body align-self-center">
                        <h5 class="mb-1 fw-bold mt-0">Informasi !</h5>
                        <span>Silakan input data sesuai periode bulan. Jika telah selesai input data, silakan hubungi HRGA. Sistem akan menutup secara otomatis jika terlambat dalam pengisian data.
                        </span>
                    </div>
                </div>                                  
                {{-- <button type="button" class="btn-close align-self-center" data-bs-dismiss="alert" aria-label="Close"></button> --}}
            </div>
            @endif
            <a href="{{ route('inventaris.scan') }}" class="btn btn-primary btn-icon mb-4"><i class="fa fa-qrcode"></i> Scan
                Baru</a>
            <a href="{{ route('inventaris.k3') }}" class="btn btn-primary btn-icon mb-4"><i class="fa fa-arrow-left"></i> Back</a>
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
        </div>
        <form action="{{ route('inventaris.k3.detail.form.update', ['id' => $inventaris->id]) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @foreach ($inventarisDetails as $inventarisDetail)
                <?php
                $formApar = \App\Models\FormApart::where('inventaris_k3_detail_id', $inventarisDetail->id)
                    ->where('status', 'Y')
                    ->first();
                // dd($formApar);
                $formHydrant = \App\Models\FormHydrant::where('inventaris_k3_detail_id', $inventarisDetail->id)
                    ->where('status', 'Y')
                    ->first();
                // dd($formApar->created_at->format('Y'));
                // $date_created_at_apar = $formApar->created_at->format('Y');
                // $date_created_at_hydrant = $formHydrant->created_at->format('Y');
                ?>
                @if ($inventarisDetail->jenis_barang == 'APAR')
                <?php
                $formAparDetails = \App\Models\FormApartDetail::where('form_apart_id', $formApar->id)
                    ->orderBy('bulan', 'asc')
                    ->get();
                // dd($formAparDetails);
                ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title text-center" style="font-size: 12pt">FORMULIR</div>
                                <div class="card-title text-center" style="font-size: 12pt">CHECK LIST APAR</div>
                                <div class="card-title text-center" style="font-size: 12pt">PERIODE :
                                    {{ $formApar->periode }}</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tabung No. :</label>
                                            <input type="text" name="form_kode_tabung" class="form-control"
                                                value="{{ $formApar->kode_tabung }}" readonly placeholder="Tabung No.">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Berat :</label>
                                            <input type="text" name="form_berat" class="form-control"
                                                value="{{ $formApar->berat }}" readonly placeholder="Berat">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Jenis :</label>
                                            <input type="text" name="form_jenis" class="form-control"
                                                value="{{ $formApar->jenis }}" readonly placeholder="Jenis">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Expired :</label>
                                            <input type="date" name="form_expired" class="form-control"
                                                value="{{ $formApar->expired }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Warna :</label>
                                            <input type="text" name="form_warna" class="form-control"
                                                value="{{ $formApar->warna }}" readonly placeholder="Warna">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tempat :</label>
                                            <input type="text" name="form_tempat" class="form-control"
                                                value="{{ $formApar->tempat }}" readonly placeholder="Tempat">
                                        </div>
                                    </div>
                                    <div class="col-12">
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
                                                            <th class="text-center" style="width: 5%">BUKTI FOTO</th>
                                                            <th class="text-center" style="width: 5%">KET.</th>
                                                            <th class="text-center" style="width: 5%">PETUGAS.</th>
                                                            @if (auth()->user()->roles != 3)
                                                                @if ($UserManagement->c == 'Y')
                                                                    <th class="text-center" style="width: 5%">VERIFIKASI
                                                                    </th>
                                                                @endif
                                                            @else
                                                                <th class="text-center" style="width: 5%">STATUS
                                                                    PERSETUJUAN</th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($formAparDetails as $key => $formAparDetail)
                                                            <?php
                                                            $explode_bulan = explode('|', $formAparDetail->bulan);
                                                            $bulan_aktif = $explode_bulan[0] . '|' . $explode_bulan[1];
                                                            $continueDate = \Carbon\Carbon::now()->isoFormat('MM|MMMM');

                                                            $explode_tgl = explode('|', $formAparDetail->bulan);
                                                            $tgl_old = $explode_bulan[0] . '|' . $explode_bulan[1] . '|' .$explode_bulan[2];
                                                            $backDate = \Carbon\Carbon::now()->subMonth()->isoFormat('MM|MMMM|YYYY');
                                                            // dd($backDate);
                                                            ?>
                                                            <tr>
                                                                <td class="text-center">
                                                                    {{-- {{ $formAparDetail->id }} --}}
                                                                    {{ $key + 1 }}
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                        <input type="hidden" name="id_apar"
                                                                        class="id_apar"
                                                                        value="{{ $formAparDetail->id }}" required>
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            <input type="hidden" name="id_apar"
                                                                                class="id_apar"
                                                                                value="{{ $formAparDetail->id }}" required>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td>{{ $explode_bulan[1] }}</td>
                                                                <td class="text-center" style="width: 5%">
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                            @if (empty($formAparDetail->tanggal))
                                                                                <input type="date" class="form-control"
                                                                                placeholder="Tanggal" name="tanggal_apar"
                                                                                required>
                                                                            @else
                                                                            {{ \Carbon\Carbon::create($formAparDetail->tanggal)->format('d-m-Y H:i:s') }}
                                                                            @endif
                                                                        @elseif($tgl_old <= $backDate)
                                                                            @if (empty($formAparDetail->tanggal))
                                                                                -
                                                                            @else
                                                                            {{ \Carbon\Carbon::create($formAparDetail->tanggal)->format('d-m-Y H:i:s') }}
                                                                            @endif
                                                                        @else
                                                                            @if (!empty($formAparDetail->tanggal))
                                                                                {{ \Carbon\Carbon::create($formAparDetail->tanggal)->format('d-m-Y H:i:s') }}
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            @if ($formAparDetail->tanggal != null)
                                                                                {{ \Carbon\Carbon::create($formAparDetail->tanggal)->format('d-m-Y H:i:s') }}
                                                                            @else
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Tanggal" readonly
                                                                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                                    required>
                                                                            @endif
                                                                        @else
                                                                            @if ($formAparDetail->tanggal)
                                                                                {{ \Carbon\Carbon::parse($formAparDetail->tanggal)->format('d-m-Y H:i:s') }}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                            @if (empty($formAparDetail->pressure))
                                                                            <select name="apar_pressure"
                                                                                class="form-control" id=""
                                                                                required>
                                                                                <option>-- Status --</option>
                                                                                <option value="Y">Normal</option>
                                                                                <option value="N">Tidak</option>
                                                                                <option value="-">-</option>
                                                                            </select>
                                                                            @else
                                                                                @if ($formAparDetail->pressure == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @endif
                                                                        @elseif($tgl_old <= $backDate)
                                                                            @if (!empty($formAparDetail->pressure))
                                                                                @if ($formAparDetail->pressure == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                            -
                                                                            @endif
                                                                        @else
                                                                            @if (!empty($formAparDetail->pressure))
                                                                                @if ($formAparDetail->pressure == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            @if ($formAparDetail->pressure != null)
                                                                                {{-- {{ $formAparDetail->pressure }} --}}
                                                                                @if ($formAparDetail->pressure == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                <select name="apar_pressure"
                                                                                    class="form-control" id=""
                                                                                    required>
                                                                                    <option>-- Status --</option>
                                                                                    <option value="Y">Normal</option>
                                                                                    <option value="N">Tidak</option>
                                                                                    <option value="-">-</option>
                                                                                </select>
                                                                            @endif
                                                                        @else
                                                                            @if ($formAparDetail->pressure)
                                                                                {{-- {{ $formAparDetail->pressure }} --}}
                                                                                @if ($formAparDetail->pressure == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                            @if (empty($formAparDetail->nozzel))
                                                                            <select name="apar_nozzel"
                                                                                class="form-control" id=""
                                                                                required>
                                                                                <option>-- Status --</option>
                                                                                <option value="Y">Normal</option>
                                                                                <option value="N">Tidak</option>
                                                                                <option value="-">-</option>
                                                                            </select>
                                                                            @else
                                                                                @if ($formAparDetail->nozzel == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @endif
                                                                        @elseif ($tgl_old <= $backDate)
                                                                            @if (!empty($formAparDetail->nozzel))
                                                                                @if ($formAparDetail->nozzel == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @else
                                                                            @if (!empty($formAparDetail->nozzel))
                                                                                @if ($formAparDetail->nozzel == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            @if ($formAparDetail->nozzel != null)
                                                                                {{-- {{ $formAparDetail->nozzel }} --}}
                                                                                @if ($formAparDetail->nozzel == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                <select name="apar_nozzel"
                                                                                    class="form-control" id=""
                                                                                    required>
                                                                                    <option>-- Status --</option>
                                                                                    <option value="Y">Normal</option>
                                                                                    <option value="N">Tidak</option>
                                                                                    <option value="-">-</option>
                                                                                </select>
                                                                            @endif
                                                                        @else
                                                                            @if ($formAparDetail->nozzel)
                                                                                {{-- {{ $formAparDetail->nozzel }} --}}
                                                                                @if ($formAparDetail->nozzel == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                            @if (empty($formAparDetail->segel))
                                                                            <select name="apar_segel" class="form-control"
                                                                                id="" required>
                                                                                <option>-- Status --</option>
                                                                                <option value="Y">Normal</option>
                                                                                <option value="N">Tidak</option>
                                                                                <option value="-">-</option>
                                                                            </select>
                                                                            @else
                                                                                @if ($formAparDetail->segel == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @endif
                                                                        @elseif ($tgl_old <= $backDate)
                                                                            @if (!empty($formAparDetail->segel))
                                                                                @if ($formAparDetail->segel == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @else
                                                                            @if (!empty($formAparDetail->segel))
                                                                                @if ($formAparDetail->segel == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            @if ($formAparDetail->segel != null)
                                                                                {{-- {{ $formAparDetail->segel }} --}}
                                                                                @if ($formAparDetail->segel == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                <select name="apar_segel" class="form-control"
                                                                                    id="" required>
                                                                                    <option>-- Status --</option>
                                                                                    <option value="Y">Normal</option>
                                                                                    <option value="N">Tidak</option>
                                                                                    <option value="-">-</option>
                                                                                </select>
                                                                            @endif
                                                                        @else
                                                                            @if ($formAparDetail->segel)
                                                                                {{-- {{ $formAparDetail->segel }} --}}
                                                                                @if ($formAparDetail->segel == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                            @if (empty($formAparDetail->tuas))
                                                                            <select name="apar_tuas" class="form-control"
                                                                                id="" required>
                                                                                <option>-- Status --</option>
                                                                                <option value="Y">Normal</option>
                                                                                <option value="N">Tidak</option>
                                                                                <option value="-">-</option>
                                                                            </select>
                                                                            @else
                                                                                @if ($formAparDetail->tuas == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @endif
                                                                        @elseif ($tgl_old <= $backDate)
                                                                            @if (!empty($formAparDetail->tuas))
                                                                                @if ($formAparDetail->tuas == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @else
                                                                            @if (!empty($formAparDetail->tuas))
                                                                                @if ($formAparDetail->tuas == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            @if ($formAparDetail->tuas != null)
                                                                                {{-- {{ $formAparDetail->tuas }} --}}
                                                                                @if ($formAparDetail->tuas == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                <select name="apar_tuas" class="form-control"
                                                                                    id="" required>
                                                                                    <option>-- Status --</option>
                                                                                    <option value="Y">Normal</option>
                                                                                    <option value="N">Tidak</option>
                                                                                    <option value="-">-</option>
                                                                                </select>
                                                                            @endif
                                                                        @else
                                                                            @if ($formAparDetail->tuas)
                                                                                {{-- {{ $formAparDetail->tuas }} --}}
                                                                                @if ($formAparDetail->tuas == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                            @if (empty($formAparDetail->images))
                                                                            <input type="file" name="apar_images"
                                                                            class="form-control aparImages">
                                                                            @else
                                                                            <div class="modal fade"
                                                                                id="view_apar{{ $key+1 }}" tabindex="-1"
                                                                                role="dialog"
                                                                                aria-labelledby="exampleModalCenterTitle"
                                                                                aria-hidden=""yes"">
                                                                                <div class="modal-dialog modal-dialog-centered"
                                                                                    role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h6 class="modal-title m-0"
                                                                                                id="exampleModalCenterTitle">
                                                                                                {{ $formAparDetail->images }}
                                                                                            </h6>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12">
                                                                                                    <img src="{{ asset('public/berkas_k3/' . $formAparDetail->images) }}"
                                                                                                        alt="{{ $formAparDetail->images }}"
                                                                                                        width="250">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <button type="button"
                                                                                class="btn btn-primary btn-xs"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#view_apar{{ $key+1 }}">
                                                                                <i class="far fa-eye"></i> View Images
                                                                            </button>
                                                                            @endif
                                                                        @elseif ($tgl_old <= $backDate)
                                                                            @if ($formAparDetail->images != null)
                                                                            <div class="modal fade"
                                                                                id="view_apar{{ $key+1 }}" tabindex="-1"
                                                                                role="dialog"
                                                                                aria-labelledby="exampleModalCenterTitle"
                                                                                aria-hidden=""yes"">
                                                                                <div class="modal-dialog modal-dialog-centered"
                                                                                    role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h6 class="modal-title m-0"
                                                                                                id="exampleModalCenterTitle">
                                                                                                {{ $formAparDetail->images }}
                                                                                            </h6>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12">
                                                                                                    <img src="{{ asset('public/berkas_k3/' . $formAparDetail->images) }}"
                                                                                                        alt="{{ $formAparDetail->images }}"
                                                                                                        width="250">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <button type="button"
                                                                                class="btn btn-primary btn-xs"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#view_apar{{ $key+1 }}">
                                                                                <i class="far fa-eye"></i> View Images
                                                                            </button>
                                                                            @else
                                                                            -
                                                                            @endif
                                                                        @else
                                                                            @if ($formAparDetail->images != null)
                                                                            <div class="modal fade"
                                                                                id="view_apar{{ $key+1 }}" tabindex="-1"
                                                                                role="dialog"
                                                                                aria-labelledby="exampleModalCenterTitle"
                                                                                aria-hidden=""yes"">
                                                                                <div class="modal-dialog modal-dialog-centered"
                                                                                    role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h6 class="modal-title m-0"
                                                                                                id="exampleModalCenterTitle">
                                                                                                {{ $formAparDetail->images }}
                                                                                            </h6>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12">
                                                                                                    <img src="{{ asset('public/berkas_k3/' . $formAparDetail->images) }}"
                                                                                                        alt="{{ $formAparDetail->images }}"
                                                                                                        width="250">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <button type="button"
                                                                                class="btn btn-primary btn-xs"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#view_apar{{ $key+1 }}">
                                                                                <i class="far fa-eye"></i> View Images
                                                                            </button>
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            @if ($formAparDetail->images != null)
                                                                                <div class="modal fade"
                                                                                    id="view_apar{{ $key+1 }}" tabindex="-1"
                                                                                    role="dialog"
                                                                                    aria-labelledby="exampleModalCenterTitle"
                                                                                    aria-hidden=""yes"">
                                                                                    <div class="modal-dialog modal-dialog-centered"
                                                                                        role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h6 class="modal-title m-0"
                                                                                                    id="exampleModalCenterTitle">
                                                                                                    {{ $formAparDetail->images }}
                                                                                                </h6>
                                                                                                <button type="button"
                                                                                                    class="btn-close"
                                                                                                    data-bs-dismiss="modal"
                                                                                                    aria-label="Close"></button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <div class="row">
                                                                                                    <div class="col-lg-12">
                                                                                                        <img src="{{ asset('public/berkas_k3/' . $formAparDetail->images) }}"
                                                                                                            alt="{{ $formAparDetail->images }}"
                                                                                                            width="250">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <button type="button"
                                                                                    class="btn btn-primary btn-xs"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#view_apar{{ $key+1 }}">
                                                                                    <i class="far fa-eye"></i> View Images
                                                                                </button>
                                                                                {{-- {{ $formAparDetail->images }} --}}
                                                                            @else
                                                                                <input type="file" name="apar_images"
                                                                                    class="form-control aparImages" required>
                                                                            @endif
                                                                        @else
                                                                            @if ($formAparDetail->images)
                                                                                {{-- {{ $formAparDetail->images }} --}}
                                                                                <div class="modal fade"
                                                                                    id="view_apar{{ $key+1 }}" tabindex="-1"
                                                                                    role="dialog"
                                                                                    aria-labelledby="exampleModalCenterTitle"
                                                                                    aria-hidden=""yes"">
                                                                                    <div class="modal-dialog modal-dialog-centered"
                                                                                        role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h6 class="modal-title m-0"
                                                                                                    id="exampleModalCenterTitle">
                                                                                                    {{ $formAparDetail->images }}
                                                                                                </h6>
                                                                                                <button type="button"
                                                                                                    class="btn-close"
                                                                                                    data-bs-dismiss="modal"
                                                                                                    aria-label="Close"></button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <div class="row">
                                                                                                    <div class="col-lg-12">
                                                                                                        <img src="{{ asset('public/berkas_k3/' . $formAparDetail->images) }}"
                                                                                                            alt="{{ $formAparDetail->images }}"
                                                                                                            width="250">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <button type="button"
                                                                                    class="btn btn-primary btn-xs"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#view_apar{{ $key+1 }}">
                                                                                    <i class="far fa-eye"></i> View Images
                                                                                </button>
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                            @if (empty($formAparDetail->keterangan))
                                                                            <textarea name="apar_keterangan" class="form-control aparKeterangan" id="" cols="30" rows="2" required></textarea>
                                                                            @else
                                                                            {{ $formAparDetail->keterangan }}
                                                                            @endif
                                                                        @elseif($tgl_old <= $backDate)
                                                                            @if ($formAparDetail->keterangan != null)
                                                                                {{ $formAparDetail->keterangan }}
                                                                            @else
                                                                            -
                                                                            @endif
                                                                        @else
                                                                            @if ($formAparDetail->keterangan != null)
                                                                                {{ $formAparDetail->keterangan }}
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            @if ($formAparDetail->keterangan != null)
                                                                                {{ $formAparDetail->keterangan }}
                                                                            @else
                                                                                {{-- <input type="text" name="apar_keterangan"
                                                                                    class="form-control aparKeterangan"
                                                                                    placeholder="Keterangan" required> --}}
                                                                                <textarea name="apar_keterangan" class="form-control aparKeterangan" id="" cols="30" rows="2" required></textarea>
                                                                            @endif
                                                                        @else
                                                                            @if ($formAparDetail->keterangan)
                                                                                {{ $formAparDetail->keterangan }}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                            @if (empty($formAparDetail->ttd))
                                                                            <input type="text" name="apar_ttd"
                                                                            class="form-control" placeholder="TTD"
                                                                            value="{{ auth()->user()->name }}"
                                                                            readonly>
                                                                            @else
                                                                            {{ $formAparDetail->ttd }}
                                                                            @endif
                                                                        @elseif($tgl_old <= $backDate)
                                                                            @if ($formAparDetail->ttd != null)
                                                                                {{ $formAparDetail->ttd }}
                                                                            @else
                                                                            -
                                                                            @endif
                                                                        @else
                                                                            @if ($formAparDetail->ttd != null)
                                                                                {{ $formAparDetail->ttd }}
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            @if ($formAparDetail->ttd != null)
                                                                                {{ $formAparDetail->ttd }}
                                                                            @else
                                                                                <input type="text" name="apar_ttd"
                                                                                    class="form-control" placeholder="TTD"
                                                                                    value="{{ auth()->user()->name }}"
                                                                                    readonly>
                                                                            @endif
                                                                        @else
                                                                            @if ($formAparDetail->ttd)
                                                                                {{ $formAparDetail->ttd }}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                @if (auth()->user()->roles != 3)
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                        <td class="text-center">
                                                                            @if (empty($formAparDetail->status))
                                                                                @if ($formAparDetail->status == '0' || $formAparDetail->status == null)
                                                                                    @if ($UserManagement->c == 'Y')
                                                                                        <select name="apar_status"
                                                                                            class="form-control"
                                                                                            id="apar_status">
                                                                                            <option value="-">-- Pilih
                                                                                                Status --</option>
                                                                                            <option value="Y">Approval
                                                                                            </option>
                                                                                            </option>
                                                                                            <option value="T">Not
                                                                                                Approval</option>
                                                                                            </option>
                                                                                        </select>
                                                                                    @endif
                                                                                @endif
                                                                            @else
                                                                                @if ($formAparDetail->status == 'Y')
                                                                                    <span
                                                                                        class="badge badge-outline-success">Verifikasi
                                                                                        diterima</span>
                                                                                    |
                                                                                    <span
                                                                                        class="badge badge-outline-primary">
                                                                                        {{ $formAparDetail->approval }}</span>
                                                                                @elseif($formAparDetail->status == 'T')
                                                                                    <span
                                                                                        class="badge badge-outline-danger">Verifikasi
                                                                                        ditolak</span> |
                                                                                    <span
                                                                                        class="badge badge-outline-primary">
                                                                                        {{ $formAparDetail->approval }}</span>
                                                                                @elseif($formAparDetail->status == '0')
                                                                                    <span
                                                                                        class="badge badge-outline-warning">Menunggu Persetujuan</span> |
                                                                                    <span
                                                                                        class="badge badge-outline-primary">
                                                                                        {{ $formAparDetail->approval }}</span>
                                                                                @else
                                                                                -
                                                                                @endif
                                                                            @endif
                                                                        </td>
                                                                        @elseif($tgl_old <= $backDate)
                                                                            @if ($formAparDetail->status != null)
                                                                                <td class="text-center">
                                                                                    @if ($formAparDetail->status == 'Y')
                                                                                        <span
                                                                                            class="badge badge-outline-success">Verifikasi
                                                                                            diterima</span>
                                                                                        |
                                                                                        <span
                                                                                            class="badge badge-outline-primary">
                                                                                            {{ $formAparDetail->approval }}</span>
                                                                                    @elseif($formAparDetail->status == 'T')
                                                                                        <span
                                                                                            class="badge badge-outline-danger">Verifikasi
                                                                                            ditolak</span> |
                                                                                        <span
                                                                                            class="badge badge-outline-primary">
                                                                                            {{ $formAparDetail->approval }}</span>
                                                                                    @elseif($formAparDetail->status == '0')
                                                                                        <span
                                                                                            class="badge badge-outline-warning">Menunggu Persetujuan</span> |
                                                                                        <span
                                                                                            class="badge badge-outline-primary">
                                                                                            {{ $formAparDetail->approval }}</span>
                                                                                    @else
                                                                                    -
                                                                                    @endif
                                                                                </td>
                                                                            @else
                                                                            <td class="text-center">-</td>
                                                                            @endif
                                                                        @else
                                                                            @if ($formAparDetail->status != null)
                                                                                <td>
                                                                                    @if ($formAparDetail->status == '0' || $formAparDetail->status == null)
                                                                                        @if ($UserManagement->c == 'Y')
                                                                                            <select name="apar_status"
                                                                                                class="form-control"
                                                                                                id="apar_status">
                                                                                                <option value="-">-- Pilih
                                                                                                    Status --</option>
                                                                                                <option value="Y">Approval
                                                                                                </option>
                                                                                                </option>
                                                                                                <option value="T">Not
                                                                                                    Approval</option>
                                                                                                </option>
                                                                                            </select>
                                                                                        @endif
                                                                                    @endif
                                                                                </td>
                                                                            @else
                                                                            <td class="text-center">
                                                                                @if ($formAparDetail->status == 'Y')
                                                                                    <span
                                                                                        class="badge badge-outline-success">Verifikasi
                                                                                        diterima</span>
                                                                                    |
                                                                                    <span
                                                                                        class="badge badge-outline-primary">
                                                                                        {{ $formAparDetail->approval }}</span>
                                                                                @elseif($formAparDetail->status == 'T')
                                                                                    <span
                                                                                        class="badge badge-outline-danger">Verifikasi
                                                                                        ditolak</span> |
                                                                                    <span
                                                                                        class="badge badge-outline-primary">
                                                                                        {{ $formAparDetail->approval }}</span>
                                                                                @elseif($formAparDetail->status == '0')
                                                                                    <span
                                                                                        class="badge badge-outline-warning">Menunggu Persetujuan</span> |
                                                                                    <span
                                                                                        class="badge badge-outline-primary">
                                                                                        {{ $formAparDetail->approval }}</span>
                                                                                @endif
                                                                            </td>
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            @if ($formAparDetail->status != null)
                                                                                <td class="text-center">
                                                                                    @if ($formAparDetail->status == 'Y')
                                                                                        <span
                                                                                            class="badge badge-outline-success">Verifikasi
                                                                                            diterima</span>
                                                                                        |
                                                                                        <span
                                                                                            class="badge badge-outline-primary">
                                                                                            {{ $formAparDetail->approval }}</span>
                                                                                    @elseif($formAparDetail->status == 'T')
                                                                                        <span
                                                                                            class="badge badge-outline-danger">Verifikasi
                                                                                            ditolak</span> |
                                                                                        <span
                                                                                            class="badge badge-outline-primary">
                                                                                            {{ $formAparDetail->approval }}</span>
                                                                                    @endif

                                                                                    @if ($formAparDetail->status == '0' || $formAparDetail->status == null)
                                                                                        @if ($UserManagement->c == 'Y')
                                                                                            <select name="apar_status"
                                                                                                class="form-control"
                                                                                                id="apar_status">
                                                                                                <option value="-">-- Pilih
                                                                                                    Status --</option>
                                                                                                <option value="Y">Approval
                                                                                                </option>
                                                                                                </option>
                                                                                                <option value="T">Not
                                                                                                    Approval</option>
                                                                                                </option>
                                                                                            </select>
                                                                                        @endif
                                                                                    @endif
                                                                                </td>
                                                                            @else
                                                                                <td>
                                                                                    @if ($formAparDetail->status == '0' || $formAparDetail->status == null)
                                                                                        @if ($UserManagement->c == 'Y')
                                                                                            <select name="apar_status"
                                                                                                class="form-control"
                                                                                                id="apar_status">
                                                                                                <option value="-">-- Pilih
                                                                                                    Status --</option>
                                                                                                <option value="Y">Approval
                                                                                                </option>
                                                                                                </option>
                                                                                                <option value="T">Not
                                                                                                    Approval</option>
                                                                                                </option>
                                                                                            </select>
                                                                                        @endif
                                                                                    @endif
                                                                                </td>
                                                                            @endif
                                                                        @else
                                                                            <td class="text-center">
                                                                                {{-- {{ $formAparDetail->status }} --}}
                                                                                @if ($formAparDetail->status == 'Y')
                                                                                    <span
                                                                                        class="badge badge-outline-success">Verifikasi
                                                                                        diterima</span>
                                                                                    |
                                                                                    <span
                                                                                        class="badge badge-outline-primary">
                                                                                        {{ $formAparDetail->approval }}</span>
                                                                                @elseif($formAparDetail->status == 'T')
                                                                                    <span
                                                                                        class="badge badge-outline-danger">Verifikasi
                                                                                        ditolak</span> |
                                                                                    <span
                                                                                        class="badge badge-outline-primary">
                                                                                        {{ $formAparDetail->approval }}</span>
                                                                                @elseif($formAparDetail->status == '0')
                                                                                    <span
                                                                                        class="badge badge-outline-warning">Menunggu Persetujuan</span> |
                                                                                    <span
                                                                                        class="badge badge-outline-primary">
                                                                                        {{ $formAparDetail->approval }}</span>
                                                                                @else
                                                                                -
                                                                                @endif
                                                                            </td>
                                                                            {{-- @if ($formAparDetail->status)
                                                                            @else
                                                                                <td class="text-center">-</td>
                                                                            @endif --}}
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    <td class="text-center">
                                                                        @if ($formAparDetail->status != null)
                                                                            @if ($formAparDetail->status == 'Y')
                                                                                <span
                                                                                    class="badge badge-outline-success">Verifikasi
                                                                                    diterima</span>
                                                                                |
                                                                                <span
                                                                                    class="badge badge-outline-primary">Telah
                                                                                    Diverifikasi <br>
                                                                                    {{ $formAparDetail->approval }}</span>
                                                                            @elseif($formAparDetail->status == 'T')
                                                                                <span
                                                                                    class="badge badge-outline-danger">Verifikasi
                                                                                    ditolak</span> |
                                                                                <span
                                                                                    class="badge badge-outline-primary">{{ $formAparDetail->approval }}</span>
                                                                            @elseif($formAparDetail->status == 0)
                                                                                <span
                                                                                    class="badge badge-outline-warning">Menunggu
                                                                                    Verifikasi</span>
                                                                                {{-- <span
                                                                                    class="badge badge-outline-primary">Telah Diverifikasi <br> {{ $formAparDetail->approval }}</span> --}}
                                                                            @endif
                                                                        @else
                                                                            -
                                                                        @endif

                                                                    </td>
                                                                @endif
                                                            </tr>
                                                        @empty
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @elseif ($inventarisDetail->jenis_barang == 'HYDRANT')
                    <?php $formHydrantDetails = \App\Models\FormHydrantDetail::where('form_hydrant_id', $formHydrant->id)
                        ->orderBy('bulan', 'asc')
                        ->get();
                    ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title text-center" style="font-size: 12pt">FORMULIR</div>
                                <div class="card-title text-center" style="font-size: 12pt">CHECK LIST HYDRANT</div>
                                <div class="card-title text-center" style="font-size: 12pt">PERIODE :
                                    {{ $formHydrant->periode }}</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nomor Hydrant. :</label>
                                            <input type="text" name="form_kode_hydrant" class="form-control"
                                                readonly value="{{ $formHydrant->kode_hydrant }}"
                                                placeholder="Nomor Hydrant">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Periode :</label>
                                            <input type="text" name="form_periode" class="form-control" readonly
                                                value="{{ $formHydrant->periode }}" placeholder="Periode">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Lokasi :</label>
                                            <input type="text" name="form_lokasi" class="form-control" readonly
                                                value="{{ $formHydrant->lokasi }}" placeholder="Lokasi">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="table-responsive">
                                                <table class="table table-bordered mb-0 table-centered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" style="width: 2.5%"
                                                                rowspan="2">NO</th>
                                                            <th class="text-center" style="width: 5%" rowspan="2">
                                                                BULAN</th>
                                                            <th class="text-center" style="width: 5%" rowspan="2">
                                                                TGL.</th>
                                                            <th class="text-center" style="width: 5%" colspan="2">
                                                                SELANG</th>
                                                            <th class="text-center" style="width: 5%" colspan="2">
                                                                KRAN</th>
                                                            <th class="text-center" style="width: 5%" colspan="2">
                                                                NOZZEL</th>
                                                            <th class="text-center" style="width: 5%" rowspan="2">
                                                                BUKTI FOTO</th>
                                                            <th class="text-center" style="width: 5%" rowspan="2">
                                                                PETUGAS</th>
                                                            <th class="text-center" style="width: 5%" rowspan="2">
                                                                KETERANGAN</th>
                                                            @if (auth()->user()->roles != 3)
                                                                @if ($UserManagement->c == 'Y')
                                                                    <th class="text-center" style="width: 5%"
                                                                        rowspan="2">VERIFIKASI</th>
                                                                @endif
                                                            @else
                                                                <th class="text-center" style="width: 5%"
                                                                    rowspan="2">STATUS PERSETUJUAN</th>
                                                            @endif
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
                                                        @foreach ($formHydrantDetails as $key => $formHydrantDetail)
                                                            <?php
                                                            $explode_bulan = explode('|', $formHydrantDetail->bulan);
                                                            $bulan_aktif = $explode_bulan[0] . '|' . $explode_bulan[1];
                                                            $continueDate = \Carbon\Carbon::now()->isoFormat('MM|MMMM');

                                                            $tgl_old = $explode_bulan[0] . '|' . $explode_bulan[1] . '|' .$explode_bulan[2];
                                                            $backDate = \Carbon\Carbon::now()->subMonth()->isoFormat('MM|MMMM|YYYY');
                                                            ?>
                                                            <tr>
                                                                <td class="text-center">
                                                                    {{ $key + 1 }}
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                        <input type="hidden" name="id_hydrant"
                                                                        class="id_hydrant"
                                                                        value="{{ $formHydrantDetail->id }}"
                                                                        required>
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            <input type="hidden" name="id_hydrant"
                                                                                class="id_hydrant"
                                                                                value="{{ $formHydrantDetail->id }}"
                                                                                required>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td>{{ $explode_bulan[1] }}</td>
                                                                <td class="text-center" style="width: 5%">
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                            @if (empty($formHydrantDetail->tanggal))
                                                                            <input type="date" name="tanggal_hydrant" class="form-control"
                                                                            placeholder="Tanggal"
                                                                            required>
                                                                            @else
                                                                            {{ \Carbon\Carbon::create($formHydrantDetail->tanggal)->format('d-m-Y H:i:s') }}
                                                                            @endif
                                                                        @elseif ($tgl_old <= $backDate)
                                                                            @if (empty($formHydrantDetail->tanggal))
                                                                                -
                                                                            @else
                                                                            {{ \Carbon\Carbon::create($formHydrantDetail->tanggal)->format('d-m-Y H:i:s') }}
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            @if ($formHydrantDetail->tanggal != null)
                                                                                {{ \Carbon\Carbon::create($formHydrantDetail->tanggal)->format('d-m-Y H:i:s') }}
                                                                            @else
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Tanggal" readonly
                                                                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                                    required>
                                                                            @endif
                                                                        @else
                                                                            @if ($formHydrantDetail->tanggal)
                                                                                {{ \Carbon\Carbon::create($formHydrantDetail->tanggal)->format('d-m-Y H:i:s') }}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                            @if (empty($formHydrantDetail->selang))
                                                                            <select name="hydrant_selang_besar"
                                                                                class="form-control" id=""
                                                                                required>
                                                                                <option>-- Status --</option>
                                                                                <option value="Y">Normal</option>
                                                                                <option value="N">Tidak</option>
                                                                                <option value="-">-</option>
                                                                            </select>
                                                                            @else
                                                                                <?php
                                                                                $selang = json_decode($formHydrantDetail->selang);
                                                                                ?>
                                                                                @if ($selang->besar == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @endif
                                                                        @elseif($tgl_old <= $backDate)
                                                                            @if ($formHydrantDetail->selang != null)
                                                                                <?php
                                                                                $selang = json_decode($formHydrantDetail->selang);
                                                                                ?>
                                                                                {{-- {{ $selang->besar }} --}}
                                                                                @if ($selang->besar == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                            -
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            @if ($formHydrantDetail->selang != null)
                                                                                <?php
                                                                                $selang = json_decode($formHydrantDetail->selang);
                                                                                ?>
                                                                                {{-- {{ $selang->besar }} --}}
                                                                                @if ($selang->besar == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                <select name="hydrant_selang_besar"
                                                                                    class="form-control" id=""
                                                                                    required>
                                                                                    <option>-- Status --</option>
                                                                                    <option value="Y">Normal</option>
                                                                                    <option value="N">Tidak</option>
                                                                                    <option value="-">-</option>
                                                                                </select>
                                                                            @endif
                                                                        @else
                                                                            @if ($formHydrantDetail->selang)
                                                                                @php
                                                                                    $selang_besar = json_decode($formHydrantDetail->selang);
                                                                                @endphp
                                                                                @if ($selang_besar->besar == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                    style="color: red"></i>
                                                                                @endif
                                                                                {{-- {{ $formHydrantDetail->selang }} --}}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                            @if (empty($formHydrantDetail->selang))
                                                                            <select name="hydrant_selang_kecil"
                                                                                class="form-control" id=""
                                                                                required>
                                                                                <option>-- Status --</option>
                                                                                <option value="Y">Normal</option>
                                                                                <option value="N">Tidak</option>
                                                                                <option value="-">-</option>
                                                                            </select>
                                                                            @else
                                                                                <?php
                                                                                $selang = json_decode($formHydrantDetail->selang);
                                                                                ?>
                                                                                @if ($selang->kecil == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @endif
                                                                        @elseif($tgl_old <= $backDate)
                                                                            @if ($formHydrantDetail->selang != null)
                                                                                <?php
                                                                                $selang = json_decode($formHydrantDetail->selang);
                                                                                ?>
                                                                                {{-- {{ $selang->kecil }} --}}
                                                                                @if ($selang->kecil == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                            -
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            @if ($formHydrantDetail->selang != null)
                                                                                <?php
                                                                                $selang = json_decode($formHydrantDetail->selang);
                                                                                ?>
                                                                                {{-- {{ $selang->kecil }} --}}
                                                                                @if ($selang->kecil == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                <select name="hydrant_selang_kecil"
                                                                                    class="form-control" id=""
                                                                                    required>
                                                                                    <option>-- Status --</option>
                                                                                    <option value="Y">Normal</option>
                                                                                    <option value="N">Tidak</option>
                                                                                    <option value="-">-</option>
                                                                                </select>
                                                                            @endif
                                                                        @else
                                                                            @if ($formHydrantDetail->selang)
                                                                                {{-- {{ $formHydrantDetail->selang }} --}}
                                                                                @php
                                                                                    $selang_kecil = json_decode($formHydrantDetail->selang);
                                                                                @endphp
                                                                                @if ($selang_kecil->kecil == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                    style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                            @if (empty($formHydrantDetail->kran))
                                                                            <select name="hydrant_kran_besar"
                                                                                class="form-control" id=""
                                                                                required>
                                                                                <option>-- Status --</option>
                                                                                <option value="Y">Normal</option>
                                                                                <option value="N">Tidak</option>
                                                                                <option value="-">-</option>
                                                                            </select>
                                                                            @else
                                                                                <?php
                                                                                $kran = json_decode($formHydrantDetail->kran);
                                                                                ?>
                                                                                @if ($kran->besar == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @endif
                                                                        @elseif($tgl_old <= $backDate)    
                                                                            @if ($formHydrantDetail->kran != null)
                                                                                <?php
                                                                                $kran = json_decode($formHydrantDetail->kran);
                                                                                ?>
                                                                                {{-- {{ $kran->besar }} --}}
                                                                                @if ($kran->besar == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                            -
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            @if ($formHydrantDetail->kran != null)
                                                                                <?php
                                                                                $kran = json_decode($formHydrantDetail->kran);
                                                                                ?>
                                                                                {{-- {{ $kran->besar }} --}}
                                                                                @if ($kran->besar == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                <select name="hydrant_kran_besar"
                                                                                    class="form-control" id=""
                                                                                    required>
                                                                                    <option>-- Status --</option>
                                                                                    <option value="Y">Normal</option>
                                                                                    <option value="N">Tidak</option>
                                                                                    <option value="-">-</option>
                                                                                </select>
                                                                            @endif
                                                                        @else
                                                                            @if ($formHydrantDetail->kran)
                                                                                {{-- {{ $formHydrantDetail->kran }} --}}
                                                                                <?php
                                                                                $kran = json_decode($formHydrantDetail->kran);
                                                                                ?>
                                                                                {{-- {{ $kran->besar }} --}}
                                                                                @if ($kran->besar == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                            @if (empty($formHydrantDetail->kran))
                                                                            <select name="hydrant_kran_kecil"
                                                                                class="form-control" id=""
                                                                                required>
                                                                                <option>-- Status --</option>
                                                                                <option value="Y">Normal</option>
                                                                                <option value="N">Tidak</option>
                                                                                <option value="-">-</option>
                                                                            </select>
                                                                            @else
                                                                                <?php
                                                                                $kran = json_decode($formHydrantDetail->kran);
                                                                                ?>
                                                                                @if ($kran->kecil == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @endif
                                                                        @elseif($tgl_old <= $backDate)
                                                                            @if ($formHydrantDetail->kran != null)
                                                                                <?php
                                                                                $kran = json_decode($formHydrantDetail->kran);
                                                                                ?>
                                                                                {{-- {{ $kran->kecil }} --}}
                                                                                @if ($kran->kecil == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                            -
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            @if ($formHydrantDetail->kran != null)
                                                                                <?php
                                                                                $kran = json_decode($formHydrantDetail->kran);
                                                                                ?>
                                                                                {{-- {{ $kran->kecil }} --}}
                                                                                @if ($kran->kecil == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                <select name="hydrant_kran_kecil"
                                                                                    class="form-control" id=""
                                                                                    required>
                                                                                    <option>-- Status --</option>
                                                                                    <option value="Y">Normal</option>
                                                                                    <option value="N">Tidak</option>
                                                                                    <option value="-">-</option>
                                                                                </select>
                                                                            @endif
                                                                        @else
                                                                            @if ($formHydrantDetail->kran)
                                                                                {{-- {{ $formHydrantDetail->kran }} --}}
                                                                                <?php
                                                                                $kran = json_decode($formHydrantDetail->kran);
                                                                                ?>
                                                                                {{-- {{ $kran->kecil }} --}}
                                                                                @if ($kran->kecil == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                            @if (empty($formHydrantDetail->nozzel))
                                                                            <select name="hydrant_nozzel_besar"
                                                                                class="form-control" id=""
                                                                                required>
                                                                                <option>-- Status --</option>
                                                                                <option value="Y">Normal</option>
                                                                                <option value="N">Tidak</option>
                                                                                <option value="-">-</option>
                                                                            </select>
                                                                            @else
                                                                                <?php
                                                                                $nozzel = json_decode($formHydrantDetail->nozzel);
                                                                                ?>
                                                                                {{-- {{ $nozzel->besar }} --}}
                                                                                @if ($nozzel->besar == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @endif
                                                                        @elseif($tgl_old <= $backDate)
                                                                            @if ($formHydrantDetail->nozzel != null)
                                                                                <?php
                                                                                $nozzel = json_decode($formHydrantDetail->nozzel);
                                                                                ?>
                                                                                {{-- {{ $nozzel->besar }} --}}
                                                                                @if ($nozzel->besar == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                            -
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            @if ($formHydrantDetail->nozzel != null)
                                                                                <?php
                                                                                $nozzel = json_decode($formHydrantDetail->nozzel);
                                                                                ?>
                                                                                {{-- {{ $nozzel->besar }} --}}
                                                                                @if ($nozzel->besar == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                <select name="hydrant_nozzel_besar"
                                                                                    class="form-control" id=""
                                                                                    required>
                                                                                    <option>-- Status --</option>
                                                                                    <option value="Y">Normal</option>
                                                                                    <option value="N">Tidak</option>
                                                                                    <option value="-">-</option>
                                                                                </select>
                                                                            @endif
                                                                        @else
                                                                            @if ($formHydrantDetail->nozzel)
                                                                                {{-- {{ $formHydrantDetail->nozzel }} --}}
                                                                                <?php
                                                                                $nozzel = json_decode($formHydrantDetail->nozzel);
                                                                                ?>
                                                                                {{-- {{ $nozzel->besar }} --}}
                                                                                @if ($nozzel->besar == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                            @if (empty($formHydrantDetail->nozzel))
                                                                            <select name="hydrant_nozzel_kecil"
                                                                                class="form-control" id=""
                                                                                required>
                                                                                <option>-- Status --</option>
                                                                                <option value="Y">Normal</option>
                                                                                <option value="N">Tidak</option>
                                                                                <option value="-">-</option>
                                                                            </select>
                                                                            @else
                                                                                <?php
                                                                                $nozzel = json_decode($formHydrantDetail->nozzel);
                                                                                ?>
                                                                                {{-- {{ $nozzel->kecil }} --}}
                                                                                @if ($nozzel->kecil == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @endif
                                                                        @elseif($tgl_old <= $backDate)
                                                                            @if ($formHydrantDetail->nozzel != null)
                                                                                <?php
                                                                                $nozzel = json_decode($formHydrantDetail->nozzel);
                                                                                ?>
                                                                                {{-- {{ $nozzel->kecil }} --}}
                                                                                @if ($nozzel->kecil == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                            -
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            @if ($formHydrantDetail->nozzel != null)
                                                                                <?php
                                                                                $nozzel = json_decode($formHydrantDetail->nozzel);
                                                                                ?>
                                                                                {{-- {{ $nozzel->kecil }} --}}
                                                                                @if ($nozzel->kecil == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                <select name="hydrant_nozzel_kecil"
                                                                                    class="form-control" id=""
                                                                                    required>
                                                                                    <option>-- Status --</option>
                                                                                    <option value="Y">Normal</option>
                                                                                    <option value="N">Tidak</option>
                                                                                    <option value="-">-</option>
                                                                                </select>
                                                                            @endif
                                                                        @else
                                                                            @if ($formHydrantDetail->nozzel)
                                                                                {{-- {{ $formHydrantDetail->nozzel }} --}}
                                                                                <?php
                                                                                $nozzel = json_decode($formHydrantDetail->nozzel);
                                                                                ?>
                                                                                {{-- {{ $nozzel->kecil }} --}}
                                                                                @if ($nozzel->kecil == 'Y')
                                                                                    <i class="fas fa-check"></i>
                                                                                @else
                                                                                    <i class="fas fa-times"
                                                                                        style="color: red"></i>
                                                                                @endif
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                            @if (empty($formHydrantDetail->images))
                                                                            <input type="file"
                                                                            name="hydrant_images"
                                                                            class="form-control">
                                                                            @else
                                                                            <div class="modal fade"
                                                                                id="view_hydrant{{ $key+1 }}"
                                                                                tabindex="-1" role="dialog"
                                                                                aria-labelledby="exampleModalCenterTitle"
                                                                                aria-hidden=""yes"">
                                                                                <div class="modal-dialog modal-dialog-centered"
                                                                                    role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h6 class="modal-title m-0"
                                                                                                id="exampleModalCenterTitle">
                                                                                                {{ $formHydrantDetail->images }}
                                                                                            </h6>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12">
                                                                                                    <img src="{{ asset('public/berkas_k3/' . $formHydrantDetail->images) }}"
                                                                                                        alt="{{ $formHydrantDetail->images }}"
                                                                                                        width="250">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <button type="button"
                                                                                class="btn btn-primary btn-xs"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#view_hydrant{{ $key+1 }}">
                                                                                <i class="far fa-eye"></i> View Images
                                                                            </button>
                                                                            @endif
                                                                        @elseif($tgl_old <= $backDate)
                                                                            @if ($formHydrantDetail->images != null)
                                                                                <div class="modal fade"
                                                                                    id="view_hydrant{{ $key+1 }}"
                                                                                    tabindex="-1" role="dialog"
                                                                                    aria-labelledby="exampleModalCenterTitle"
                                                                                    aria-hidden=""yes"">
                                                                                    <div class="modal-dialog modal-dialog-centered"
                                                                                        role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h6 class="modal-title m-0"
                                                                                                    id="exampleModalCenterTitle">
                                                                                                    {{ $formHydrantDetail->images }}
                                                                                                </h6>
                                                                                                <button type="button"
                                                                                                    class="btn-close"
                                                                                                    data-bs-dismiss="modal"
                                                                                                    aria-label="Close"></button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <div class="row">
                                                                                                    <div class="col-lg-12">
                                                                                                        <img src="{{ asset('public/berkas_k3/' . $formHydrantDetail->images) }}"
                                                                                                            alt="{{ $formHydrantDetail->images }}"
                                                                                                            width="250">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <button type="button"
                                                                                    class="btn btn-primary btn-xs"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#view_hydrant{{ $key+1 }}">
                                                                                    <i class="far fa-eye"></i> View Images
                                                                                </button>
                                                                            @else
                                                                            -
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            @if ($formHydrantDetail->images != null)
                                                                                <div class="modal fade"
                                                                                    id="view_hydrant{{ $key+1 }}"
                                                                                    tabindex="-1" role="dialog"
                                                                                    aria-labelledby="exampleModalCenterTitle"
                                                                                    aria-hidden=""yes"">
                                                                                    <div class="modal-dialog modal-dialog-centered"
                                                                                        role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h6 class="modal-title m-0"
                                                                                                    id="exampleModalCenterTitle">
                                                                                                    {{ $formHydrantDetail->images }}
                                                                                                </h6>
                                                                                                <button type="button"
                                                                                                    class="btn-close"
                                                                                                    data-bs-dismiss="modal"
                                                                                                    aria-label="Close"></button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <div class="row">
                                                                                                    <div class="col-lg-12">
                                                                                                        <img src="{{ asset('public/berkas_k3/' . $formHydrantDetail->images) }}"
                                                                                                            alt="{{ $formHydrantDetail->images }}"
                                                                                                            width="250">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <button type="button"
                                                                                    class="btn btn-primary btn-xs"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#view_hydrant{{ $key+1 }}">
                                                                                    <i class="far fa-eye"></i> View Images
                                                                                </button>
                                                                                {{-- {{ $formHydrantDetail->images }} --}}
                                                                            @else
                                                                                <input type="file"
                                                                                    name="hydrant_images"
                                                                                    class="form-control">
                                                                            @endif
                                                                        @else
                                                                            @if ($formHydrantDetail->images)
                                                                                {{-- {{ $formHydrantDetail->images }} --}}
                                                                                <div class="modal fade"
                                                                                    id="view_hydrant{{ $key+1 }}"
                                                                                    tabindex="-1" role="dialog"
                                                                                    aria-labelledby="exampleModalCenterTitle"
                                                                                    aria-hidden=""yes"">
                                                                                    <div class="modal-dialog modal-dialog-centered"
                                                                                        role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h6 class="modal-title m-0"
                                                                                                    id="exampleModalCenterTitle">
                                                                                                    {{ $formHydrantDetail->images }}
                                                                                                </h6>
                                                                                                <button type="button"
                                                                                                    class="btn-close"
                                                                                                    data-bs-dismiss="modal"
                                                                                                    aria-label="Close"></button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <div class="row">
                                                                                                    <div class="col-lg-12">
                                                                                                        <img src="{{ asset('public/berkas_k3/' . $formHydrantDetail->images) }}"
                                                                                                            alt="{{ $formHydrantDetail->images }}"
                                                                                                            width="250">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <button type="button"
                                                                                    class="btn btn-primary btn-xs"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#view_hydrant{{ $key+1 }}">
                                                                                    <i class="far fa-eye"></i> View Images
                                                                                </button>
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @endif
                                                                        
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                            @if (empty($formHydrantDetail->checker))
                                                                            <input type="text"
                                                                            name="hydrant_checker"
                                                                            class="form-control"
                                                                            placeholder="Checker"
                                                                            value="{{ auth()->user()->name }}"
                                                                            readonly>
                                                                            @else
                                                                            {{ $formHydrantDetail->checker }}
                                                                            @endif
                                                                        @elseif ($tgl_old <= $backDate)
                                                                            @if (empty($formHydrantDetail->checker))
                                                                                -
                                                                            @else
                                                                                {{ $formHydrantDetail->checker }}
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            @if ($formHydrantDetail->checker != null)
                                                                                {{ $formHydrantDetail->checker }}
                                                                            @else
                                                                                <input type="text"
                                                                                    name="hydrant_checker"
                                                                                    class="form-control"
                                                                                    placeholder="Checker"
                                                                                    value="{{ auth()->user()->name }}"
                                                                                    readonly>
                                                                            @endif
                                                                        @else
                                                                            @if ($formHydrantDetail->checker)
                                                                                {{ $formHydrantDetail->checker }}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                            @if (empty($formHydrantDetail->keterangan))
                                                                            <textarea name="hydrant_keterangan" id="" class="form-control hydrantKeterangan" cols="30"
                                                                                        rows="2" required></textarea>
                                                                            @else
                                                                            {{ $formHydrantDetail->keterangan }}
                                                                            @endif
                                                                        @elseif($tgl_old <= $backDate)
                                                                            @if (empty($formHydrantDetail->keterangan))
                                                                                -
                                                                            @else
                                                                            {{ $formHydrantDetail->keterangan }}
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            @if ($formHydrantDetail->keterangan != null)
                                                                                {{ $formHydrantDetail->keterangan }}
                                                                            @else
                                                                                <textarea name="hydrant_keterangan" id="" class="form-control hydrantKeterangan" cols="30"
                                                                                    rows="2" required></textarea>
                                                                            @endif
                                                                            {{-- <input type="text" name="hydrant_checker"
                                                                class="form-control" placeholder="Checker"> --}}
                                                                        @else
                                                                            @if ($formHydrantDetail->keterangan)
                                                                                {{ $formHydrantDetail->keterangan }}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                @if (auth()->user()->roles != 3)
                                                                    @if ($openinventarisk3 == "yes")
                                                                        @if ($backDate == $tgl_old)
                                                                            <td class="text-center">
                                                                                @if (empty($formHydrantDetail->status))
                                                                                    @if ($UserManagement->c == 'Y')
                                                                                        <select name="hydrant_status"
                                                                                            class="form-control"
                                                                                            id="hydrant_status">
                                                                                            <option value="-">
                                                                                                --Pilih Status --
                                                                                            </option>
                                                                                            <option value="Y">
                                                                                                Approval</option>
                                                                                            <option value="T">Not
                                                                                                Approval</option>
                                                                                        </select>
                                                                                    @endif
                                                                                @else
                                                                                    @if ($formHydrantDetail->status == 'Y')
                                                                                        <span
                                                                                            class="badge badge-outline-success">Verifikasi
                                                                                            diterima</span>
                                                                                        |
                                                                                        <span
                                                                                            class="badge badge-outline-primary">
                                                                                            {{ $formHydrantDetail->approval }}</span>
                                                                                    @elseif($formHydrantDetail->status == 'T')
                                                                                        <span
                                                                                            class="badge badge-outline-danger">Verifikasi
                                                                                            ditolak</span> |
                                                                                        <span
                                                                                            class="badge badge-outline-primary">
                                                                                            {{ $formHydrantDetail->approval }}</span>
                                                                                    @endif
                                                                                @endif
                                                                                {{-- @if ($formHydrantDetail->status == '0' || $formHydrantDetail->status == null)
                                                                                    @if ($UserManagement->c == 'Y')
                                                                                        <select name="hydrant_status"
                                                                                            class="form-control"
                                                                                            id="hydrant_status">
                                                                                            <option value="-">
                                                                                                --Pilih Status --
                                                                                            </option>
                                                                                            <option value="Y">
                                                                                                Approval</option>
                                                                                            <option value="T">Not
                                                                                                Approval</option>
                                                                                        </select>
                                                                                    @endif
                                                                                @endif --}}
                                                                            </td>
                                                                        @elseif($tgl_old <= $backDate)
                                                                            @if ($formHydrantDetail->status != null)
                                                                                <td class="text-center">
                                                                                    @if ($formHydrantDetail->status == 'Y')
                                                                                        <span
                                                                                            class="badge badge-outline-success">Verifikasi
                                                                                            diterima</span>
                                                                                        |
                                                                                        <span
                                                                                            class="badge badge-outline-primary">
                                                                                            {{ $formHydrantDetail->approval }}</span>
                                                                                    @elseif($formHydrantDetail->status == 'T')
                                                                                        <span
                                                                                            class="badge badge-outline-danger">Verifikasi
                                                                                            ditolak</span> |
                                                                                        <span
                                                                                            class="badge badge-outline-primary">
                                                                                            {{ $formHydrantDetail->approval }}</span>
                                                                                    @endif
                                                                                </td>
                                                                            @else
                                                                            <td class="text-center">-</td>
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @if ($continueDate == $bulan_aktif)
                                                                            @if ($formHydrantDetail->status != null)
                                                                                {{-- {{ $formHydrantDetail->status }} --}}
                                                                                <td class="text-center">
                                                                                    @if ($formHydrantDetail->status == 'Y')
                                                                                        <span
                                                                                            class="badge badge-outline-success">Verifikasi
                                                                                            diterima</span>
                                                                                        |
                                                                                        <span
                                                                                            class="badge badge-outline-primary">
                                                                                            {{ $formHydrantDetail->approval }}</span>
                                                                                    @elseif($formHydrantDetail->status == 'T')
                                                                                        <span
                                                                                            class="badge badge-outline-danger">Verifikasi
                                                                                            ditolak</span> |
                                                                                        <span
                                                                                            class="badge badge-outline-primary">
                                                                                            {{ $formHydrantDetail->approval }}</span>
                                                                                    @endif

                                                                                    @if ($formHydrantDetail->status == '0' || $formHydrantDetail->status == null)
                                                                                        @if ($UserManagement->c == 'Y')
                                                                                            <select name="hydrant_status"
                                                                                                class="form-control"
                                                                                                id="hydrant_status">
                                                                                                <option value="-">
                                                                                                    --Pilih Status --
                                                                                                </option>
                                                                                                <option value="Y">
                                                                                                    Approval</option>
                                                                                                <option value="T">Not
                                                                                                    Approval</option>
                                                                                            </select>
                                                                                        @endif
                                                                                    @endif
                                                                                </td>
                                                                            @else
                                                                                <td>
                                                                                    @if ($UserManagement->c == 'Y')
                                                                                        <select name="hydrant_status"
                                                                                            class="form-control"
                                                                                            id="hydrant_status">
                                                                                            <option value="-">--Pilih
                                                                                                Status --</option>
                                                                                            <option value="Y">Approval
                                                                                            </option>
                                                                                            <option value="T">Not
                                                                                                Approval</option>
                                                                                        </select>
                                                                                    @endif
                                                                                </td>
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    <td class="text-center">
                                                                        @if ($formHydrantDetail->status != null)
                                                                            @if ($formHydrantDetail->status == 'Y')
                                                                                <span
                                                                                    class="badge badge-outline-success">Verifikasi
                                                                                    diterima</span>
                                                                                |
                                                                                <span
                                                                                    class="badge badge-outline-primary">
                                                                                    {{ $formHydrantDetail->approval }}</span>
                                                                            @elseif($formHydrantDetail->status == 'T')
                                                                                <span
                                                                                    class="badge badge-outline-danger">Verifikasi
                                                                                    ditolak</span> |
                                                                                <span
                                                                                    class="badge badge-outline-primary">{{ $formHydrantDetail->approval }}</span>
                                                                            @elseif($formHydrantDetail->status == 0)
                                                                                <span
                                                                                    class="badge badge-outline-warning">Menunggu
                                                                                    Verifikasi</span>
                                                                                {{-- <span
                                                                                    class="badge badge-outline-primary">Telah Diverifikasi <br> {{ $formHydrantDetail->approval }}</span> --}}
                                                                            @endif
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                        {{-- @foreach ($form_aparts as $key => $form_apart)
                                                <tr>
                                                    <td>{{ $form_apart['no'] }}</td>
                                                    <td>{{ $form_apart['bulan'] }}</td>
                                                    <td><input type="date" name="tanggal[]" class="form-control" placeholder="Tanggal"></td>
                                                    <td>
                                                        <select name="pressure[]" class="form-control" id="">
                                                            <option>-- Status --</option>
                                                            <option value="Y">Normal</option>
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
                @endif
            @endforeach
            <div class="mb-3">
                <button type="submit" class="btn btn-primary btn-icon btn-submit"><i class="fas fa-upload"></i> Submit</button>
                <a href="{{ route('inventaris.k3') }}" class="btn btn-secondary btn-icon"><i
                        class="fas fa-arrow-left"></i> Back</a>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('public/assets/js/iziToast.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/app.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // if($('.hydrantKeterangan').val() == null){
        //     alert('Keterangan Hydrant Belum Diinput');
        // }
        $('.btn-submit').on('click', function(){
            Swal.fire(
                {
                    position: 'center',
                    icon: 'warning',
                    title: 'Silahkan tunggu beberapa saat',
                    showConfirmButton: false,
                    // timer: 1500
                }
            );
            // Swal.fire(
            //     'Waiting',
            //     'Silahkan tunggu beberapa saat',
            //     'warning'
            // );
        });
        $('.aparKeterangan').on('click', function() {
            // alert('Test');
            let text;
            let aparKeterangan = prompt("Keterangan:");
            if (aparKeterangan == null || aparKeterangan == "") {
                text = "Keterangan cancelled the prompt.";
            } else {
                text = $('.aparKeterangan').val(aparKeterangan);
            }
        });
        $('.hydrantKeterangan').on('click', function() {
            // alert('Test');
            let text;
            let hydrantKeterangan = prompt("Keterangan:");
            if (hydrantKeterangan == null || hydrantKeterangan == "") {
                text = "Keterangan cancelled the prompt.";
            } else {
                text = $('.hydrantKeterangan').val(hydrantKeterangan);
            }
        });
        $('#apar_status').change(function(e) {
            e.preventDefault();
            var formData = {
                id_apar: $('.id_apar').val(),
                apar_status: $('#apar_status').val(),
            };
            swal.fire({
                title: 'Apakah anda yakin?',
                // text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: "yes",
                confirmButtonText: 'Yes, submit',
                cancelButtonText: 'No, cancel!',
                reverseButtons: "yes"
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: "{{ route('inventaris.k3.detail.statusApar.update', ['id' => $inventaris->id]) }}",
                        data: formData,
                        contentType: "application/json;  charset=utf-8",
                        cache: false,
                        success: (result) => {
                            if (result.success != false) {
                                Swal.fire(
                                    result.message_title,
                                    'Silahkan klik tombol untuk melakukan refresh',
                                    result.message_status
                                ).then(function(result) {
                                    if (result.value) {
                                        location.reload()
                                    }
                                })
                            } else {
                                iziToast.error({
                                    title: result.success,
                                    message: result.error
                                });
                            }
                        },
                        error: function(request, status, error) {
                            iziToast.error({
                                title: 'Error',
                                message: error,
                            });
                        }
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swal.fire(
                        '',
                        '',
                        'error'
                    ).then(function(result) {
                        if (result.value) {
                            location.reload()
                        }
                    })
                }
            })
            // $.ajax({
            //     type: 'GET',
            //     url: "{{ route('inventaris.k3.detail.statusApar.update', ['id' => $inventaris->id]) }}",
            //     data: formData,
            //     contentType: "application/json;  charset=utf-8",
            //     cache: false,
            //     success: (result) => {
            //         if (result.success != false) {
            //             Swal.fire(
            //                 result.message_title,
            //                 'Silahkan klik tombol untuk melakukan refresh',
            //                 result.message_status
            //             ).then(function(result) {
            //                 if (result.value) {
            //                     location.reload()
            //                 }
            //             })
            //         } else {
            //             iziToast.error({
            //                 title: result.success,
            //                 message: result.error
            //             });
            //         }
            //     },
            //     error: function(request, status, error) {
            //         iziToast.error({
            //             title: 'Error',
            //             message: error,
            //         });
            //     }
            // });
        });

        $('#hydrant_status').change(function(e) {
            e.preventDefault();
            var formData = {
                id_hydrant: $('.id_hydrant').val(),
                hydrant_status: $('#hydrant_status').val(),
            };
            swal.fire({
                title: 'Apakah anda yakin?',
                // text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: "yes",
                confirmButtonText: 'Yes, submit',
                cancelButtonText: 'No, cancel!',
                reverseButtons: "yes"
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: "{{ route('inventaris.k3.detail.statusHydrant.update', ['id' => $inventaris->id]) }}",
                        data: formData,
                        contentType: "application/json;  charset=utf-8",
                        cache: false,
                        success: (result) => {
                            if (result.success != false) {
                                Swal.fire(
                                    result.message_title,
                                    'Silahkan klik tombol untuk melakukan refresh',
                                    result.message_status
                                ).then(function(result) {
                                    if (result.value) {
                                        location.reload()
                                    }
                                })
                            } else {
                                Swal.fire(
                                    result.success,
                                    result.error,
                                    'error'
                                )
                            }
                        },
                        error: function(request, status, error) {
                            Swal.fire(
                                'Error',
                                error,
                                'error'
                            )
                        }
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swal.fire(
                        'Cancel',
                        '',
                        'error'
                    ).then(function(result) {
                        if (result.value) {
                            location.reload()
                        }
                    })
                }
            })

        });
        // $('.aparKeterangan').on('input',function(){
        //     alert('Test');
        // });
        // $('.hydrantKeterangan').on('input',function(){
        //     alert('Test');
        // });
    </script>
@endsection
