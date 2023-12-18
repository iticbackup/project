@extends('layouts.master')
@section('title') Dashboard @endsection

    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') Apps @endslot
            @slot('li_3') Cantacts @endslot
            @slot('title') Cantacts @endslot
        @endcomponent

            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="media">
                                        <img src="{{ URL::asset('assets/images/users/user-1.jpg') }}" alt="user" class="rounded-circle thumb-lg align-self-center">
                                        <div class="media-body ms-3 align-self-center">
                                            <h5 class="mt-0 mb-1">Wendy Keen</h5>
                                            <p class="mb-0 text-muted">Freelance Developer</p>
                                        </div>
                                    </div><!--end media-->
                                </div><!--end col-->
                                <div class="col-auto align-self-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="me-1 contact-icon"><i class="fas fa-phone"></i></a>
                                            <a href="#" class="contact-icon"><i class="far fa-envelope"></i></a>
                                        </li>
                                    </ul>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="media">
                                        <img src="{{ URL::asset('assets/images/users/user-2.jpg') }}" alt="user" class="rounded-circle thumb-lg align-self-center">
                                        <div class="media-body ms-3 align-self-center">
                                            <h5 class="mt-0 mb-1">Jeff Beck</h5>
                                            <p class="mb-0 text-muted">Freelance Developer</p>
                                        </div>
                                    </div><!--end media-->
                                </div><!--end col-->
                                <div class="col-auto align-self-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="me-1 contact-icon"><i class="fas fa-phone"></i></a>
                                            <a href="#" class="contact-icon"><i class="far fa-envelope"></i></a>
                                        </li>
                                    </ul>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="media">
                                        <img src="{{ URL::asset('assets/images/users/user-3.jpg') }}" alt="user" class="rounded-circle thumb-lg align-self-center">
                                        <div class="media-body ms-3 align-self-center">
                                            <h5 class="mt-0 mb-1">David Gilmour</h5>
                                            <p class="mb-0 text-muted">Freelance Developer</p>
                                        </div>
                                    </div><!--end media-->
                                </div><!--end col-->
                                <div class="col-auto align-self-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="me-1 contact-icon"><i class="fas fa-phone"></i></a>
                                            <a href="#" class="contact-icon"><i class="far fa-envelope"></i></a>
                                        </li>
                                    </ul>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="media">
                                        <img src="{{ URL::asset('assets/images/users/user-4.jpg') }}" alt="user" class="rounded-circle thumb-lg align-self-center">
                                        <div class="media-body ms-3 align-self-center">
                                            <h5 class="mt-0 mb-1">Sarah Woods</h5>
                                            <p class="mb-0 text-muted">Freelance Developer</p>
                                        </div>
                                    </div><!--end media-->
                                </div><!--end col-->
                                <div class="col-auto align-self-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="me-1 contact-icon"><i class="fas fa-phone"></i></a>
                                            <a href="#" class="contact-icon"><i class="far fa-envelope"></i></a>
                                        </li>
                                    </ul>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="media">
                                        <img src="{{ URL::asset('assets/images/users/user-5.jpg') }}" alt="user" class="rounded-circle thumb-lg align-self-center">
                                        <div class="media-body ms-3 align-self-center">
                                            <h5 class="mt-0 mb-1">Andy Timmons</h5>
                                            <p class="mb-0 text-muted">Freelance Developer</p>
                                        </div>
                                    </div><!--end media-->
                                </div><!--end col-->
                                <div class="col-auto align-self-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="me-1 contact-icon"><i class="fas fa-phone"></i></a>
                                            <a href="#" class="contact-icon"><i class="far fa-envelope"></i></a>
                                        </li>
                                    </ul>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="media">
                                        <img src="{{ URL::asset('assets/images/users/user-6.jpg') }}" alt="user" class="rounded-circle thumb-lg align-self-center">
                                        <div class="media-body ms-3 align-self-center">
                                            <h5 class="mt-0 mb-1">Vince Nelson</h5>
                                            <p class="mb-0 text-muted">Freelance Developer</p>
                                        </div>
                                    </div><!--end media-->
                                </div><!--end col-->
                                <div class="col-auto align-self-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="me-1 contact-icon"><i class="fas fa-phone"></i></a>
                                            <a href="#" class="contact-icon"><i class="far fa-envelope"></i></a>
                                        </li>
                                    </ul>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="media">
                                        <img src="{{ URL::asset('assets/images/users/user-7.jpg') }}" alt="user" class="rounded-circle thumb-lg align-self-center">
                                        <div class="media-body ms-3 align-self-center">
                                            <h5 class="mt-0 mb-1">Dianna Smiley</h5>
                                            <p class="mb-0 text-muted">Freelance Developer</p>
                                        </div>
                                    </div><!--end media-->
                                </div><!--end col-->
                                <div class="col-auto align-self-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="me-1 contact-icon"><i class="fas fa-phone"></i></a>
                                            <a href="#" class="contact-icon"><i class="far fa-envelope"></i></a>
                                        </li>
                                    </ul>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="media">
                                        <img src="{{ URL::asset('assets/images/users/user-8.jpg') }}" alt="user" class="rounded-circle thumb-lg align-self-center">
                                        <div class="media-body ms-3 align-self-center">
                                            <h5 class="mt-0 mb-1">Adolfo Hess</h5>
                                            <p class="mb-0 text-muted">Freelance Developer</p>
                                        </div>
                                    </div><!--end media-->
                                </div><!--end col-->
                                <div class="col-auto align-self-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="me-1 contact-icon"><i class="fas fa-phone"></i></a>
                                            <a href="#" class="contact-icon"><i class="far fa-envelope"></i></a>
                                        </li>
                                    </ul>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="media">
                                        <img src="{{ URL::asset('assets/images/users/user-2.jpg') }}" alt="user" class="rounded-circle thumb-lg align-self-center">
                                        <div class="media-body ms-3 align-self-center">
                                            <h5 class="mt-0 mb-1">Jeff Beck</h5>
                                            <p class="mb-0 text-muted">Freelance Developer</p>
                                        </div>
                                    </div><!--end media-->
                                </div><!--end col-->
                                <div class="col-auto align-self-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="me-1 contact-icon"><i class="fas fa-phone"></i></a>
                                            <a href="#" class="contact-icon"><i class="far fa-envelope"></i></a>
                                        </li>
                                    </ul>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="media">
                                        <img src="{{ URL::asset('assets/images/users/user-3.jpg') }}" alt="user" class="rounded-circle thumb-lg align-self-center">
                                        <div class="media-body ms-3 align-self-center">
                                            <h5 class="mt-0 mb-1">David Gilmour</h5>
                                            <p class="mb-0 text-muted">Freelance Developer</p>
                                        </div>
                                    </div><!--end media-->
                                </div><!--end col-->
                                <div class="col-auto align-self-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="me-1 contact-icon"><i class="fas fa-phone"></i></a>
                                            <a href="#" class="contact-icon"><i class="far fa-envelope"></i></a>
                                        </li>
                                    </ul>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="media">
                                        <img src="{{ URL::asset('assets/images/users/user-6.jpg') }}" alt="user" class="rounded-circle thumb-lg align-self-center">
                                        <div class="media-body ms-3 align-self-center">
                                            <h5 class="mt-0 mb-1">Vince Nelson</h5>
                                            <p class="mb-0 text-muted">Freelance Developer</p>
                                        </div>
                                    </div><!--end media-->
                                </div><!--end col-->
                                <div class="col-auto align-self-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="me-1 contact-icon"><i class="fas fa-phone"></i></a>
                                            <a href="#" class="contact-icon"><i class="far fa-envelope"></i></a>
                                        </li>
                                    </ul>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="media">
                                        <img src="{{ URL::asset('assets/images/users/user-7.jpg') }}" alt="user" class="rounded-circle thumb-lg align-self-center">
                                        <div class="media-body ms-3 align-self-center">
                                            <h5 class="mt-0 mb-1">Dianna Smiley</h5>
                                            <p class="mb-0 text-muted">Freelance Developer</p>
                                        </div>
                                    </div><!--end media-->
                                </div><!--end col-->
                                <div class="col-auto align-self-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="me-1 contact-icon"><i class="fas fa-phone"></i></a>
                                            <a href="#" class="contact-icon"><i class="far fa-envelope"></i></a>
                                        </li>
                                    </ul>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
            </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
