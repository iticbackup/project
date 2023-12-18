@extends('layouts.master')
@section('title') Dashboard @endsection

    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') Advanced UI @endslot
            @slot('li_3') Timeout @endslot
            @slot('title') Timeout @endslot
        @endcomponent

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">Bootstrap-session-timeout</h4>
                        <p class="text-muted mb-4">Session timeout and keep-alive control
                            with a nice Bootstrap warning dialog.</p>

                        <div class="text-muted">
                            <p>After a set amount of idle time, a Bootstrap warning dialog is shown
                                to the user with the option to either log out, or stay connected. If
                                "Logout" button is selected, the page is redirected to a logout URL.
                                If "Stay Connected" is selected the dialog closes and the session is
                                kept alive. If no option is selected after another set amount of
                                idle time, the page is automatically redirected to a set timeout
                                URL.</p>

                            <p>
                                Idle time is defined as no mouse, keyboard or touch event activity registered by the browser.
                            </p>

                            <p>
                                As long as the user is active, the (optional) keep-alive URL keeps
                                getting pinged and the session stays alive. If you have no need to
                                keep the server-side session alive via the keep-alive URL, you can
                                also use this plugin as a simple lock mechanism that redirects to
                                your lock-session or log-out URL after a set amount of idle time.
                            </p>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!-- end col -->
        </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/plugins/bootstrap-session-timeout/bootstrap-session-timeout.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/jquery.timeout.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
