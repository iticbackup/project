@extends('layouts.master')
@section('title') Dashboard @endsection

    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') UI Kit @endslot
            @slot('li_3') Images @endslot
            @slot('title') Images @endslot
        @endcomponent

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Responsive images</h4>
                                <p class="text-muted mb-0">Images in Bootstrap are made responsive with
                                    <code class="highlighter-rouge">.img-fluid</code>. <code class="highlighter-rouge">max-width: 100%;</code> and
                                    <code class="highlighter-rouge">height: auto;</code>
                                    are applied to the image so that it scales with the parent element.
                                </p>
                            </div><!--end card-header-->
                            <div class="card-body">
                                <img src="{{ URL::asset('assets/images/widgets/1.jpg') }}" alt="" class="img-fluid">
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!-- end col -->
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Image thumbnails</h4>
                                <p class="text-muted mb-0">You can use <code class="highlighter-rouge">.img-thumbnail</code>
                                    to give an image a rounded.
                                </p>
                            </div><!--end card-header-->
                            <div class="card-body">
                                <div class="media">
                                    <img src="{{ URL::asset('assets/images/users/user-4.jpg') }}" alt="" class="img-thumbnail">
                                    <div class="media-body align-self-center ms-3 text-truncate">
                                        <h3 class="my-0 fw-bold">Kathryn Money</h3>
                                        <p class="text-muted mb-2 font-13">UI & UX Designer, Japan</p>
                                        <button type="button" class="btn btn-sm btn-soft-primary">Massage</button>
                                    </div><!--end media-body-->
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!-- end col -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Image rounded</h4>
                                <p class="text-muted mb-0">You can use <code class="highlighter-rouge">.rounded</code>
                                    to give an image a rounded.
                                </p>
                            </div><!--end card-header-->
                            <div class="card-body">
                                <div class="media">
                                    <img src="{{ URL::asset('assets/images/users/user-5.jpg') }}" alt="" class="rounded">
                                    <div class="media-body align-self-center ms-3 text-truncate">
                                        <h3 class="my-0 fw-bold">Anthony Stover</h3>
                                        <p class="text-muted mb-2 font-13">UI & UX Designer, USA</p>
                                        <button type="button" class="btn btn-sm btn-soft-primary">Massage</button>
                                    </div><!--end media-body-->
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!-- end col -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Image circle</h4>
                                <p class="text-muted mb-0">You can use <code class="highlighter-rouge">.rounded-circle</code>
                                    to give an image a circle.
                                </p>
                            </div><!--end card-header-->
                            <div class="card-body">
                                <div class="media">
                                    <img src="{{ URL::asset('assets/images/users/user-6.jpg') }}" alt="" class="rounded-circle">
                                    <div class="media-body align-self-center ms-3 text-truncate">
                                        <h3 class="my-0 fw-bold">Catherine Orman</h3>
                                        <p class="text-muted mb-2 font-13">UI & UX Designer, India</p>
                                        <button type="button" class="btn btn-sm btn-soft-primary">Massage</button>
                                    </div><!--end media-body-->
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!-- end col -->
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Aligning images</h4>
                                <p class="text-muted mb-0">You can use <code class="highlighter-rouge">.float-end</code> and <code class="highlighter-rouge">.float-start</code>
                                    to give an image position.
                                </p>
                            </div><!--end card-header-->
                            <div class="card-body">
                                <img src="{{ URL::asset('assets/images/users/user-4.jpg') }}" alt="" class="rounded float-start">
                                <img src="{{ URL::asset('assets/images/users/user-10.jpg') }}" alt="" class="rounded float-end">
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!-- end col -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Aligning images</h4>
                                <p class="text-muted mb-0">You can use <code class="highlighter-rouge">.d-block .mx-auto</code>
                                    image center.
                                </p>
                            </div><!--end card-header-->
                            <div class="card-body">
                                <img src="{{ URL::asset('assets/images/users/user-7.jpg') }}" alt="" class="rounded d-block mx-auto">
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!-- end col -->
                </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
