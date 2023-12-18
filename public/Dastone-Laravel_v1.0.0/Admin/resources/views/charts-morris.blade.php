@extends('layouts.master')
@section('title') Dashboard @endsection

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/morris/morris.css') }}">
@endsection

    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') Charts @endslot
            @slot('li_3') Morris @endslot
            @slot('title') Morris Charts @endslot
        @endcomponent

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Bar Chart</h4>
                            <p class="text-muted mb-0">Create bar charts using
                                Morris.Bar(options), where options is an object containing the
                                configuration options.
                            </p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div id="morris-bar-example" class="drop-shadow" style="height: 300px"></div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Donut Chart</h4>
                            <p class="text-muted mb-0">This really couldn't be easier. Create
                                a Donut chart using Morris.Donut(options).
                            </p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div id="morris-donut-example" class="drop-shadow" style="height: 300px"></div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Area Chart</h4>
                            <p class="text-muted mb-0">Create an area chart using
                                Morris.Area(options). Area charts take all the same options as line
                                charts.
                            </p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div id="morris-area-example" class="drop-shadow" style="height: 300px"></div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Line Chart</h4>
                            <p class="text-muted mb-0">The public API is terribly simple. It's
                                just one function: Morris.Line (options), where options is an object
                                containing some of the configuration options.
                            </p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div id="morris-line-example" class="drop-shadow" style="height: 300px"></div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->
            </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/jquery.morris.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
