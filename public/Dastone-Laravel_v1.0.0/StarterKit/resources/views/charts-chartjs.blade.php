@extends('layouts.master')
@section('title') Dashboard @endsection

    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') Charts @endslot
            @slot('li_3') Chartjs @endslot
            @slot('title') Chartjs Charts @endslot
        @endcomponent

            <div class="row">
                <div class="col-lg-12 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Line Chart</h4>
                            <p class="text-muted mb-0">A line chart is a way of plotting data
                                points on a line. Often, it is used to show trend data, and the
                                comparison of two data sets.
                            </p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <canvas id="lineChart" class="drop-shadow" height="300"></canvas>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->

                <div class="col-lg-12 col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Donut Chart</h4>
                            <p class="text-muted mb-0">Pie and doughnut charts are probably
                                the most commonly used chart there are. They are divided into segments,
                                the arc of each segment shows the proportional value of each piece of
                                data.
                            </p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <canvas id="doughnut" class="drop-shadow" height="300"></canvas>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->

                <div class="col-lg-12 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Bar Chart</h4>
                            <p class="text-muted mb-0">A bar chart is a way of showing data as
                                bars. It is sometimes used to show trend data, and the comparison of
                                multiple data sets side by side.
                            </p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <canvas id="bar" class="drop-shadow" height="300"></canvas>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->

                <div class="col-lg-12 col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Polar Chart</h4>
                            <p class="text-muted mb-0">Polar area charts are similar to pie
                                charts, but each segment has the same angle - the radius of the segment
                                differs depending on the value.
                            </p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <canvas id="polarArea" class="drop-shadow" height="300"> </canvas>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->
            </div>

            <div class="row">
                <div class="col-lg-12 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Pie Chart</h4>
                            <p class="text-muted mb-0">Pie and doughnut charts are probably
                                the most commonly used chart there are. They are divided into segments,
                                the arc of each segment shows the proportional value of each piece of
                                data.
                            </p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <canvas id="pie" class="drop-shadow" height="300"></canvas>
                        </div><!--end card-body-->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-lg-12 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Radar Chart</h4>
                            <p class="text-muted mb-0">A radar chart is a way of showing
                                multiple data points and the variation between them. They are often
                                useful for comparing the points of two or more different data sets.
                            </p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <canvas id="radar" class="drop-shadow" height="300"></canvas>
                        </div><!--end card-body-->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/plugins/chartjs/chart.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/jquery.chartjs.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
