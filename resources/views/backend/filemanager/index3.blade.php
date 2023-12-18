@extends('layouts.backend.app')
@section('title') File Manager @endsection
@section('css')
<link href="{{ URL::asset('assets/css/iziToast.css') }}" rel="stylesheet" type="text/css" />
    
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
                            <a href="javascript:void()" class="btn btn-sm btn-outline-primary" onclick="buatKategori()"><i class="fas fa-plus me-2 "></i>Create Folder</a>
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
                <div class="files-nav">
                    <div class="nav flex-column nav-pills kategori" id="files-tab" aria-orientation="vertical">
                        {{-- <div id="kategori"></div> --}}
                        {{-- @forelse ($file_managers as $file_manager)
                        <?php $folder = $file_manager->slug; ?>
                        <a class="nav-link" id="files-{{ $file_manager->slug }}" data-bs-toggle="pill" href="#{{ $file_manager->slug }}" onclick="subBerkas({{ $file_manager->id }})" aria-selected="true">
                            <i class="align-self-center icon-dual-file icon-lg mdi mdi-folder" style="font-size: 25px"></i>
                            <div class="d-inline-block align-self-center">
                                <h5 class="m-0">{{ $file_manager->nama_berkas }}</h5>
                                <small>Tanggal dibuat {{ \Carbon\Carbon::parse($file_manager->created_at)->isoFormat('LLL') }}</small>
                            </div>
                        </a>
                        @empty
                        Data Kosong  
                        @endforelse --}}
                        {{-- <a class="nav-link" id="files-pdf-tab" data-bs-toggle="pill" href="#files-pdf" aria-selected="false">
                            <i data-feather="folder" class="align-self-center icon-dual-file icon-sm me-3"></i>
                            <div class="d-inline-block align-self-center">
                                <h5 class="m-0">Pdf Files</h5>
                                <small>80GB/200GB Used</small>
                            </div>
                        </a>
                        <a class="nav-link  align-items-center" id="files-documents-tab" data-bs-toggle="pill" href="#files-documents" aria-selected="false">
                            <i data-feather="folder" class="align-self-center icon-dual-file icon-sm me-3"></i>
                            <div class="d-inline-block align-self-center">
                                <h5 class="m-0">Documents</h5>
                                <small>80GB/200GB Used</small>
                            </div>
                            <span class="badge bg-success ms-auto font-10">8</span>
                        </a>
                        <a class="nav-link mb-0"  href="#" data-bs-toggle="modal" data-animation="bounce" data-bs-target=".hide-modal">
                            <i data-feather="lock" class="align-self-center icon-dual-file icon-sm me-3"></i>
                            <div class="d-inline-block align-self-center">
                                <h5 class="m-0">Files Lock</h5>
                                <small>80GB/200GB Used</small>
                            </div>
                        </a> --}}
                    </div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->

        <div class="card">
            <div class="card-body">
                <small class="float-end">62%</small>
                <h6 class="mt-0">620GB / 1TB Used</h6>
                <div class="progress" style="height: 5px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 62%;" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->

    <div class="col-lg-7">
        <div class="">
            <div class="tab-content" id="files-tabContent">

                <div id="subBerkas"></div>
                {{-- @forelse ($subBerkas as $item)
                <div class="tab-pane fade" id="files-{{ $folder }}">
                    <h4 class="card-title mt-0 mb-3">{{ $item->sub_nama_berkas }}</h4>
                    <div class="file-box-content">
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-alt text-primary"></i>
                                <h6 class="text-truncate">Admin_Panel</h6>
                                <small class="text-muted">06 March 2019 / 5MB</small>
                            </div>
                        </div>
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-code text-danger"></i>
                                <h6 class="text-truncate">Ecommerce.pdf</h6>
                                <small class="text-muted">15 March 2019 / 8MB</small>
                            </div>
                        </div>
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-archive text-warning"></i>
                                <h6 class="text-truncate">Payment_app.zip</h6>
                                <small class="text-muted">11 April 2019 / 10MB</small>
                            </div>
                        </div>
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file text-secondary"></i>
                                <h6 class="text-truncate">App_landing_001</h6>
                                <small class="text-muted">06 March 2019 / 5MB</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h4 class="card-title my-3">Freelancing Projects</h4>
                        </div>
                    </div>
                    <div class="file-box-content">
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-alt text-primary"></i>
                                <h6 class="text-truncate">Admin_Panel</h6>
                                <small class="text-muted">06 March 2019 / 5MB</small>
                            </div>
                        </div>
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-code text-info"></i>
                                <h6 class="text-truncate">Ecommerce.pdf</h6>
                                <small class="text-muted">15 March 2019 / 8MB</small>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                Data Kosong
                @endforelse --}}
                {{-- <div class="tab-pane fade" id="files-projects">
                    <h4 class="card-title mt-0 mb-3">Projects</h4>
                    <div class="file-box-content">
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-alt text-primary"></i>
                                <h6 class="text-truncate">Admin_Panel</h6>
                                <small class="text-muted">06 March 2019 / 5MB</small>
                            </div>
                        </div>
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-code text-danger"></i>
                                <h6 class="text-truncate">Ecommerce.pdf</h6>
                                <small class="text-muted">15 March 2019 / 8MB</small>
                            </div>
                        </div>
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-archive text-warning"></i>
                                <h6 class="text-truncate">Payment_app.zip</h6>
                                <small class="text-muted">11 April 2019 / 10MB</small>
                            </div>
                        </div>
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file text-secondary"></i>
                                <h6 class="text-truncate">App_landing_001</h6>
                                <small class="text-muted">06 March 2019 / 5MB</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h4 class="card-title my-3">Freelancing Projects</h4>
                        </div>
                    </div>
                    <div class="file-box-content">
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-alt text-primary"></i>
                                <h6 class="text-truncate">Admin_Panel</h6>
                                <small class="text-muted">06 March 2019 / 5MB</small>
                            </div>
                        </div>
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-code text-info"></i>
                                <h6 class="text-truncate">Ecommerce.pdf</h6>
                                <small class="text-muted">15 March 2019 / 8MB</small>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="tab-pane fade show active" id="files-projects"> --}}
                {{-- <div class="tab-pane fade" id="files-projects">
                    <h4 class="card-title mt-0 mb-3">Projects</h4>
                    <div class="file-box-content">
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-alt text-primary"></i>
                                <h6 class="text-truncate">Admin_Panel</h6>
                                <small class="text-muted">06 March 2019 / 5MB</small>
                            </div>
                        </div>
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-code text-danger"></i>
                                <h6 class="text-truncate">Ecommerce.pdf</h6>
                                <small class="text-muted">15 March 2019 / 8MB</small>
                            </div>
                        </div>
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-archive text-warning"></i>
                                <h6 class="text-truncate">Payment_app.zip</h6>
                                <small class="text-muted">11 April 2019 / 10MB</small>
                            </div>
                        </div>
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file text-secondary"></i>
                                <h6 class="text-truncate">App_landing_001</h6>
                                <small class="text-muted">06 March 2019 / 5MB</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h4 class="card-title my-3">Freelancing Projects</h4>
                        </div>
                    </div>
                    <div class="file-box-content">
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-alt text-primary"></i>
                                <h6 class="text-truncate">Admin_Panel</h6>
                                <small class="text-muted">06 March 2019 / 5MB</small>
                            </div>
                        </div>
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-code text-info"></i>
                                <h6 class="text-truncate">Ecommerce.pdf</h6>
                                <small class="text-muted">15 March 2019 / 8MB</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="files-pdf">
                    <h4 class="mt-0 card-title mb-3">PDF Files</h4>
                    <div class="file-box-content">
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-pdf text-info"></i>
                                <h6 class="text-truncate">Admin_Panel</h6>
                                <small class="text-muted">06 March 2019 / 5MB</small>
                            </div>
                        </div>
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-pdf text-danger"></i>
                                <h6 class="text-truncate">Ecommerce.pdf</h6>
                                <small class="text-muted">15 March 2019 / 8MB</small>
                            </div>
                        </div>
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-pdf text-warning"></i>
                                <h6 class="text-truncate">Payment_app.zip</h6>
                                <small class="text-muted">11 April 2019 / 10MB</small>
                            </div>
                        </div>
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-pdf text-secondary"></i>
                                <h6 class="text-truncate">App_landing_001.pdf</h6>
                                <small class="text-muted">06 March 2019 / 5MB</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="files-documents">
                    <h4 class="mt-0 card-title mb-3">Documents</h4>
                    <div class="file-box-content">
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-pdf text-info"></i>
                                <h6 class="text-truncate">Adharcard_update</h6>
                                <small class="text-muted">06 March 2019 / 5MB</small>
                            </div>
                        </div>
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-pdf text-danger"></i>
                                <h6 class="text-truncate">Pancard</h6>
                                <small class="text-muted">15 March 2019 / 8MB</small>
                            </div>
                        </div>
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-pdf text-warning"></i>
                                <h6 class="text-truncate">ICICI_statment</h6>
                                <small class="text-muted">11 April 2019 / 10MB</small>
                            </div>
                        </div>
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-pdf text-secondary"></i>
                                <h6 class="text-truncate">March_Invoice</h6>
                                <small class="text-muted">06 March 2019 / 5MB</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h4 class="card-title my-3">Company Documents</h4>
                        </div>
                    </div>
                    <div class="file-box-content">
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-pdf text-success"></i>
                                <h6 class="text-truncate">Adharcard_update</h6>
                                <small class="text-muted">06 March 2019 / 5MB</small>
                            </div>
                        </div>
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-pdf text-pink"></i>
                                <h6 class="text-truncate">Pancard</h6>
                                <small class="text-muted">15 March 2019 / 8MB</small>
                            </div>
                        </div>
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-pdf text-purple"></i>
                                <h6 class="text-truncate">ICICI_statment</h6>
                                <small class="text-muted">11 April 2019 / 10MB</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h4 class="card-title my-3">Personal Documents</h4>
                        </div>
                    </div>
                    <div class="file-box-content">
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-pdf text-blue"></i>
                                <h6 class="text-truncate">Adharcard_update</h6>
                                <small class="text-muted">06 March 2019 / 5MB</small>
                            </div>
                        </div>
                        <div class="file-box">
                            <a href="#" class="download-icon-link">
                                <i class="dripicons-download file-download-icon"></i>
                            </a>
                            <div class="text-center">
                                <i class="lar la-file-pdf text-dark"></i>
                                <h6 class="text-truncate">Pancard</h6>
                                <small class="text-muted">15 March 2019 / 8MB</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="files-hide">
                    <h4 class="mt-0 card-title mb-3">Hide</h4>
                </div> --}}
            </div>  <!--end tab-content-->
        </div><!--end card-body-->
    </div>
