@extends('layouts.backend.app')
@section('title') File Manager | Disk Usage @endsection
@section('css')
<link href="{{ URL::asset('public/assets/plugins/datatables/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('public/assets/plugins/datatables/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('public/assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('public/assets/css/iziToast.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('public/assets/plugins/ion-rangeslider/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    @component('components.breadcrumb')
    @slot('li_1') Disk Usage @endslot
    @slot('li_3') @yield('title') @endslot
    @slot('title') @yield('title') @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{-- <h4 class="card-title">Users</h4> --}}
                    <button type="button" class="btn btn-primary" onclick="buat()" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fas fa-plus"></i> Tambah</button>
                    <button type="button" class="btn btn-primary" onclick="reload()"><i class="fas fa-undo"></i> Refresh</button>
                </div>
                <div class="card-body">
                    <table id="datatables" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Departemen</th>
                                <th>Limit Storage</th>
                                <th>Storage</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('backend.filemanager.disk_usage.modalBuat')
    @include('backend.filemanager.disk_usage.modalEdit')
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
<script src="{{ URL::asset('public/assets/plugins/ion-rangeslider/ion.rangeSlider.min.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#range_01").ionRangeSlider({
        grid:!0,
        skin:"flat",
        min:1,
        max:100,
        from:1,
        prefix:"GB ",
        max_postfix:""
    });

    var table = $('#datatables').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('disk_managemen') }}",
        columns: [
            {
                data: 'departemen_id',
                name: 'departemen_id'
            },
            {
                data: 'limit_disk',
                name: 'limit_disk'
            },
            {
                data: 'disk_storage',
                name: 'disk_storage'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });

    function buat() {
        $('.modalBuat').modal();
    }

    function reload() {
        table.ajax.reload();
    }

    function edit(id) {
        $.ajax({
            type:'GET',
            url: "{{ url('disk-managemen/') }}"+'/'+id,
            contentType: "application/json;  charset=utf-8",
            cache: false,
            success: (result) => {
                // alert(result.data.departemen);
                // this.reset();
                const limit = result.data.limit_disk;
                $('#edit_departemen_id').val(result.data.departemen_id);
                $('#edit_file_manager_disk').val(result.data.id);
                $("#edit_range_01").ionRangeSlider({
                    grid:!0,
                    skin:"flat",
                    min:1,
                    max:100,
                    from:limit,
                    prefix:"GB ",
                    max_postfix:""
                });

                $('.modalEdit').modal('show');
            },
            error: function (request, status, error) {
                // iziToast.error({
                //     title: 'Error',
                //     message: error,
                // });
            }
        });
        // $('.modalBuatSubKategori').modal('show');
    };

    $('#form-simpan').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $('#image-input-error').text('');
        $.ajax({
            type:'POST',
            url: "{{ route('disk_managemen.simpan') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: (result) => {
                if(result.success != false){
                    iziToast.success({
                        title: result.message_title,
                        message: result.message_content
                    });
                    this.reset();
                    // $('.modalBuat').hide();
                    table.ajax.reload();
                }else{
                    iziToast.error({
                        title: result.success,
                        message: result.error
                    });
                }
            },
            error: function (request, status, error) {
                iziToast.error({
                    title: 'Error',
                    message: error,
                });
            }
        });
    });

    $('#edit-form').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $('#image-input-error').text('');
        $.ajax({
            type:'POST',
            url: "{{ route('disk_managemen.update') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: (result) => {
                if(result.success != false){
                    iziToast.success({
                        title: result.message_title,
                        message: result.message_content
                    });
                    table.ajax.reload();
                }else{
                    iziToast.error({
                        title: result.success,
                        message: result.error
                    });
                }
            },
            error: function (request, status, error) {
                iziToast.error({
                    title: 'Error',
                    message: error,
                });
            }
        });
    });
</script>
@endsection