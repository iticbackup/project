@extends('layouts.master')
@section('title') Dashboard @endsection

    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') UI Kit @endslot
            @slot('li_3') Avatar @endslot
            @slot('title') Avatar @endslot
        @endcomponent

            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Avatar</h4>
                                    <p class="text-muted mb-0">Single user example</p>
                                </div><!--end col-->
                            </div>  <!--end row-->
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col">
                                    <div class="media">
                                        <a class="" href="#">
                                            <img src="{{ URL::asset('assets/images/users/user-8.jpg') }}" alt="user" class="rounded-circle thumb-lg">
                                        </a>
                                        <div class="media-body align-self-center ms-2">
                                            <p class="font-14 font-weight-semibold mb-0">Charles Smith</p>
                                            <p class="mb-0 font-12 text-muted">Charles@example.com</p>
                                        </div>
                                    </div><!--end media-->
                                </div><!--end col-->
                                <div class="col-auto align-self-center">
                                    <div class="button-items">
                                        <button type="button" class="btn btn-outline-primary btn-icon-circle btn-icon-circle-sm"><i class="fab fa-facebook-f"></i></button>
                                        <button type="button" class="btn btn-outline-info btn-icon-circle btn-icon-circle-sm"><i class="fab fa-twitter"></i></button>
                                        <button type="button" class="btn btn-outline-pink btn-icon-circle btn-icon-circle-sm"><i class="fab fa-dribbble"></i></button>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Group Avatar</h4>
                                    <p class="text-muted mb-0">Group user example</p>
                                </div><!--end col-->
                            </div>  <!--end row-->
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col">
                                    <div class="img-group">
                                        <a class="user-avatar user-avatar-group" href="#">
                                            <img src="{{ URL::asset('assets/images/users/user-8.jpg') }}" alt="user" class="thumb-lg rounded-circle">
                                        </a>
                                        <a class="user-avatar user-avatar-group" href="#">
                                            <img src="{{ URL::asset('assets/images/users/user-5.jpg') }}" alt="user" class="thumb-lg rounded-circle">
                                        </a>
                                        <a class="user-avatar user-avatar-group" href="#">
                                            <img src="{{ URL::asset('assets/images/users/user-4.jpg') }}" alt="user" class="thumb-lg rounded-circle">
                                        </a>
                                        <a class="user-avatar user-avatar-group" href="#">
                                            <img src="{{ URL::asset('assets/images/users/user-6.jpg') }}" alt="user" class="thumb-lg rounded-circle">
                                        </a>
                                        <a href="" class="avatar-box thumb-md align-self-center">
                                            <span class="avatar-title bg-soft-info rounded-circle font-weight-normal"><i class="las la-plus"></i></span>
                                        </a>
                                    </div><!--end img-group-->
                                </div><!--end col-->
                                <div class="col-auto align-self-center">
                                    <button type="button" class="btn btn-outline-light btn-sm">Message</button>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Avatar With Badge</h4>
                                    <p class="text-muted mb-0">Single user with badge example</p>
                                </div><!--end col-->
                            </div>  <!--end row-->
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col">
                                    <div class="img-group">
                                        <a class="user-avatar me-1" href="#">
                                            <img src="{{ URL::asset('assets/images/users/user-10.jpg') }}" alt="user" class="rounded-circle thumb-lg">
                                            <span class="avatar-badge online"></span>
                                        </a>
                                        <a class="user-avatar me-1" href="#">
                                            <img src="{{ URL::asset('assets/images/users/user-4.jpg') }}" alt="user" class="rounded-circle thumb-lg">
                                            <span class="avatar-badge offline"></span>
                                        </a>
                                        <a class="user-avatar me-1" href="#">
                                            <img src="{{ URL::asset('assets/images/users/user-1.jpg') }}" alt="user" class="rounded-circle thumb-lg">
                                            <span class="avatar-badge online"></span>
                                        </a>
                                    </div><!--end img-group-->
                                </div><!--end col-->
                                <div class="col-auto align-self-center">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-sm btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i data-feather="more-horizontal" class="align-self-center text-muted icon-xs"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">New Group</a>
                                            <a class="dropdown-item" href="#">Settings</a>
                                        </div>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Avatar Size</h4>
                                    <p class="text-muted mb-0">Avatar size rounded-circle example</p>
                                </div><!--end col-->
                            </div>  <!--end row-->
                        </div><!--end card-header-->
                        <div class="card-body">
                            <a class="user-avatar me-2" href="#">
                                <img src="{{ URL::asset('assets/images/users/user-10.jpg') }}" alt="user" class="thumb-xxl rounded-circle">
                            </a>
                            <a class="user-avatar me-2" href="#">
                                <img src="{{ URL::asset('assets/images/users/user-10.jpg') }}" alt="user" class="thumb-xl rounded-circle">
                            </a>
                            <a class="user-avatar me-2" href="#">
                                <img src="{{ URL::asset('assets/images/users/user-10.jpg') }}" alt="user" class="thumb-lg rounded-circle">
                            </a>
                            <a class="user-avatar me-2" href="#">
                                <img src="{{ URL::asset('assets/images/users/user-10.jpg') }}" alt="user" class="thumb-md rounded-circle">
                            </a>
                            <a class="user-avatar me-2" href="#">
                                <img src="{{ URL::asset('assets/images/users/user-10.jpg') }}" alt="user" class="thumb-sm rounded-circle">
                            </a>
                            <a class="user-avatar me-2" href="#">
                                <img src="{{ URL::asset('assets/images/users/user-10.jpg') }}" alt="user" class="thumb-xs rounded-circle">
                            </a>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Avatar Size</h4>
                                    <p class="text-muted mb-0">Avatar size square example</p>
                                </div><!--end col-->
                            </div>  <!--end row-->
                        </div><!--end card-header-->
                        <div class="card-body">
                            <a class="user-avatar me-2" href="#">
                                <img src="{{ URL::asset('assets/images/users/user-5.jpg') }}" alt="user" class="thumb-xxl rounded">
                            </a>
                            <a class="user-avatar me-2" href="#">
                                <img src="{{ URL::asset('assets/images/users/user-5.jpg') }}" alt="user" class="thumb-xl rounded">
                            </a>
                            <a class="user-avatar me-2" href="#">
                                <img src="assets/images/users/user-5.jpg" alt="user" class="thumb-lg rounded">
                            </a>
                            <a class="user-avatar me-2" href="#">
                                <img src="{{ URL::asset('assets/images/users/user-5.jpg') }}" alt="user" class="thumb-md rounded">
                            </a>
                            <a class="user-avatar me-2" href="#">
                                <img src="{{ URL::asset('assets/images/users/user-5.jpg') }}" alt="user" class="thumb-sm rounded">
                            </a>
                            <a class="user-avatar me-2" href="#">
                                <img src="{{ URL::asset('assets/images/users/user-5.jpg') }}" alt="user" class="thumb-xs rounded">
                            </a>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Text Avatar</h4>
                                    <p class="text-muted mb-0">Round Shape avatar text in soft color example</p>
                                </div><!--end col-->
                            </div>  <!--end row-->
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div class="media">
                                <div class="avatar-box thumb-xxl align-self-center me-2">
                                    <span class="avatar-title bg-soft-primary rounded-circle">MT</span>
                                </div>
                                <div class="avatar-box thumb-xl align-self-center me-2">
                                    <span class="avatar-title bg-soft-success rounded-circle">MT</span>
                                </div>
                                <div class="avatar-box thumb-lg align-self-center me-2">
                                    <span class="avatar-title bg-soft-pink rounded-circle">MT</span>
                                </div>
                                <div class="avatar-box thumb-md align-self-center me-2">
                                    <span class="avatar-title bg-soft-purple rounded-circle">MT</span>
                                </div>
                                <div class="avatar-box thumb-sm align-self-center me-2">
                                    <span class="avatar-title bg-soft-warning rounded-circle">MT</span>
                                </div>
                                <div class="avatar-box thumb-xs align-self-center">
                                    <span class="avatar-title bg-soft-info rounded-circle">MT</span>
                                </div>
                            </div><!--end media-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Text Avatar</h4>
                                    <p class="text-muted mb-0">Square Shape avatar text in soft color example</p>
                                </div><!--end col-->
                            </div>  <!--end row-->
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div class="media">
                                <div class="avatar-box thumb-xxl align-self-center me-2">
                                    <span class="avatar-title bg-soft-primary rounded">MT</span>
                                </div>
                                <div class="avatar-box thumb-xl align-self-center me-2">
                                    <span class="avatar-title bg-soft-success rounded">MT</span>
                                </div>
                                <div class="avatar-box thumb-lg align-self-center me-2">
                                    <span class="avatar-title bg-soft-pink rounded">MT</span>
                                </div>
                                <div class="avatar-box thumb-md align-self-center me-2">
                                    <span class="avatar-title bg-soft-purple rounded">MT</span>
                                </div>
                                <div class="avatar-box thumb-sm align-self-center me-2">
                                    <span class="avatar-title bg-soft-warning rounded">MT</span>
                                </div>
                                <div class="avatar-box thumb-xs align-self-center">
                                    <span class="avatar-title bg-soft-info rounded">MT</span>
                                </div>
                            </div><!--end media-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Icon Avatar</h4>
                                    <p class="text-muted mb-0">Round Shape avatar icon in theme color example</p>
                                </div><!--end col-->
                            </div>  <!--end row-->
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div class="media">
                                <div class="avatar-box thumb-xxl align-self-center me-2">
                                    <span class="avatar-title bg-primary rounded-circle"><i class="far fa-grin-alt"></i></span>
                                </div>
                                <div class="avatar-box thumb-xl align-self-center me-2">
                                    <span class="avatar-title bg-secondary rounded-circle"><i class="far fa-grin-alt"></i></span>
                                </div>
                                <div class="avatar-box thumb-lg align-self-center me-2">
                                    <span class="avatar-title bg-warning rounded-circle"><i class="far fa-user"></i></span>
                                </div>
                                <div class="avatar-box thumb-md align-self-center me-2">
                                    <span class="avatar-title bg-danger rounded-circle"><i class="fab fa-mailchimp"></i></span>
                                </div>
                                <div class="avatar-box thumb-sm align-self-center me-2">
                                    <span class="avatar-title bg-purple rounded-circle"><i class="fas fa-user"></i></span>
                                </div>
                                <div class="avatar-box thumb-xs align-self-center">
                                    <span class="avatar-title bg-dark rounded-circle"><i class="fas fa-smile"></i></span>
                                </div>
                            </div><!--end media-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Icon Avatar</h4>
                                    <p class="text-muted mb-0">Square Shape avatar icon in theme color example</p>
                                </div><!--end col-->
                            </div>  <!--end row-->
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div class="media">
                                <div class="avatar-box thumb-xxl align-self-center me-2">
                                    <span class="avatar-title bg-primary rounded"><i class="far fa-grin-alt"></i></span>
                                </div>
                                <div class="avatar-box thumb-xl align-self-center me-2">
                                    <span class="avatar-title bg-secondary rounded"><i class="far fa-grin-alt"></i></span>
                                </div>
                                <div class="avatar-box thumb-lg align-self-center me-2">
                                    <span class="avatar-title bg-warning rounded"><i class="far fa-user"></i></span>
                                </div>
                                <div class="avatar-box thumb-md align-self-center me-2">
                                    <span class="avatar-title bg-danger rounded"><i class="fab fa-mailchimp"></i></span>
                                </div>
                                <div class="avatar-box thumb-sm align-self-center me-2">
                                    <span class="avatar-title bg-purple rounded"><i class="fas fa-user"></i></span>
                                </div>
                                <div class="avatar-box thumb-xs align-self-center">
                                    <span class="avatar-title bg-dark rounded"><i class="fas fa-smile"></i></span>
                                </div>
                            </div><!--end media-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
            </div>

@endsection
@section('script')
        <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
