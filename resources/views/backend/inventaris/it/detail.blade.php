@extends('layouts.backend.app')
@section('title')
    Inventaris IT - {{ $inventaris_asset->nama_perangkat }}
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
            Inventaris IT
        @endslot
        @slot('li_3')
            @yield('title')
        @endslot
        @slot('title')
            @yield('title')
        @endslot
    @endcomponent

    @include('backend.inventaris.it.modalBuatForm')
    @include('backend.inventaris.it.modalEditForm')
    @include('backend.inventaris.it.modalDetailForm')
    @include('backend.inventaris.it.modalCheckForm')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary" onclick="buat()" data-bs-toggle="modal"
                        data-bs-target="#exampleModalCenter"><i class="fas fa-plus"></i> Tambah</button>
                    <button type="button" class="btn btn-primary" onclick="reload()"><i class="fas fa-undo"></i>
                        Refresh</button>
                    <a href="{{ route('inventaris.it.print.barcode',['id' => $inventaris_asset->id]) }}" class="btn btn-primary"><i class="fas fa-qrcode"></i>
                        Print Barcode</a>

                </div>
                <div class="card-body">
                    <div class="table-responsive mb-0 fixed-solution">
                        <table class="table table-bordered dt-responsive nowrap datatables"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Lokasi</th>
                                    <th>Merek</th>
                                    <th>Type</th>
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
    <script src="{{ URL::asset('public/assets/js/ckeditor5/ckeditor.js') }}"></script>

    {{-- <script src="{{ URL::asset('public/assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/pages/jquery.form-editor.init.js') }}"></script> --}}

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('.datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('inventaris.it.detail', ['id' => $inventaris_asset->id]) }}",
            columns: [{
                    data: 'nama_label',
                    name: 'nama_label'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                {
                    data: 'merek',
                    name: 'merek'
                },
                {
                    data: 'type',
                    name: 'type'
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

        ClassicEditor
        .create( document.querySelector( '#editor' ), {
            removePlugins: [ 'Link', 'CKFinder' ],
            toolbar: [ 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' , 'link' ]
        } )
        .catch( error => {
            console.log( error );
        } );

        function buat() {
            $('.modalBuat').modal();
        }

        function reload() {
            table.ajax.reload();
        }

        $('#edit_status').change(function(e){
            if(this.value == 3){
                document.getElementById('view_keterangan').style.display = 'block';
            }else if(this.value == 1){
                document.getElementById('view_keterangan').style.display = 'block';
            }else{
                document.getElementById('view_keterangan').style.display = 'none';
            }
        })

        $('#edit_perubahan_data').change(function(e){
            if(this.value == 'true'){
                document.getElementById('view_jenis_merk').style.display = 'block';
                document.getElementById('view_jenis_type').style.display = 'block';
                document.getElementById('view_status_barang').style.display = 'none';
                document.getElementById('view_keterangan').style.display = 'none';
            }else if(this.value == 'false'){
                document.getElementById('view_jenis_merk').style.display = 'none';
                document.getElementById('view_jenis_type').style.display = 'none';
                document.getElementById('view_status_barang').style.display = 'block';
                document.getElementById('view_keterangan').style.display = 'none';
            }else{
                document.getElementById('view_jenis_merk').style.display = 'none';
                document.getElementById('view_jenis_type').style.display = 'none';
                document.getElementById('view_status_barang').style.display = 'none';
                document.getElementById('view_keterangan').style.display = 'none';
            }
        })

        function checkForm(id) {
            // $('.modalCheckForm').modal('show');
            // alert(id);
            $.ajax({
                type: 'GET',
                url: "{{ url('it/inventaris/'.$inventaris_asset->id) }}" + '/' + id + "/check",
                contentType: "application/json;  charset=utf-8",
                cache: false,
                success: (result) => {
                    // alert(result.data.inventaris_asset_detail.status);
                    // $('#edit_id').val(result.data.inventaris_asset_detail.id);
                    // $('#edit_kode_label').val(result.data.inventaris_asset_detail.nama_label);
                    // $('#edit_label').val(result.data.inventaris_asset_detail.keterangan);
                    // $('.modalEdit').modal('show');
                    if(result.success != false){
                        document.getElementById('title_check').innerHTML = result.data.title;
                        document.getElementById('check_lokasi').innerHTML = result.data.lokasi;
                        document.getElementById('check_jenis_merek').innerHTML = result.data.jenis_merk;
                        document.getElementById('check_type_barang').innerHTML = result.data.jenis_type;
                        document.getElementById('check_spesifikasi').innerHTML = result.data.spesifikasi;
                        $('.modalCheckForm').modal('show');
                    }else{
                        iziToast.error({
                            title: 'Error',
                            message: result.message,
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
        }

        $('#form-simpan').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');
            $.ajax({
                type: 'POST',
                url: "{{ route('inventaris.it.detail.simpan', ['id' => $inventaris_asset->id]) }}",
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
                        $('.modalBuat').modal('hide');
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

        function edit(id) {
            // alert(id);
            var ids = id;
            $.ajax({
                type: 'GET',
                url: "{{ url('it/inventaris/'.$inventaris_asset->id) }}" + '/' + id,
                contentType: "application/json;  charset=utf-8",
                cache: false,
                success: (result) => {
                    // alert(result.data.inventaris_asset_detail.status);
                    $('#edit_id').val(result.data.inventaris_asset_detail.id);
                    $('#edit_kode_label').val(result.data.inventaris_asset_detail.nama_label);
                    $('#edit_label').val(result.data.inventaris_asset_detail.keterangan);
                    $('#edit_jenis_merk').val(result.data.inventaris_asset_detail_form.jenis_merk);
                    $('#edit_jenis_type').val(result.data.inventaris_asset_detail_form.jenis_type);
                    $('.modalEdit').modal('show');
                },
                error: function(request, status, error) {
                    iziToast.error({
                        title: 'Error',
                        message: error,
                    });
                }
            });
        }

        $('#form-edit').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');
            $.ajax({
                type: 'POST',
                url: "{{ url('it/inventaris/'.$inventaris_asset->id) }}" + '/' + $('#edit_id').val() +'/update',
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
                        $('.modalEdit').modal('hide');
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

        function detailForm(id,detailForm) {
            // alert("{{ url('it/inventaris/') }}"+ '/' + detailForm + '/' + id + '/detail_form');
            // alert('ID 1 : '+id+' ID 2 : '+detailForm);
            // var ids = id;
            $.ajax({
                type: 'GET',
                url: "{{ url('it/inventaris/') }}"+ '/' + id + '/' + detailForm + '/detail_form',
                contentType: "application/json;  charset=utf-8",
                cache: false,
                success: (result) => {
                    // alert(result);
                    $('#edit_form_id').val(result.data.id);
                    // $('#edit_kode_label').val(result.data.inventaris_asset_detail.nama_label);
                    // $('#edit_label').val(result.data.inventaris_asset_detail.keterangan);
                    document.getElementById('title_form').innerHTML = 'Formulir Data Kode '+result.data.nama_label;
                    $('.modalDetailForm').modal('show');
                },
                error: function(request, status, error) {
                    iziToast.error({
                        title: 'Error',
                        message: error,
                    });
                }
            });
        }

        $('#form-detailForm').submit(function(e) {
            // alert('test');
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');
            $.ajax({
                type: 'POST',
                url: "{{ url('it/inventaris/'.$inventaris_asset->id) }}"+ '/' + $('#edit_form_id').val() + '/detail_form/simpan',
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
                        $('.modalDetailForm').modal('hide');
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
