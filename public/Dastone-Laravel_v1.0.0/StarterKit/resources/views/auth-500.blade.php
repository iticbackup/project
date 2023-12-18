@extends('layouts.master-without_nav')

{{--  @section('title') Login @endsection  --}}

@section('content')

    <body class="account-body accountbg">

        <!-- Eror-500 page -->
        <div class="container">
            <div class="row vh-100 d-flex justify-content-center">
                <div class="col-12 align-self-center">
                    <div class="row">
                        <div class="col-lg-5 mx-auto">
                            <div class="card">
                                <div class="card-body p-0 auth-header-box">
                                    <div class="text-center p-3">
                                        <a href="index" class="logo logo-admin">
                                            <img src="{{ URL::asset('assets/images/logo-sm-dark.png') }}" height="50" alt="logo" class="auth-logo">
                                        </a>
                                        <h4 class="mt-3 mb-1 fw-semibold text-white font-18">Oops! Sorry page does not found</h4>
                                        <p class="text-muted  mb-0">Back to dashboard of Dastone.</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="ex-page-content text-center">
                                        <img src="{{ URL::asset('assets/images/error.svg') }}" alt="0" class="" height="170">
                                        <h1 class="mt-5 mb-4">500!</h1>
                                        <h5 class="font-16 text-muted mb-5">Somthing went wrong</h5>
                                    </div>
                                    <a class="btn btn-primary w-100 waves-effect waves-light" href="index">Back to Dashboard <i class="fas fa-redo ms-1"></i></a>
                                </div>
                                <div class="card-body bg-light-alt text-center">
                                    <span class="text-muted d-none d-sm-inline-block">Mannatthemes © <script>
                                        document.write(new Date().getFullYear())
                                    </script></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