</div>

@include('backend.filemanager.modalBuatKategori')
@include('backend.filemanager.modalBuatSubKategori')

<div class="modal fade hide-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title mt-0" id="exampleModalLabel">Enter Password</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="index">
                    <div class="mb-4 mt-2 ">
                        <span class="thumb-xl justify-content-center d-flex align-items-center bg-soft-danger rounded-circle mx-auto"><i class="las la-lock"></i></span>
                    </div>
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="HideCard">
                        <button class="btn btn-primary" type="button" id="HideCard"><i class="las la-key"></i></button>
                    </div>
                    <div class="text-end mt-1">
                        <a href="#" class="text-primary font-12"><i class="las la-lock"></i> Forgot password?</a>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@endsection

@section('script')
<script src="{{ URL::asset('assets/js/app.js') }}"></script>
<script src="{{ URL::asset('assets/js/iziToast.min.js') }}"></script>

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
            success: (result) => {
                var dataKategori = result.data;
                var txt = "";
                dataKategori.forEach(data);
                function data(value, index) {
                    txt = txt+'<a class="nav-link" id="files-'+value.slug+'" data-bs-toggle="pill" href="#'+value.slug+'" onclick="subBerkas('+value.id+')" aria-selected="true">'+
                                    '<i class="align-self-center icon-dual-file icon-lg mdi mdi-folder" style="font-size: 25px"></i>'+'</i>'+
                                    // '<i data-feather="folder" class="align-self-center icon-dual-file icon-sm me-3">'+'</i>'+
                                    '<div class="d-inline-block align-self-center">'+
                                        '<h5 class="m-0">'+value.nama_berkas+'</h5>'+
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
                                '</a>'+
                                '<a class="btn btn-sm btn-outline-primary ms-auto dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                                    '<i class="mdi mdi-dots-horizontal text-muted"></i>'+
                                '</a>'+
                                '<div class="dropdown-menu dropdown-menu-end">'+
                                    '<a class="dropdown-item" href="javascript:void()" onclick="subBerkasKategori(`'+value.id+'`)">Create Folder</a>'+
                                '</div>'
                                ;
                };
                document.getElementsByClassName("kategori")[0].innerHTML=txt;
                // document.getElementById('kategori').innerHTML=txt;
            }
        });
    }

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
    }

    function subBerkas(id) {
        $.ajax({
            type:'GET',
            url: "{{ url('file-managers') }}"+'/'+id+'/sub-berkas',
            contentType: "application/json;  charset=utf-8",
            cache: false,
            success: (result) => {
                // var dataBerkas = result.file_managers_detail_list;
                // var txt2 = "";
                // dataBerkas.forEach(berkas);
                // function berkas(value, index) {
                //     if(value == null){
                //         txt2 = 'Data Belum Tersedia';
                //     }else{
                //         txt2 = txt2+'<div class="file-box">'+
                //                         '<a href="#" class="download-icon-link">'+
                //                             '<i class="dripicons-download file-download-icon"></i>'+
                //                         '</a>'+
                //                         '<div class="text-center">'+
                //                             '<i class="mdi mdi-file-pdf text-danger"></i>'+
                //                             '<h6 class="text-truncate">'+value.nama_file+'</h6>'+
                //                             '<small class="text-muted">'+value.created_at+'</small>'+
                //                         '</div>'+
                //                     '</div>';
                //                     // '<div>'+
                //                     //     '<input type="file" class="form-control">'+
                //                     // '</div>';
                //     }
                // }

                var dataKategori = result.file_managers_list;
                var txt = "";

                var dataBerkas = result.file_managers_detail_list;
                console.table(dataBerkas);
                var txt2 = "";
                dataBerkas.forEach(berkas);
                function berkas(value, index) {
                    if(value == null){
                        txt2 = 'Data Belum Tersedia';
                    }else{
                        txt2 = txt2+'<div class="file-box">'+
                                        '<a href="#" class="download-icon-link">'+
                                            '<i class="dripicons-download file-download-icon"></i>'+
                                        '</a>'+
                                        '<div class="text-center">'+
                                            '<i class="mdi mdi-file-pdf text-danger"></i>'+
                                            '<h6 class="text-truncate">'+value.nama_file+'</h6>'+
                                            '<small class="text-muted">'+value.created_at+'</small>'+
                                        '</div>'+
                                    '</div>';
                                    // '<div>'+
                                    //     '<input type="file" class="form-control">'+
                                    // '</div>';
                    }
                };
                
                dataKategori.forEach(data);
                function data(value, index) {
                    if(value == null){
                        txt = 'Data Belum Tersedia';
                    }else{
                        txt = txt+'<div class="tab-pane show" id="files-'+value.slug+'">'+
                                    // '<h4 class="card-title mt-0 mb-3">'+value.sub_nama_berkas+'<button class="btn btn-outline-primary btn-sm add-file" style="margin-left: 2%" onclick="subBerkasKategori(`'+value.id+'`)"><i class="fas fa-plus me-2 "></i>Create Folder</button>'+'<button class="btn btn-outline-primary btn-sm add-file" style="margin-left: 0.3%"><i class="las la-cloud-upload-alt me-2 font-15"></i>Upload File</button>'+'</h4>'+
                                    '<h4 class="card-title mt-0 mb-3">'+'<i class="align-self-center icon-dual-file icon-lg mdi mdi-folder"></i> '+value.sub_nama_berkas+'<button class="btn btn-outline-primary btn-sm add-file" style="margin-left: 1%"><i class="las la-cloud-upload-alt me-2 font-15"></i>Upload File</button>'+'</h4>'+
                                    '<div class="file-box-content mb-1">'+
                                        txt2+
                                        // '<div class="file-box">'+
                                        //     '<a href="#" class="download-icon-link">'+
                                        //         '<i class="dripicons-download file-download-icon"></i>'+
                                        //     '</a>'+
                                        //     '<div class="text-center">'+
                                        //         '<i class="lar la-file-alt text-primary"></i>'+
                                        //         '<h6 class="text-truncate">Admin_Panel</h6>'+
                                        //         '<small class="text-muted">06 March 2019 / 5MB</small>'+
                                        //     '</div>'+
                                        // '</div>'+
                                        // '<div class="file-box">'+
                                        //     '<a href="#" class="download-icon-link">'+
                                        //         '<i class="dripicons-download file-download-icon"></i>'+
                                        //     '</a>'+
                                        //     '<div class="text-center">'+
                                        //         '<i class="lar la-file-code text-danger"></i>'+
                                        //         '<h6 class="text-truncate">Ecommerce.pdf</h6>'+
                                        //         '<small class="text-muted">15 March 2019 / 8MB</small>'+
                                        //     '</div>'+
                                        // '</div>'+
                                        // '<div class="file-box">'+
                                        //     '<a href="#" class="download-icon-link">'+
                                        //         '<i class="dripicons-download file-download-icon"></i>'+
                                        //     '</a>'+
                                        //     '<div class="text-center">'+
                                        //         '<i class="lar la-file-archive text-warning"></i>'+
                                        //         '<h6 class="text-truncate">Payment_app.zip</h6>'+
                                        //         '<small class="text-muted">11 April 2019 / 10MB</small>'+
                                        //     '</div>'+
                                        // '</div>'+
                                        // '<div class="file-box">'+
                                        //     '<a href="#" class="download-icon-link">'+
                                        //         '<i class="dripicons-download file-download-icon"></i>'+
                                        //     '</a>'+
                                        //     '<div class="text-center">'+
                                        //         '<i class="lar la-file text-secondary"></i>'+
                                        //         '<h6 class="text-truncate">App_landing_001</h6>'+
                                        //         '<small class="text-muted">06 March 2019 / 5MB</small>'+
                                        //     '</div>'+
                                        // '</div>'+
                                    '</div>'+
    
                                    // '<div class="row">'+
                                    //     '<div class="col-12">'+
                                    //         '<h4 class="card-title my-3">Freelancing Projects</h4>'+
                                    //     '</div>'+
                                    // '</div>'+
                                    // '<div class="file-box-content">'+
                                    //     '<div class="file-box">'+
                                    //         '<a href="#" class="download-icon-link">'+
                                    //             '<i class="dripicons-download file-download-icon"></i>'+
                                    //         '</a>'+
                                    //         '<div class="text-center">'+
                                    //             '<i class="lar la-file-alt text-primary"></i>'+
                                    //             '<h6 class="text-truncate">Admin_Panel</h6>'+
                                    //             '<small class="text-muted">06 March 2019 / 5MB</small>'+
                                    //         '</div>'+
                                    //     '</div>'+
                                    //     '<div class="file-box">'+
                                    //         '<a href="#" class="download-icon-link">'+
                                    //             '<i class="dripicons-download file-download-icon"></i>'+
                                    //         '</a>'+
                                    //         '<div class="text-center">'+
                                    //             '<i class="lar la-file-code text-info"></i>'+
                                    //             '<h6 class="text-truncate">Ecommerce.pdf</h6>'+
                                    //             '<small class="text-muted">15 March 2019 / 8MB</small>'+
                                    //         '</div>'+
                                    //     '</div>'+
                                    // '</div>'+
                                '</div>';
                    }
                }
                document.getElementById('subBerkas').innerHTML =txt;

            },
            error: function (request, status, error) {
                // iziToast.error({
                //     title: 'Error',
                //     message: error,
                // });
            }
        });
    }

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
                    this.reset();
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
                    this.reset();
                    subBerkas(result.message_id);
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

    kategori();
</script>
@endsection