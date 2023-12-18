@extends('layouts.master')
@section('title') Dashboard @endsection

@section('css')
    <link href="{{ URL::asset('assets/plugins/lightbox/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
@endsection
    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') Advanced UI @endslot
            @slot('li_3') Lightbox @endslot
            @slot('title') Lightbox @endslot
        @endcomponent

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Single Image Lightbox</h4>
                            <p class="text-muted mb-0">Simple popups lightbox</p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <a href="{{ URL::asset('assets/images/small/img-1.jpg') }}" class="image-popup-vertical-fit">
                                <img src="{{ URL::asset('assets/images/small/img-1.jpg') }}" alt="" class="img-fluid">
                            </a>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Lightbox Gallery</h4>
                            <p class="text-muted mb-0">You may put any HTML content in each gallery item.</p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div class="popup-gallery d-flex">
                                <a href="{{ URL::asset('assets/images/small/img-2.jpg') }}" title="The Cleaner">
                                    <img src="{{ URL::asset('assets/images/small/img-2.jpg') }}" alt="" class="img-fluid">
                                </a>
                                <a href="{{ URL::asset('assets/images/small/img-3.jpg') }}" title="The Cleaner">
                                    <img src="{{ URL::asset('assets/images/small/img-3.jpg') }}" alt="" class="img-fluid">
                                </a>
                                <a href="{{ URL::asset('assets/images/small/img-4.jpg') }}" title="The Cleaner">
                                    <img src="{{ URL::asset('assets/images/small/img-4.jpg') }}" alt="" class="img-fluid">
                                </a>
                                </div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Popup With Video And Map</h4>
                            <p class="text-muted mb-0">In this example lightboxes are automatically disabled on small screen size and default behavior of link is triggered.</p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div class="button-items">
                                <a class="btn btn-outline-primary popup-youtube" href="http://www.youtube.com/watch?v=0O2aH4XLbto">Open YouTube video</a>
                                <a class="btn btn-outline-primary popup-vimeo" href="https://vimeo.com/45830194" >Open Vimeo video</a>
                                <a class="btn btn-outline-primary popup-gmaps" href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&hl=en&t=v&hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom">Open Google Map</a>
                            </div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
            </div>

@endsection
@section('script')
        <script src="{{ URL::asset('assets/plugins/lightbox/jquery.magnific-popup.js') }}"></script>
        <script src="{{ URL::asset('assets/js/pages/jquery.lightbox.init.js') }}"></script>
        <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
