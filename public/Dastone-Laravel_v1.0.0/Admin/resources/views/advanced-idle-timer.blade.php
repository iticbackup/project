@extends('layouts.master')
@section('title') Dashboard @endsection

    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') Advanced UI @endslot
            @slot('li_3') Idle Timer @endslot
            @slot('title') Idle Timer @endslot
        @endcomponent

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Document <small><span id="docTimeout"></span> second timeout</small></h4>
                            <p class="text-muted mb-0">The idle timer is built on <a href="#">jQuery</a> and provides two events: <code>idle.idleTimer</code> and
                                <code>active.idleTimer</code>, which fire when the users idle state has changed.
                            </p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div class="btn-group mb-3">
                                <a href="#" id="btPause" class="btn btn-outline-primary btn-sm">Pause</a>
                                <a href="#" id="btResume" class="btn btn-outline-primary btn-sm">Resume</a>
                                <a href="#" id="btElapsed" class="btn btn-outline-primary btn-sm">Elapsed</a>
                                <a href="#" id="btInit" class="btn btn-outline-primary btn-sm">Init</a>
                                <a href="#" id="btDestroy" class="btn btn-outline-primary btn-sm">Destroy</a>
                            </div>
                            <textarea rows="10" cols="30" id="docStatus" class="form-control"></textarea>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Element  <small><span id="elTimeout"></span> second timeout</small></h4>
                            <p class="text-muted mb-0">The idle timer is built on <a href="#">jQuery</a> and provides two events: <code>idle.idleTimer</code>
                                and <code>active.idleTimer</code>, which fire when the user's idle state has changed.
                            </p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div class="btn-group mb-3">
                                <a href="#" id="btReset" class="btn btn-outline-primary btn-sm">Reset</a>
                                <a href="#" id="btLastActive" class="btn btn-outline-primary btn-sm">Last Active</a>
                                <a href="#" id="btRemaining" class="btn btn-outline-primary btn-sm">Remaining</a>
                                <a href="#" id="btState" class="btn btn-outline-primary btn-sm">State</a>
                            </div>
                            <textarea rows="10" cols="30" id="elStatus" class="form-control"></textarea>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
            </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/plugins/idle-timer/idle-timer.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/jquery.idle-timer.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
