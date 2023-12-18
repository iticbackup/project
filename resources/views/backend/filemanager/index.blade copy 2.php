@extends('layouts.backend.app')
@section('title') File Manager @endsection
@section('css')
<link href="{{ URL::asset('assets/css/iziToast.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title">File Managers</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Apps</a></li>
                        <li class="breadcrumb-item active">File Manager</li>
                    </ol>
                </div><!--end col-->
                <div class="col-auto align-self-center">
                    {{-- <button class="btn btn-outline-primary btn-sm add-file"><i class="fas fa-plus me-2 "></i>Create Folder</button>
                    <div class="add-file btn btn-outline-primary btn-sm position-relative overflow-hidden">
                        <i class="las la-cloud-upload-alt me-2 font-15"></i>Upload File
                        <input type="file" name="file" class="add-file-input"/>
                    </div>    --}}
                    <input id="Add_File" type="file" name="files[]" multiple style='display: none;'>
                    <a href="#" class="btn btn-sm btn-outline-primary" id="Dash_Date">
                        <span class="day-name" id="Day_Name">Today:</span>&nbsp;
                        <span class="" id="Select_date">Jan 11</span>
                        <i data-feather="calendar" class="align-self-center icon-xs ms-1"></i>
                    </a>
                    {{-- <a href="#" class="btn btn-sm btn-outline-primary">
                        <i data-feather="download" class="align-self-center icon-xs"></i>
                    </a> --}}
                </div><!--end col-->  
            </div><!--end row-->                                                              
        </div><!--end page-title-box-->
    </div><!--end col-->
</div><!--end row-->

<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Kategori</h4>
                    </div><!--end col-->
                    <div class="col-auto">
                        <div class="dropdown">
                            @if ($UserManagement->c == "Y")
                            <a href="javascript:void()" class="btn btn-sm btn-outline-primary" onclick="buatKategori()"><i class="fas fa-plus me-2 "></i>Create Folder</a>
                            @endif
                            <a href="javascript:void()" class="btn btn-sm btn-outline-primary" onclick="kategori()"><i class="fas fa-undo-alt me-2 "></i>Reload</a>
                            {{-- <a href="#" class="btn btn-sm btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal text-muted"></i>
                            </a> --}}
                            {{-- <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="javascript:void()" onclick="buatKategori()">Create Folder</a>
                                <a class="dropdown-item" href="javascript:void()" onclick="kategori()">Refresh</a>
                            </div> --}}
                        </div>
                    </div><!--end col-->
                </div>  <!--end row-->
            </div><!--end card-header-->
            <div class="card-body">
                <div class="status-holder"></div>
                <div class="files-nav">
                    <div class="nav flex-column nav-pills kategori" id="files-tab" aria-orientation="vertical">
                    </div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->

        <div class="card">
            <div class="card-body">
                <small class="float-end">{{$diskuse}}</small>
                <h6 class="mt-0">{{round($disk_used_size,2)}} GB / {{round($total_disk_size,2)}} GB Used</h6>
                <div class="progress" style="height: 5px;">
                    @if ($diskuse >= '90 %')
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{$diskuse}};" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                    @else
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$diskuse}};" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-9">
        <div class="">
            <div class="tab-content" id="files-tabContent">
                <div class="status-holder1"></div>
                <div id="judul"></div>
                <div class="file-box-content">
                    <div id="subBerkas"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.filemanager.modalBuatKategori')
@include('backend.filemanager.modalBuatSubKategori')
@include('backend.filemanager.modalView')

@endsection

