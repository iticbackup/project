@extends('layouts.backend.app')
@section('title')
    Inventaris K3 - APAR & HYDRANT
@endsection
@section('css')
    <link href="{{ URL::asset('public/assets/plugins/datatables/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('public/assets/plugins/datatables/buttons.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('public/assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('public/assets/css/iziToast.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('public/assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet"
        type="text/css">
    <script src="{{ URL::asset('public/assets/js/pages/jquery.sweet-alert.init.js') }}"></script>

    <link href="{{ URL::asset('public/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('public/assets/plugins/huebee/huebee.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('public/assets/plugins/timepicker/bootstrap-material-datetimepicker.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('public/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}"
        rel="stylesheet" />
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

    @include('backend.inventaris.k3.modalBuat')
    @include('backend.inventaris.k3.modalDownloadAllReports')

    <div class="row">
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
                    @if ($UserManagement->c == 'Y' && $roles->id != 3)
                        @if ($departemen->departemen->nama_departemen == 'HRGA' || $departemen->departemen->nama_departemen == 'IT')
                            <button type="button" class="btn btn-primary" onclick="buat()" data-bs-toggle="modal"
                                data-bs-target="#exampleModalCenter"><i class="fas fa-plus"></i> Tambah</button>
                        @endif
                    @endif
                    <button type="button" class="btn btn-primary" onclick="reload()"><i class="fas fa-undo"></i>
                        Refresh</button>
                    <a href="{{ route('inventaris.scan') }}" class="btn btn-primary btn-icon"><i class="fas fa-qrcode"></i>
                        Scan Barcode</a>
                    @if ($UserManagement->r == 'Y')
                        @if ($departemen->departemen->nama_departemen == 'HRGA' || $departemen->departemen->nama_departemen == 'IT')
                            <a href="{{ route('inventaris.k3.printBarcode') }}" class="btn btn-primary"><i
                                    class="fas fa-print"></i> Print Barcode</a>
                        @endif
                    @endif
                    @if (auth()->user()->roles != 3)
                        <a href="{{ route('inventaris.k3.periode') }}" class="btn btn-primary btn-icon"><i
                                class="far fa-bookmark"></i> Input Periode</a>
                        <button type="button" onclick="download_all_reports()" class="btn btn-primary btn-icon"><i
                                class="fa fa-download"></i> Download All Reports</button>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-0 fixed-solution">
                        <table class="table table-bordered dt-responsive nowrap datatables"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    {{-- <th style="width: 150px">Barcode</th> --}}
                                    <th>Kode Barcode</th>
                                    <th>Lokasi Barcode</th>
                                    <th>Departemen</th>
                                    <th>Expired APAR</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ URL::asset('public/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatables/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/pages/jquery.datatable.init.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/app.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/iziToast.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>

    <script src="{{ URL::asset('public/assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/huebee/huebee.pkgd.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/timepicker/bootstrap-material-datetimepicker.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}">
    </script>
    <script src="{{ URL::asset('public/assets/js/pages/jquery.forms-advanced.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('.datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('inventaris.k3') }}",
            columns: [
                // {
                //     data: 'barcode',
                //     name: 'barcode'
                // },
                // {
                //     "className":      'details-control',
                //     "orderable":      false,
                //     "data":           null,
                //     "defaultContent": ''
                // },
                {
                    data: 'kode_barcode',
                    name: 'kode_barcode'
                },
                {
                    data: 'lokasi',
                    name: 'lokasi'
                },
                {
                    data: 'departemen_id',
                    name: 'departemen_id'
                },
                {
                    data: 'expired',
                    name: 'expired'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: true
                },
            ],
            columnDefs: [
                { className: 'text-center', targets: [2,3] },
            ]
        });

        // $('.datatables tbody').on('click', 'td.details-control', function () {
        //     var tr = $(this).closest('tr');
        //     var row = table.row( tr );

        //     if ( row.child.isShown() ) {
        //         // This row is already open - close it
        //         row.child.hide();
        //         tr.removeClass('shown');
        //     }
        //     else {
        //         // Open this row
        //         row.child( format(row.data()) ).show();
        //         tr.addClass('shown');
        //     }
        // } );

        // $('.datatables tbody').on('click', 'td.details-control', function () {
        //     var tr = $(this).closest('tr');
        //     var row = table.row( tr );

        //     if ( row.child.isShown() ) {
        //         // This row is already open - close it
        //         row.child.hide();
        //         tr.removeClass('shown');
        //     }
        //     else {
        //         // Open this row
        //         row.child( format(row.data()) ).show();
        //         tr.addClass('shown');
        //     }
        // } );

        function buat() {
            $('.modalBuat').modal();
        }

        function download_all_reports() {
            $('.modalAllReports').modal('show');
        }

        function reload() {
            table.ajax.reload();
        }

        function hapus(id) {
            // alert(id);
            swal.fire({
                title: 'Apakah anda yakin?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Deleted',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: "{{ url('hrga/inventaris/k3/') }}" + "/" + id + "/delete",
                        contentType: "application/json;  charset=utf-8",
                        cache: false,
                        success: (result) => {
                            if (result.success != false) {
                                Swal.fire(
                                    result.message,
                                    '',
                                    result.notif
                                ).then(function(result) {
                                    if (result.value) {
                                        table.ajax.reload();
                                    }
                                })
                            } else {
                                swal.fire(
                                    '',
                                    '',
                                    'error'
                                ).then(function(result) {
                                    if (result.value) {
                                        table.ajax.reload();
                                    }
                                })
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
                            table.ajax.reload();
                        }
                    })
                }
            })
        }

        $('#form-simpan').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');
            $.ajax({
                type: 'POST',
                url: "{{ route('inventaris.k3.simpan') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (result) => {
                    if (result.success != false) {
                        iziToast.success({
                            title: result.message_title,
                            message: result.message_content
                        });
                        this.reset();
                        // $('.modalBuat').hide();
                        table.ajax.reload();
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
        });
    </script>
@endsection
