@extends('layouts.master')
@section('title') Dashboard @endsection

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/x-editable/css/bootstrap-editable.css') }}">
@endsection

    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') Forms @endslot
            @slot('li_3') Xeditable @endslot
            @slot('title') Xeditable @endslot
        @endcomponent

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Inline Example</h4>
                            <p class="text-muted mb-0">This library allows you to create
                                editable elements on your page. It can be used with any engine
                                (bootstrap, jquery-ui, jquery only) and includes both popup and inline
                                modes. Please try out demo to see how it works.
                            </p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th class="w-50">Inline</th>
                                    <th>Examples</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Simple Text Field</td>
                                    <td>
                                        <a href="#" id="inline-username" data-type="text" data-pk="1" data-title="Enter username">superuser</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Empty text field, required</td>
                                    <td>
                                        <a href="#" id="inline-firstname" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-title="Enter your firstname"></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Select, local array, custom display</td>
                                    <td>
                                        <a href="#" id="inline-sex" data-type="select" data-pk="1" data-value="" data-title="Select sex"></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Select, error while loading</td>
                                    <td>
                                        <a href="#" id="inline-status" data-type="select" data-pk="1" data-value="0" data-source="/status" data-title="Select status">Active</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Combodate</td>
                                    <td>
                                        <a href="#" id="inline-dob" data-type="combodate" data-value="2015-09-24" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="1"  data-title="Select Date of birth"></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Textarea, buttons below. Submit by ctrl+enter</td>
                                    <td>
                                        <a href="#" id="inline-comments" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-title="Enter comments">awesome user!</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table><!--end table-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->
            </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/plugins/x-editable/js/bootstrap-editable.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/jquery.form-xeditable.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
