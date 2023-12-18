@extends('layouts.backend.app')
@section('title') Pengajuan Dokumen @endsection
@section('css')
    <link href="{{ URL::asset('public/assets/plugins/datatables/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('public/assets/plugins/datatables/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('public/assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('public/assets/css/iziToast.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('public/assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ URL::asset('public/assets/js/pages/jquery.sweet-alert.init.js') }}"></script>
@endsection

@section('content')
    @component('components.breadcrumb')
    @slot('li_1') Surat @endslot
    @slot('li_3') @yield('title') @endslot
    @slot('title') @yield('title') @endslot
    @endcomponent

    @include('backend.surat_office.modalBuat')
    @include('backend.surat_office.modalPreview')
    @include('backend.surat_office.modalPreviewVerifikasi')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if ($UserManagement->c == "Y")
                    <button type="button" class="btn btn-primary" onclick="buat()" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fas fa-plus"></i> Tambah</button>
                    @endif
                    <button type="button" class="btn btn-primary" onclick="reload()"><i class="fas fa-undo"></i> Refresh</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap datatables" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 1.5%" class="text-center">#</th>
                                <th style="width: 10%" class="text-center">Nomor Surat</th>
                                <th style="width: 10%" class="text-center">Tanggal Buat</th>
                                <th style="width: 10%" class="text-center">Keterangan</th>
                                <th style="width: 5%" class="text-center">Pengguna</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                    </table>
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
        ajax: "{{ route('surat_office') }}",
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'nomor_surat',
                name: 'nomor_surat'
            },
            {
                data: 'tanggal',
                name: 'tanggal'
            },
            {
                data: 'keterangan',
                name: 'keterangan'
            },
            {
                data: 'pengguna',
                name: 'pengguna'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],
        columnDefs: [
            {
                "targets": 0,
                "className": "text-center",
            },
            {
                "targets": 1,
                "className": "text-center",
            },
            {
                "targets": 2,
                "className": "text-center",
            },
            {
                "targets": 3,
                "className": "text-center",
            },
            {
                "targets": 4,
                "className": "text-center",
            },
        ]
    });

    function buat() {
        $('.modalBuat').modal();
    }

    function reload() {
        table.ajax.reload();
    }
    function previews(id) {
        // $('.modalPreviewsVerifikasi').modal('show');
        $.ajax({
            type:'GET',
            url: "{{ url('surat_office/') }}"+'/'+id+'/previews',
            contentType: "application/json;  charset=utf-8",
            cache: false,
            success: (result) => {
                // alert(result);
                // $('.modalPengajuan').modal('show');
                $('.modalPreviewsVerifikasi').modal('show');
                document.getElementById('preview_title_pengajuan').innerHTML = result.data.nomor_surat;
                $('#preview_nomor_surat').val(result.data.nomor_surat);
                $('#preview_tanggal').val(result.data.tanggal);
                $('#preview_keterangan').val(result.data.keterangan);
                $('#preview_pengguna').val(result.data.pengguna);
                if(result.data.status == 1){
                    document.getElementById('preview_status').innerHTML = '<span class="badge badge-outline-warning">Menunggu Persetujuan</span>';
                }else if(result.data.status == 2){
                    document.getElementById('preview_status').innerHTML = '<span class="badge badge-outline-success">Verifikasi</span>';
                }else if(result.data.status == 3){
                    document.getElementById('preview_status').innerHTML = '<span class="badge badge-outline-warning">Perlu Diupdate</span>';
                }else if(result.data.status == 4){
                    document.getElementById('preview_status').innerHTML = '<span class="badge badge-outline-danger">Ditolak</span>';
                }

                var berkas = result.berkas;
                var txt = "";

                berkas.forEach(dataBerkas);
                function dataBerkas(value, index) {
                    if(value.status == 1){
                        // $notif = 'finish';
                        var notif = 'continuous';
                        var status = '<span class="badge badge-outline-warning">Menunggu Persetujuan</span>';
                    }else if(value.status == 2){
                        var notif = 'finish';
                        var status = '<span class="badge badge-outline-success">Verifikasi</span>';
                    }else if(value.status == 3){
                        var notif = 'update';
                        var status = '<span class="badge badge-outline-warning">Perlu Diupdate</span>';
                    }else if(value.status == 4){
                        var notif = 'reject';
                        var status = '<span class="badge badge-outline-danger">Ditolak</span>';
                    }else{
                        var status = '<span class="badge badge-outline-primary">Available</span>';
                    }

                    txt = txt+'<tr>';
                    txt = txt+  '<td>'+value.files+'</td>';
                    txt = txt+  '<td>'+status+'</td>';
                    txt = txt+  '<td>'+value.remaks+'</td>';
                    txt = txt+  '<td>'+'<a href="'+value.download+'" class="btn btn-primary btn-icon">Download</a>'+'</td>';
                    txt = txt+'</tr>';
                }
                document.getElementById('preview_files').innerHTML =txt;
            },
            error: function (request, status, error) {
                iziToast.error({
                    title: 'Error',
                    message: error,
                });
            }
        });
    }

    function pengajuan(id) {
        // alert(id);
        var ids = id;
        $.ajax({
            type:'GET',
            url: "{{ url('surat_office/') }}"+'/'+id+'/pengajuan',
            contentType: "application/json;  charset=utf-8",
            cache: false,
            success: (result) => {
                // alert(result);
                $('.modalPengajuan').modal('show');
            },
            error: function (request, status, error) {
                iziToast.error({
                    title: 'Error',
                    message: error,
                });
            }
        });
    }

    function file_download(id) {
        $.ajax({
            type:'GET',
            url: "{{ url('surat_office/') }}"+'/'+id+'/download',
            contentType: "application/json;  charset=utf-8",
            cache: false,
            success: (result) => {
                window.location.href = result.download;
            },
            error: function (request, status, error) {
                // iziToast.error({
                //     title: 'Error',
                //     message: error,
                // });
            }
        });
    }

    function lihat(id) {
        // $('.modalPreviews').modal('show');
        $.ajax({
            type:'GET',
            url: "{{ url('surat_office/') }}"+'/'+id+'/pengajuan/view',
            contentType: "application/json;  charset=utf-8",
            cache: false,
            success: (result) => {
                // alert(result);
                $('.modalPreviews').modal('show');
                document.getElementById('lihat_title_pengajuan').innerHTML = result.data.nomor_surat;
                $('#preview_id').val(result.data.id);
                $('#lihat_nomor_surat').val(result.data.nomor_surat);
                $('#lihat_tanggal').val(result.data.tanggal);
                $('#lihat_keterangan').val(result.data.keterangan);

                var berkas = result.berkas;
                var txt = "";

                berkas.forEach(dataBerkas);
                function dataBerkas(value, index) {
                    if(value.status == 1){
                        // $notif = 'finish';
                        var notif = 'continuous';
                        var status = '<span class="badge badge-outline-warning">Menunggu Persetujuan</span>';
                    }else if(value.status == 2){
                        var notif = 'finish';
                        var status = '<span class="badge badge-outline-success">Verifikasi</span>';
                    }else if(value.status == 3){
                        var notif = 'update';
                        var status = '<span class="badge badge-outline-warning">Perlu Diupdate</span>';
                    }else if(value.status == 4){
                        var notif = 'reject';
                        var status = '<span class="badge badge-outline-danger">Ditolak</span>';
                    }else{
                        var status = '<span class="badge badge-outline-primary">Available</span>';
                    }

                    txt = txt+'<tr>';
                    txt = txt+  '<td>'+value.files+'</td>';
                    txt = txt+  '<td>'+status+'</td>';
                    txt = txt+  '<td>'+'<a href="'+value.download+'" class="btn btn-primary btn-icon">Download</a>'+'</td>';
                    txt = txt+'</tr>';
                }
                document.getElementById('files').innerHTML =txt;
            },
            error: function (request, status, error) {
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
        // $('#image-input-error').text('');
        $.ajax({
            type:'POST',
            url: "{{ route('surat_office.simpan') }}",
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

    $('#form-verifikasi').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        // $('#image-input-error').text('');
        $.ajax({
            type:'POST',
            url: "{{ route('surat_office.pengajuan.verifikasi') }}",
            // url: "{{ url('surat_office/') }}"+'/'+e+'/pengajuan/verifikasi',
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
                    $('.modalPreviews').modal('hide');
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