@extends('layouts.master')
@section('title') Dashboard @endsection

@section('css')
    <link href="{{ URL::asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
@endsection

    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') Forms @endslot
            @slot('li_3') Uploads @endslot
            @slot('title') Uploads @endslot
        @endcomponent

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">File Upload 1</h4>
                                <p class="text-muted mb-0">Your so fresh input file — Default version</p>
                            </div><!--end card-header-->
                            <div class="card-body">
                                <input type="file" id="input-file-now" class="dropify" />
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">File Upload 2</h4>
                                <p class="text-muted mb-0">You can add a default value</p>
                            </div><!--end card-header-->
                            <div class="card-body">
                                <input type="file" id="input-file-now-custom-1" class="dropify" data-default-file="assets/plugins/dropify/images/1.jpg" />
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                </div>

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">File Upload 3</h4>
                                <p class="text-muted mb-0">You can set the height</p>
                            </div><!--end card-header-->
                            <div class="card-body">
                                <input type="file" id="input-file-now-custom-2" class="dropify" data-height="500" />
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">File Upload 4</h4>
                                <p class="text-muted mb-0">You can combine options</p>
                            </div><!--end card-header-->
                            <div class="card-body">
                                <input type="file" id="input-file-now-custom-3" class="dropify" data-height="500" data-default-file="assets/plugins/dropify/images/2.jpg" />
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/jquery.form-upload.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