@section('script')
<script src="{{ URL::asset('assets/js/app.js') }}"></script>
<script src="{{ URL::asset('assets/js/iziToast.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/jquery.form-upload.init.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script>
    function buatKategori() {
        $('.modalBuatKategori').modal('show');
    }

    function kategori() {
        $.ajax({
            type:'GET',
            url: "{{ route('filemanagers.berkas') }}",
            contentType: "application/json;  charset=utf-8",
            cache: false,
            beforeSend: function() {
                $('.status-holder').html('<div class="spinner-border spinner-border-custom-2 text-primary" role="status"></div>');
            },
            success: (result) => {
                if(result.success === false){
                    $('.status-holder').html('Data tidak tersedia');
                }else{
                    var dataKategori = result.data;
                    var txt = "";
                    dataKategori.forEach(data);
                    function data(value, index) {
                        txt = txt+'<a class="nav-link" id="files-'+value.nama_departemen+'" data-bs-toggle="pill" href="#'+value.nama_departemen+'" onclick="subBerkas(`'+value.id+'`)" aria-selected="true">'+
                                        '<i class="align-self-center icon-dual-file icon-lg mdi mdi-folder" style="font-size: 25px"></i>'+'</i>'+
                                        // '<i data-feather="folder" class="align-self-center icon-dual-file icon-sm me-3">'+'</i>'+
                                        '<div class="d-inline-block align-self-center">'+
                                            '<h5 class="m-0">'+value.nama_departemen+'</h5>'+
                                            '<small>'+'Tanggal dibuat '+value.created_at+'</small>'+
                                        '</div>'+
                                        // '<a class="btn btn-sm btn-outline-primary ms-auto dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                                        //     '<i class="mdi mdi-dots-horizontal text-muted"></i>'+
                                        // '</a>'+
                                        // '<div class="dropdown-menu dropdown-menu-end">'+
                                        //     '<a class="dropdown-item" href="javascript:void()">Create Folder</a>'+
                                        // '</div>'+
                                        // '<button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Primary <i class="mdi mdi-chevron-down"></i></button>'+
                                        // '<a class="btn btn-outline-primary btn-sm ms-auto"><i class="mdi mdi-dots-horizontal text-muted"></i></a>'+
                                        // '<span class="badge bg-success ms-auto font-10">8</span>'+
                                    '</a>';
                    };
                    document.getElementsByClassName("kategori")[0].innerHTML=txt;
                }
                // document.getElementById('kategori').innerHTML=txt;
            },
            complete:function(data){
                // Hide image container
                $(".status-holder").hide();
            }
        });
    };

    function subBerkasKategori(id) {
        $.ajax({
            type:'GET',
            url: "{{ url('file-managers/') }}"+'/'+id,
            contentType: "application/json;  charset=utf-8",
            cache: false,
            success: (result) => {
                // alert(result);
                $('.modalBuatSubKategori').modal('show');
                // document.getElementById('edit_pengguna').innerHTML = 'Edit - '+result.data.name;
                // $('#edit_id').val(result.data.id);
                $('#buat_file_managers_id').val(result.data.id);
                $('#buatKategoriFolder').val(result.data.nama_berkas);
                // $('#edit_name').val(result.data.name);
                // $('#edit_email').val(result.data.email);
                // $('#edit_roles').val(result.data.roles);
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

    function subBerkas(id) {
        $.ajax({
            type:'GET',
            url: "{{ url('file-managers') }}"+'/'+id,
            contentType: "application/json;  charset=utf-8",
            cache: false,
            beforeSend: function(xhr) {
                $('.status-holder1').html('<div class="spinner-border spinner-border-custom-2 text-primary" role="status"></div>');
            },
            success: (result) => {
                document.getElementById('judul').innerHTML ='<h4 class="card-title mt-0 mb-3">'+'<i class="align-self-center icon-dual-file icon-lg mdi mdi-folder"></i> '+result.detail.nama_berkas+'<button onclick="uploadBerkas(`'+result.detail.id+'`)" class="btn btn-outline-primary btn-sm add-file" style="margin-left: 1%"><i class="las la-cloud-upload-alt me-2 font-15"></i>Upload File</button>'+'</h4>';
                var dataList2 = result.data;
                var txt2 = "";
                dataList2.forEach(berkas2);
                function berkas2(value, index) {
                    if(value == null){
                        txt2 = 'Data Belum Tersedia';
                    }else{
                        const ids = value.id;
                        var url_download = window.location.href+'/'+ids+'/'+'download';
                        // alert(window.location.href+'/'+ids+'/'+'download');
                        txt2 = txt2+'<div class="file-box">';
                        txt2 = txt2+  '<a href='+url_download+' class="download-icon-link" style="margin-left: -10%">';
                        txt2 = txt2+    '<i class="dripicons-download file-download-icon"></i>';
                        txt2 = txt2+  '</a>';
                        txt2 = txt2+  '<a onclick="hapus(`'+value.id+'`)" class="download-icon-link" style="margin-left: 2.5%">';
                        txt2 = txt2+    '<i class="dripicons-trash file-download-icon"></i>';
                        txt2 = txt2+  '</a>';
                        txt2 = txt2+  '<a href="javascript:void()" onclick="lihatFile(`'+value.id+'`)">';
                        txt2 = txt2+   '<div class="text-center">';
                                        if(value.extension == 'pdf'){
                        txt2 = txt2+     '<i class="mdi mdi-file-pdf-box text-danger"></i>';
                                        }else if(value.extension == 'xlsx' || value.extension == 'xls'){
                        txt2 = txt2+     '<i class="mdi mdi-file-excel-box" style="color: #1f7244"></i>';
                                        }else if(value.extension == 'docx' || value.extension == 'doc'){
                        txt2 = txt2+     '<i class="mdi mdi-file-word-box" style="color: #2a5699"></i>';
                                        }
                        txt2 = txt2+     '<h6 class="text-truncate">'+value.files+'</h6>';
                        txt2 = txt2+     '<small class="text-muted">'+value.created_at+'</small>';
                        txt2 = txt2+   '</div>';
                        txt2 = txt2+  '</a>';
                        txt2 = txt2+'</div>';
                    }
                }
                document.getElementById('subBerkas').innerHTML =txt2;
            },
            complete:function(data){
                // Hide image container
                $(".status-holder1").hide();
            },
            error: function (request, status, error) {
                // iziToast.error({
                //     title: 'Error',
                //     message: error,
                // });
            }
        });
    };

    function lihatFile(id) {
        // alert(id);
        $.ajax({
            type:'GET',
            url: "{{ url('file-managers') }}"+'/'+id+'/viewpdf',
            contentType: "application/json;  charset=utf-8",
            cache: false,
            success: (result) => {
                document.getElementById('viewer').innerHTML = '<iframe src="'+result.url+'" width="100%" height="720px" scrolling="auto" frameBorder="0"></frame>'
                $('.modalView').modal('show');
                // document.getElementById('judul').innerHTML = result.detail.nama_berkas;
            },
            error: function (request, status, error) {
                // iziToast.error({
                //     title: 'Error',
                //     message: error,
                // });
            }
        });
    }

    function uploadBerkas(id) {
        $.ajax({
            type:'GET',
            url: "{{ url('file-managers') }}"+'/'+id,
            contentType: "application/json;  charset=utf-8",
            cache: false,
            success: (result) => {
                $('#buat_file_managers_id').val(result.detail.id);
                $('#buatKategoriFolder').val(result.detail.nama_berkas);
                $('.modalBuatSubKategori').modal('show');
                // document.getElementById('judul').innerHTML = result.detail.nama_berkas;
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

    function hapus(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            // text: id,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '$success',
            cancelButtonColor: '$danger',
            confirmButtonText: 'Yes, delete it!'
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type:'GET',
                    url: "{{ url('file-managers') }}"+'/'+id+'/delete',
                    contentType: "application/json;  charset=utf-8",
                    cache: false,
                    success: (result) => {
                        subBerkas(result.message_id);
                        Swal.fire(
                            'Deleted!',
                            result.message_content,
                            result.message_type
                        )
                    },
                });
            }
        });
    };

    $('#form-buatKategori-simpan').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $('#image-input-error').text('');
        $.ajax({
            type:'POST',
            url: "{{ route('filemanagers.kategoriBerkas.simpan') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: (result) => {
                if(result.success != false){
                    iziToast.success({
                        title: result.message_title,
                        message: result.message_content
                    });
                    // this.reset();
                    kategori();
                    // $('.modalBuat').hide();
                    // table.ajax.reload();
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

    $('#form-buatSubKategori-simpan').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $('#image-input-error').text('');
        $.ajax({
            type:'POST',
            url: "{{ route('filemanagers.subkategoriBerkas.simpan') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: (result) => {
                if(result.success != false){
                    iziToast.success({
                        title: result.message_title,
                        message: result.message_content
                    });
                    // this.reset();
                    subBerkas(result.message_id);
                    // $('.modalBuat').hide();
                    // table.ajax.reload();
                }else{
                    iziToast.error({
                        title: result.message_title,
                        message: result.message_content
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

    kategori();
</script>
@endsection