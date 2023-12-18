@extends('layouts.master')
@section('title') Dashboard @endsection

@section('css')
    <link href="{{ URL::asset('assets/plugins/ion-rangeslider/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css"/>
@endsection
    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') Advanced UI @endslot
            @slot('li_3') Rangeslider @endslot
            @slot('title') Rangeslider @endslot
        @endcomponent

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">ION Range slider</h4>
                        <p class="text-muted mb-0">Cool, comfortable, responsive and easily customizable range slider</p>
                    </div><!--end card-header-->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="p-3">
                                    <h6 class="mb-3 mt-0">Default With Mark</h6>
                                    <input type="text" id="range_01">
                                </div>
                            </div><!--end col-->

                            <div class="col-lg-6">
                                <div class="p-3">
                                    <h6 class="mb-3 mt-0">Min-Max</h6>
                                    <input type="text" id="range_02">
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="p-3">
                                    <h6 class="mb-3 mt-0">Prefix</h6>
                                    <input type="text" id="range_03">
                                </div>
                            </div><!--end col-->

                            <div class="col-lg-6">
                                <div class="p-3">
                                    <h6 class="mb-3 mt-0">Range</h6>
                                    <input type="text" id="range_04">
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="p-3">
                                    <h6 class="mb-3 mt-0">Step</h6>
                                    <input type="text" id="range_05">
                                </div>
                            </div><!--end col-->

                            <div class="col-lg-6">
                                <div class="p-3">
                                    <h6 class="mb-3 mt-0">Custom Values</h6>
                                    <input type="text" id="range_06">
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="p-3">
                                    <h6 class="mb-3 mt-0">Prettify Numbers</h6>
                                    <input type="text" id="range_07">
                                </div>
                            </div><!--end col-->

                            <div class="col-lg-6">
                                <div class="p-3">
                                    <h6 class="mb-3 mt-0">Disabled</h6>
                                    <input type="text" id="range_08">
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="p-3">
                                    <h6 class="mb-3 mt-0">Extra Example</h6>
                                    <input type="text" id="range_09">
                                </div>
                            </div><!--end col-->

                            <div class="col-lg-6">
                                <div class="p-3">
                                    <h6 class="mb-3 mt-0">Use decorate_both option</h6>
                                    <input type="text" id="range_10">
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="p-3">
                                    <h6 class="mb-3 mt-0">Postfixes</h6>
                                    <input type="text" id="range_11">
                                </div>
                            </div><!--end col-->

                            <div class="col-lg-6">
                                <div class="p-3">
                                    <h6 class="mb-3 mt-0">Hide</h6>
                                    <input type="text" id="range_12">
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!-- end col -->
        </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/plugins/ion-rangeslider/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/jquery.rangeslider.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
