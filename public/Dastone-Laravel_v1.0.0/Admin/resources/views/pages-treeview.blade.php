@extends('layouts.master')
@section('title') Dashboard @endsection

@section('css')
    <link href="{{ URL::asset('assets/plugins/treeview/themes/default/style.css') }}" rel="stylesheet">
@endsection

    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') Pages @endslot
            @slot('li_3') Treeview @endslot
            @slot('title') Treeview @endslot
        @endcomponent

            <div class="row">
                <div class=" col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Default Tree</h4>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div id="jstree">
                                <!-- in this example the tree is populated from inline HTML -->
                                <ul>
                                    <li class="jstree-open"  data-jstree='{"icon":"fa fa-folder text-warning font-18"}'>Root node 1
                                        <ul>
                                            <li data-jstree='{"icon":"fa fa-folder text-primary font-18"}'>Child node 1</li>
                                            <li data-jstree='{"icon":"fa fa-folder text-warning font-18"}'>Child node 2</li>
                                            <li data-jstree='{"icon":"fa fa-folder text-warning font-18"}'>Child node 3</li>
                                            <li  data-jstree='{"icon":"fa fa-folder text-warning font-18"}' class="jstree-open">Child node 3
                                                <ul>
                                                    <li data-jstree='{"icon":"fa fa-folder text-warning font-18"}'>Child node 1</li>
                                                    <li data-jstree='{"icon":"fa fa-folder text-warning font-18"}'>Child node 2
                                                        <ul>
                                                            <li data-jstree='{"icon":"fa fa-folder text-warning font-18"}'>Child node 1</li>
                                                            <li data-jstree='{"icon":"fa fa-folder text-warning font-18"}'>Child node 2</li>
                                                        </ul>
                                                    </li>
                                                    <li data-jstree='{"icon":"fa fa-folder text-warning font-18"}'>Child node 3</li>
                                                    <li data-jstree='{"icon":"fa fa-folder text-warning font-18"}'>Child node 4</li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li data-jstree='{"icon":"fa fa-folder text-warning font-18"}'>Root node 2
                                        <ul>
                                            <li data-jstree='{"icon":"fa fa-folder text-warning font-18"}'>Child</li>
                                            <li data-jstree='{"icon":"fa fa-folder text-warning font-18", "disabled":true}'>
                                                Child
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
                <div class=" col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Checkable Tree</h4>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div id="jstree-checkbox">
                                <!-- in this example the tree is populated from inline HTML -->
                                <ul>
                                    <li data-jstree='{"icon":"fa fa-folder text-warning font-18"}' class="jstree-open">Root node 1
                                        <ul>
                                            <li data-jstree='{"icon":"fa fa-folder text-warning font-18"}'>Child node 1</li>
                                            <li data-jstree='{"icon":"fa fa-folder text-warning font-18"}'>Child node 2</li>
                                            <li data-jstree='{"icon":"fa fa-folder text-warning font-18"}' class="jstree-open">Child node 3
                                                <ul>
                                                    <li data-jstree='{"icon":"fa fa-folder text-warning font-18"}'>Child node 1</li>
                                                    <li data-jstree='{"icon":"fa fa-folder text-warning font-18"}'>Child node 2</li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li data-jstree='{"icon":"fa fa-folder text-warning font-18"}'>Root node 2</li>
                                </ul>
                            </div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!-- end col -->
            </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/plugins/treeview/jstree.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/jquery.treeview.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection

