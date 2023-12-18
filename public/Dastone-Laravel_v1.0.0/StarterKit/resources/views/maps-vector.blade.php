@extends('layouts.master')
@section('title') Dashboard @endsection

@section('css')
    <link href="{{ URL::asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet">
@endsection

    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') Maps @endslot
            @slot('li_3') Vector Maps @endslot
            @slot('title') Vector Maps @endslot
        @endcomponent

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">World Map</h4>
                            <p class="text-muted mb-0">Example of vector map.</p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div id="world-map-markers" style="height: 400px"></div>
                        </div><!--end card-body-->
                    </div> <!--end card-->
                </div> <!-- end col -->
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">USA Map</h4>
                            <p class="text-muted mb-0">Example of vector map.</p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div id="usa" style="height: 400px"></div>
                        </div><!--end card-body-->
                    </div> <!--end card-->
                </div> <!-- end col -->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Canada Map</h4>
                            <p class="text-muted mb-0">Example of vector map.</p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div id="canada" style="height: 400px"></div>
                        </div><!--end card-body-->
                    </div> <!--end card-->
                </div> <!-- end col -->
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">UK Map</h4>
                            <p class="text-muted mb-0">Example of vector map.</p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div id="uk" style="height: 400px"></div>
                        </div><!--end card-body-->
                    </div> <!--end card-->
                </div> <!-- end col -->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Chicago Map</h4>
                            <p class="text-muted mb-0">Example of vector map.</p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div id="chicago" style="height: 400px"></div>
                        </div><!--end card-body-->
                    </div> <!--end card-->
                </div> <!-- end col -->
            </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jvectormap/gdp-data.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jvectormap/jquery-jvectormap-ca-lcc.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jvectormap/jquery-jvectormap-us-aea-en.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jvectormap/jquery-jvectormap-uk-mill-en.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jvectormap/jquery-jvectormap-us-il-chicago-mill-en.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/jquery.jvectormap.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
