@extends('layouts.master')
@section('title') Dashboard @endsection

    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') pages @endslot
            @slot('li_3') Edit Table @endslot
            @slot('title') Edit Table @endslot
        @endcomponent

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Table With Button</h4>
                            <p class="text-muted mb-0">Add toolbar column with edit and delete buttons.</p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <button class="btn  btn-primary btn-sm mb-3" id="submit_data">Submit</button>
                            <div class="table-responsive">
                                <table class="table  table-bordered table-sm" id="makeEditable">
                                    <thead>
                                        <tr>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Email </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Default</td>
                                            <td>Defaultson</td>
                                            <td>def@somemail.com</td>
                                        </tr>
                                        <tr class="success">
                                            <td>Success</td>
                                            <td>Doe</td>
                                            <td>john@example.com</td>
                                        </tr>
                                        <tr class="danger">
                                            <td>Danger</td>
                                            <td>Moe</td>
                                            <td>mary@example.com</td>
                                        </tr>
                                        <tr class="info">
                                            <td>Info</td>
                                            <td>Dooley</td>
                                            <td>july@example.com</td>
                                        </tr>
                                        <tr class="warning">
                                            <td>Warning</td>
                                            <td>Refs</td>
                                            <td>bo@example.com</td>
                                        </tr>
                                        <tr class="active">
                                            <td>Active</td>
                                            <td>Activeson</td>
                                            <td>act@example.com</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <span class="float-right">
                                <button id="but_add" class="btn btn-success btn-sm">Add New Row</button>
                            </span><!--end table-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Examples</h4>
                            <p class="text-muted mb-0">just start typing to edit, or move around with arrow keys or mouse clicks!</p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <table id="mainTable" class="table table-striped  mb-0">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Cost</th>
                                    <th>Profit</th>
                                    <th>Fun</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Car</td>
                                    <td>100</td>
                                    <td>200</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>Bike</td>
                                    <td>330</td>
                                    <td>240</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>Plane</td>
                                    <td>430</td>
                                    <td>540</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>Yacht</td>
                                    <td>100</td>
                                    <td>200</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>Segway</td>
                                    <td>330</td>
                                    <td>240</td>
                                    <td>1</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th><strong>TOTAL</strong></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/plugins/tiny-editable/mindmup-editabletable.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/tiny-editable/numeric-input-example.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/bootable/bootstable.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/jquery.tabledit.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
