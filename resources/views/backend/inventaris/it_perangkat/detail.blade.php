@extends('layouts.backend.app')
@section('title')
    Inventaris IT - Perangkat Komputer - {{ $inventarisITPerangkat->kode_barcode }}
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
            Inventaris IT - Perangkat Komputer
        @endslot
        @slot('li_3')
            @yield('title')
        @endslot
        @slot('title')
            @yield('title')
        @endslot
    @endcomponent

    @include('backend.inventaris.it_perangkat.modalFormDetail')
    @include('backend.inventaris.it_perangkat.modalFormEdit')
    @include('backend.inventaris.it_perangkat.modalCheck')

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
                    <div class="card-title text-center" style="font-size: 12pt">FORMULIR</div>
                    <div class="card-title text-center" style="font-size: 12pt">PERANGKAT KOMPUTER</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form method="post"
                            action="{{ route('inventaris.it.perangkat.detail.simpan', ['id' => $inventarisITPerangkat->id]) }}"
                            id="form-simpan">
                            @csrf
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label">Kode Barcode :</label>
                                    <input type="text" class="form-control" placeholder="Kode Barcode"
                                        value="{{ $inventarisITPerangkat->kode_barcode }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label">Lokasi :</label>
                                    <input type="text" class="form-control" placeholder="Lokasi"
                                        value="{{ $inventarisITPerangkat->lokasi }}" readonly>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Jenis Asset</label>
                                            <select name="jenis_asset" class="form-control select2" id="jenis_asset">
                                                <option value="-">-- Pilih Asset --</option>
                                                @foreach ($inventarisITAssets as $inventarisITAsset)
                                                    <option value="{{ $inventarisITAsset->nama_perangkat }}">
                                                        {{ $inventarisITAsset->nama_perangkat }}</option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="text" name="jenis_asset" class="form-control" placeholder="Jenis Asset"> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Label Asset</label>
                                            <select name="kode_asset" class="form-control select2" id="label_asset">
                                                <option value="-">-- Pilih Kode Asset --</option>
                                                {{-- <option value="1">HDD-01 -</option> --}}
                                            </select>
                                            {{-- <input type="text" name="lokasi" class="form-control" placeholder="Lokasi"> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Status Perangkat</label>
                                            <select name="status" class="form-control" id="label_asset">
                                                <option value="-">-- Pilih Status Perangkat --</option>
                                                <option value="1">Ada</option>
                                                <option value="0">Tidak Ada</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" onclick="reload()" class="btn btn-primary"><i class="fas fa-undo"></i> Reload</button>
                                </div>
                            </div>
                        </form>
                        <div class="col-12">
                            <div class="table-responsive mb-0 fixed-solution">
                                <table class="table table-bordered dt-responsive nowrap datatables"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Jenis Asset</th>
                                            <th>Kode Asset</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
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
            ajax: "{{ route('inventaris.it.perangkat.detail', ['id' => $inventarisITPerangkat->id]) }}",
            columns: [{
                    data: 'jenis_asset',
                    name: 'jenis_asset'
                },
                {
                    data: 'kode_asset',
                    name: 'kode_asset'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: true
                },
            ]
        });

        function buat() {
            $('.modalFormDetail').modal();
        }

        function reload() {
            table.ajax.reload();
        }

        $('#jenis_asset').change(function() {
            $.ajax({
                type: 'GET',
                url: "{{ url('it/perangkat/cari_asset') }}" + '/' + $('#jenis_asset').val(),
                contentType: "application/json;  charset=utf-8",
                cache: false,
                success: (result) => {
                    // alert(result.data.nama_label);
                    const dataOptions = result.data;
                    var option = "";

                    dataOptions.forEach(data);

                    function data(value, index) {
                        if (value.status == 0) {
                            var status = "Ready";
                        } else if (value.status == 1) {
                            var status = "Used";
                        }

                        if (value.nama_label == null) {
                            option = "<option>-</option>";
                        }
                        // option = "<option>-- Pilih Kode Asset --</option>";
                        option = option + "<option value=" + value.nama_label + ">" + value.nama_label +
                            " - " + status + "</option>";
                    }
                    document.getElementById('label_asset').innerHTML = option;
                },
                error: function(request, status, error) {
                    iziToast.error({
                        title: 'Error',
                        message: error,
                    });
                }
            });
        });

        function edit(id, id_inventaris_p) {
            $.ajax({
                type: 'GET',
                url: "{{ url('it/perangkat/') }}" + '/' + id + '/' + id_inventaris_p + '/edit',
                contentType: "application/json;  charset=utf-8",
                cache: false,
                success: (result) => {
                    // alert(result.data.nama_label);
                    // alert(result.data.kode_asset);
                    const dataOptionsAsset = result.asset;
                    var optionAsset = "";

                    dataOptionsAsset.forEach(data_asset);

                    function data_asset(value, index) {
                        if (value.nama_perangkat == result.data.jenis_asset) {
                            optionAsset = optionAsset + "<option value=" + value.nama_perangkat + " selected>" +
                                value.nama_perangkat + "</option>";
                        } else {
                            optionAsset = optionAsset + "<option value=" + value.nama_perangkat + ">" + value
                                .nama_perangkat + "</option>";
                        }
                    }
                    document.getElementById('edit_jenis_asset').innerHTML = optionAsset;
                    $('#edit_status').val(result.data.status)
                    //Digunakan
                    $.ajax({
                        type: 'GET',
                        url: "{{ url('it/perangkat/cari_asset') }}" + '/' + $('#edit_jenis_asset')
                        .val(),
                        contentType: "application/json;  charset=utf-8",
                        cache: false,
                        success: (result) => {
                            // alert(result.data.nama_label);
                            const dataOptions = result.data;
                            var option = "";

                            dataOptions.forEach(data);

                            function data(value, index) {
                                if (value.status == 0) {
                                    var status = "Ready";
                                } else if (value.status == 1) {
                                    var status = "Used";
                                }

                                if (value.nama_label == null) {
                                    option = "<option>-</option>";
                                }
                                option = option + "<option value=" + value.nama_label +
                                    ">" + value.nama_label + "</option>";
                            }
                            document.getElementById('edit_label_asset').innerHTML =
                                option;
                        },
                        error: function(request, status, error) {
                            iziToast.error({
                                title: 'Error',
                                message: error,
                            });
                        }
                    });

                    //Memilih
                    $('#edit_jenis_asset').change(function() {
                        // alert();
                        $.ajax({
                            type: 'GET',
                            url: "{{ url('it/perangkat/cari_asset') }}" + '/' + $(
                                '#edit_jenis_asset').val(),
                            contentType: "application/json;  charset=utf-8",
                            cache: false,
                            success: (result) => {
                                // alert(result.data.nama_label);
                                const dataOptions = result.data;
                                var option = "";

                                dataOptions.forEach(data);

                                function data(value, index) {
                                    if (value.status == 0) {
                                        var status = "Ready";
                                    } else if (value.status == 1) {
                                        var status = "Used";
                                    }

                                    if (value.nama_label == null) {
                                        option = "<option>-</option>";
                                    }
                                    option = option + "<option value=" + value.nama_label +
                                        ">" + value.nama_label +
                                        " - " + status + "</option>";
                                }
                                document.getElementById('edit_label_asset').innerHTML =
                                    option;
                            },
                            error: function(request, status, error) {
                                iziToast.error({
                                    title: 'Error',
                                    message: error,
                                });
                            }
                        });
                    });


                    $('.modalFormEdit').modal('show');
                },
                error: function(request, status, error) {
                    iziToast.error({
                        title: 'Error',
                        message: error,
                    });
                }
            });
        }

        function checkData(check_data) {
            // alert(check_data);
            $.ajax({
                type: 'GET',
                url: "{{ url('it/perangkat/'.$inventarisITPerangkat->id) }}" + '/' + check_data + '/check',
                contentType: "application/json;  charset=utf-8",
                cache: false,
                success: (result) => {
                    // alert(result.data);
                    document.getElementById('check_kode').innerHTML = result.data.nama_label;
                    if(result.detail == null){
                        document.getElementById('check_lokasi').innerHTML = '-';
                        document.getElementById('check_jenis_merk').innerHTML = '-';
                        document.getElementById('check_jenis_type').innerHTML = '-';
                        document.getElementById('check_spesifikasi').innerHTML = '-';
                    }else{
                        document.getElementById('check_lokasi').innerHTML = result.detail.lokasi;
                        document.getElementById('check_jenis_merk').innerHTML = result.detail.jenis_merk;
                        document.getElementById('check_jenis_type').innerHTML = result.detail.jenis_type;
                        document.getElementById('check_spesifikasi').innerHTML = result.detail.spesifikasi;
                    }
                    $('.modalCheck').modal('show');
                },
                error: function(request, status, error) {
                    iziToast.error({
                        title: 'Error',
                        message: error,
                    });
                }
            });
        }

        $('#form-simpan').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');
            $.ajax({
                type: 'POST',
                url: "{{ route('inventaris.it.perangkat.detail.simpan', ['id' => $inventarisITPerangkat->id]) }}",
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
