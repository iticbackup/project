@extends('layouts.backend.app')
@section('title') File Manager @endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">File Managers</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Apps</a></li>
                            <li class="breadcrumb-item active">Files</li>
                        </ol>
                    </div>
                    <div class="col-auto align-self-center">
                        <button class="btn btn-outline-primary btn-sm add-file"><i class="fas fa-plus me-2 "></i>Create Folder</button>
                        <div class="add-file btn btn-outline-primary btn-sm position-relative overflow-hidden">
                            <i class="las la-cloud-upload-alt me-2 font-15"></i>Upload File
                            <input type="file" name="file" class="add-file-input"/>
                        </div>   
                        <input id="Add_File" type="file" name="files[]" multiple style='display: none;'>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Kategori</h4>
                        </div>
                        <div class="col-auto">
                            <div class="dropdown">
                                <a href="#" class="btn btn-sm btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal text-muted"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Create Folder</a>
                                    <a class="dropdown-item" onclick="kategori()">Refresh</a>
                                    {{-- <a class="dropdown-item" href="#">Delete</a>
                                    <a class="dropdown-item" href="#">Settings</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="files-nav">
                        <div class="nav flex-column nav-pills" id="files-tab" aria-orientation="vertical">
                            @forelse ($file_managers as $file_manager)
                            <a class="nav-link" id="files-projects-tab" data-bs-toggle="pill" href="#files-{{ $file_manager->slug }}" aria-selected="true">

                                <i data-feather="folder" class="align-self-center icon-dual-file icon-sm me-3"></i>
                                <div class="d-inline-block align-self-center">
                                    <h5 class="m-0">Projects</h5>
                                    <small>80GB/200GB Used</small>
                                </div>
                            </a>
                            @empty
                            Data Kosong  
                            @endforelse
                            {{-- <a class="nav-link active" id="files-projects-tab" data-bs-toggle="pill" href="#files-projects" aria-selected="true">

                                <i data-feather="folder" class="align-self-center icon-dual-file icon-sm me-3"></i>
                                <div class="d-inline-block align-self-center">
                                    <h5 class="m-0">Projects</h5>
                                    <small>80GB/200GB Used</small>
                                </div>
                            </a>
                            <a class="nav-link" id="files-pdf-tab" data-bs-toggle="pill" href="#files-pdf" aria-selected="false">
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
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <small class="float-end">62%</small>
                    <h6 class="mt-0">620GB / 1TB Used</h6>
                    <div class="progress" style="height: 5px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 62%;" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="">
                <div class="tab-content" id="files-tabContent">
                    @foreach ($file_managers_details as $fmd)
                        <div class="tab-pane fade show active" id="files-{{ $file_manager->slug }}">
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
                    @endforeach
                    {{-- <div class="tab-pane fade show active" id="files-projects">
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

    <script>
        // function kategori() {
        //     $.ajax({
        //         type:'GET',
        //         url: "{{ route('filemanagers.berkas') }}",
        //         contentType: "application/json;  charset=utf-8",
        //         cache: false,
        //         success: (result) => {
        //             // console.table(result.data);
        //             var dataKategori = result.data;
        //             var txt = "";
        //             dataKategori.forEach(data);
        //             function data(value, index) {
        //                 // txt = txt+'<tr>'+
        //                 //             '<td>'+value.departemen_id+'</td>'+
        //                 //             '<td>'+value.user_id+'</td>'+
        //                 //           '</tr>';
        //                 txt = txt+'<a class="nav-link" id="files-projects-tab" data-bs-toggle="pill" href="#files-projects" aria-selected="true">'+
        //                              '<i data-feather="folder" class="align-self-center icon-dual-file icon-sm me-3">'+'</i>'+
        //                                 '<div class="d-inline-block align-self-center">'+
        //                                     '<h5 class="m-0">'+value.nama_berkas+'</h5>'+
        //                                 '</div>'+
        //                             '</a>';
        //             }
        //             document.getElementById('files-tab').innerHTML = txt;

        //         },
        //         error: function (request, status, error) {
        //             // iziToast.error({
        //             //     title: 'Error',
        //             //     message: error,
        //             // });
        //         }
        //     });
        // }
        // kategori();
    </script>
@endsection