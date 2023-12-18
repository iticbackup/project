@extends('layouts.master')
@section('title') Dashboard @endsection

@section('css')
    <link href="{{ URL::asset('assets/plugins/nestable/jquery.nestable.min.css') }}" rel="stylesheet" />
@endsection
    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') Advanced UI @endslot
            @slot('li_3') Nestable @endslot
            @slot('title') Nestable @endslot
        @endcomponent

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">List 1</h4>
                            <p class="text-muted mb-0">Drag & drop hierarchical list with
                                mouse and touch compatibility (jQuery plugin).
                            </p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div class="custom-dd dd" id="nestable_list_1">
                                <ol class="dd-list">
                                    <li class="dd-item" data-id="1">
                                        <div class="dd-handle">
                                            Item 1
                                        </div>
                                    </li>
                                    <li class="dd-item" data-id="2">
                                        <div class="dd-handle">
                                            Item 2
                                        </div>
                                        <ol class="dd-list">
                                            <li class="dd-item" data-id="3">
                                                <div class="dd-handle">
                                                    Item 3
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="4">
                                                <div class="dd-handle">
                                                    Item 4
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="5">
                                                <div class="dd-handle">
                                                    Item 5
                                                </div>
                                                <ol class="dd-list">
                                                    <li class="dd-item" data-id="6">
                                                        <div class="dd-handle">
                                                            Item 6
                                                        </div>
                                                    </li>
                                                    <li class="dd-item" data-id="7">
                                                        <div class="dd-handle">
                                                            Item 7
                                                        </div>
                                                    </li>
                                                    <li class="dd-item" data-id="8">
                                                        <div class="dd-handle">
                                                            Item 8
                                                        </div>
                                                    </li>
                                                </ol>
                                            </li>
                                            <li class="dd-item" data-id="9">
                                                <div class="dd-handle">
                                                    Item 9
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="10">
                                                <div class="dd-handle">
                                                    Item 10
                                                </div>
                                            </li>
                                        </ol>
                                    </li>
                                </ol>
                            </div><!--nastable-list-1-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">List 2</h4>
                            <p class="text-muted mb-4">Drag & drop hierarchical list with
                                mouse and touch compatibility (jQuery plugin).
                            </p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div class="custom-dd dd" id="nestable_list_2">
                                <ol class="dd-list">
                                    <li class="dd-item" data-id="11">
                                        <div class="dd-handle">
                                            Item 11
                                        </div>
                                    </li>
                                    <li class="dd-item" data-id="12">
                                        <div class="dd-handle">
                                            Item 12
                                        </div>
                                    </li>
                                    <li class="dd-item" data-id="13">
                                        <div class="dd-handle">
                                            Item 13
                                        </div>
                                    </li>
                                    <li class="dd-item" data-id="14">
                                        <div class="dd-handle">
                                            Item 14
                                        </div>
                                    </li>
                                    <li class="dd-item" data-id="15">
                                        <div class="dd-handle">
                                            Item 15
                                        </div>
                                        <ol class="dd-list">
                                            <li class="dd-item" data-id="16">
                                                <div class="dd-handle">
                                                    Item 16
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="17">
                                                <div class="dd-handle">
                                                    Item 17
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="18">
                                                <div class="dd-handle">
                                                    Item 18
                                                </div>
                                            </li>
                                        </ol>
                                    </li>
                                </ol>
                            </div><!--nastable-list-2-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">List 3</h4>
                            <p class="text-muted mb-0">Drag & drop hierarchical list with
                                handle and  mouse and touch compatibility (jQuery plugin).
                            </p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div class="custom-dd dd" id="nestable_list_3">
                                <ol class="dd-list">
                                    <li class="dd-item dd3-item" data-id="37">
                                        <div class="dd-handle dd3-handle"></div>
                                        <div class="dd3-content dd3-content-p">Item 1</div>
                                    </li>
                                    <li class="dd-item dd3-item" data-id="38">
                                        <div class="dd-handle dd3-handle"></div>
                                        <div class="dd3-content dd3-content-p">Item 2</div>
                                    </li>
                                    <li class="dd-item dd3-item" data-id="39">
                                        <div class="dd-handle dd3-handle"></div>
                                        <div class="dd3-content dd3-content-p">Item 3</div>
                                        <ol class="dd-list">
                                            <li class="dd-item dd3-item" data-id="40">
                                                <div class="dd-handle dd3-handle"></div>
                                                <div class="dd3-content dd3-content-p">Item 4</div>
                                            </li>
                                            <li class="dd-item dd3-item" data-id="41">
                                                <div class="dd-handle dd3-handle"></div>
                                                <div class="dd3-content dd3-content-p">Item 5</div>
                                            </li>
                                            <li class="dd-item dd3-item" data-id="42">
                                                <div class="dd-handle dd3-handle"></div>
                                                <div class="dd3-content dd3-content-p">Item 6</div>
                                            </li>
                                        </ol>
                                    </li>
                                </ol>
                            </div><!--nastable-list-3-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->
            </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/plugins/nestable/jquery.nestable.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/jquery.nastable.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
