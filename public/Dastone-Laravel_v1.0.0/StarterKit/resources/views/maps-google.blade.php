@extends('layouts.master')
@section('title') Dashboard @endsection

    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') Maps @endslot
            @slot('li_3') Google Maps @endslot
            @slot('title') Google Maps @endslot
        @endcomponent

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Markers</h4>
                            <p class="text-muted mb-0">Example of google maps.</p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div id="gmaps-markers" class="gmaps"></div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Overlays</h4>
                            <p class="text-muted mb-0">Example of google maps.</p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div id="gmaps-overlay" class="gmaps"></div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Street View Panoramas</h4>
                            <p class="text-muted mb-0">Example of google maps.</p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div id="panorama" class="gmaps-panaroma"></div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Map Types</h4>
                            <p class="text-muted mb-0">Example of google maps.</p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div id="gmaps-types" class="gmaps"></div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->
            </div>

@endsection
@section('script')
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCtSAR45TFgZjOs4nBFFZnII-6mMHLfSYI"></script>
    <script src="{{ URL::asset('assets/plugins/gmaps/gmaps.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/jquery.gmaps.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
