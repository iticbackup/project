@extends('layouts.master')
@section('title') Dashboard @endsection

    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') Forms @endslot
            @slot('li_3') Repeater @endslot
            @slot('title') Repeater @endslot
        @endcomponent

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Default Repeater</h4>
                            <p class="text-muted mb-0">An interface to add and remove a repeatable group of input elements.</p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <form method="POST" class="form-horizontal well">
                                <fieldset>
                                    <div class="repeater-default">
                                        <div data-repeater-list="car">
                                            <div data-repeater-item="">
                                                <div class="form-group row d-flex align-items-end">

                                                    <div class="col-sm-4">
                                                        <label class="form-label">Make</label>
                                                        <select name="car[0][make]" class="form-select">
                                                            <option value="volkswagon" selected="">Volkswagon</option>
                                                            <option value="honda">Honda</option>
                                                            <option value="ford">Ford</option>
                                                        </select>
                                                    </div><!--end col-->

                                                    <div class="col-sm-4">
                                                        <label class="form-label">Model</label>
                                                        <input type="text" name="car[0][model]" value="Beetle" class="form-control">
                                                    </div><!--end col-->

                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="customCheck1" name="car[0][features][]" value="ac">
                                                            <label class="form-check-label" for="customCheck1">
                                                                Air Conditioning
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="customCheck2" name="car[0][features][]" value="abs">
                                                            <label class="form-check-label" for="customCheck2">
                                                                Anti-Lock Brakes
                                                            </label>
                                                        </div>
                                                    </div><!--end col-->

                                                    <div class="col-sm-1">
                                                        <span data-repeater-delete="" class="btn btn-outline-danger">
                                                            <span class="far fa-trash-alt me-1"></span> Delete
                                                        </span>
                                                    </div><!--end col-->
                                                </div><!--end row-->
                                            </div><!--end /div-->

                                            <div data-repeater-item="">
                                                <div class="form-group row d-flex align-items-end">

                                                    <div class="col-sm-4">
                                                        <label class="form-label">Make</label>
                                                        <select name="car[1][make]" class="form-select">
                                                            <option value="volkswagon">Volkswagon</option>
                                                            <option value="honda" selected="">Honda</option>
                                                            <option value="ford">Ford</option>
                                                        </select>
                                                    </div><!--end col-->

                                                    <div class="col-sm-4">
                                                        <label class="form-label">Model</label>
                                                        <input type="text" name="car[1][model]" value="Accord" class="form-control">
                                                    </div><!--end col-->

                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="customCheck3" name="car[0][features][]" value="ac">
                                                            <label class="form-check-label" for="customCheck3">
                                                                Air Conditioning
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="customCheck4" name="car[0][features][]" value="abs">
                                                            <label class="form-check-label" for="customCheck4">
                                                                Anti-Lock Brakes
                                                            </label>
                                                        </div>
                                                    </div><!--end col-->

                                                    <div class="col-sm-1">
                                                        <span data-repeater-delete="" class="btn btn-outline-danger">
                                                            <span class="far fa-trash-alt me-1"></span> Delete
                                                        </span>
                                                    </div><!--end col-->
                                                </div><!--end row-->
                                            </div><!--end /div-->
                                        </div><!--end repet-list-->
                                        <div class="form-group mb-0 row">
                                            <div class="col-sm-12">
                                                <span data-repeater-create="" class="btn btn-outline-secondary">
                                                    <span class="fas fa-plus"></span> Add
                                                </span>
                                                <input type="submit" value="Submit" class="btn btn-outline-primary">
                                            </div><!--end col-->
                                        </div><!--end row-->
                                    </div> <!--end repeter-->
                                </fieldset><!--end fieldset-->
                            </form><!--end form-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Custom Show/Hide Repeater</h4>
                            <p class="text-muted mb-0">An interface to add and remove a repeatable group of input elements.</p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <form method="POST" class="form-horizontal well">
                                <fieldset>
                                    <div class="repeater-custom-show-hide">
                                        <div data-repeater-list="car">
                                            <div data-repeater-item="">
                                                <div class="form-group row  d-flex align-items-end">

                                                    <div class="col-sm-4">
                                                        <label class="form-label">Make</label>
                                                        <select name="car[0][make]" class="form-select">
                                                            <option value="volkswagon" selected="">Volkswagon</option>
                                                            <option value="honda">Honda</option>
                                                            <option value="ford">Ford</option>
                                                        </select>
                                                    </div><!--end col-->

                                                    <div class="col-sm-4">
                                                        <label class="form-label">Model</label>
                                                        <input type="text" name="car[0][model]" value="Beetle" class="form-control">
                                                    </div><!--end col-->

                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="customCheck5" name="car[0][features][]" value="ac">
                                                            <label class="form-check-label" for="customCheck5">
                                                                Air Conditioning
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="customCheck6" name="car[0][features][]" value="abs">
                                                            <label class="form-check-label" for="customCheck6">
                                                                Anti-Lock Brakes
                                                            </label>
                                                        </div>
                                                    </div><!--end col-->

                                                    <div class="col-sm-1">
                                                        <span data-repeater-delete="" class="btn btn-outline-danger">
                                                            <span class="far fa-trash-alt me-1"></span> Delete
                                                        </span>
                                                    </div><!--end col-->
                                                </div><!--end row-->
                                            </div><!--end /div-->

                                            <div data-repeater-item="">
                                                <div class="form-group row  d-flex align-items-end">
                                                    <div class="col-sm-4">
                                                        <label class="form-label">Make</label>
                                                        <select name="car[1][make]" class="form-select">
                                                            <option value="volkswagon">Volkswagon</option>
                                                            <option value="honda" selected="">Honda</option>
                                                            <option value="ford">Ford</option>
                                                        </select>
                                                    </div><!--end col-->

                                                    <div class="col-sm-4">
                                                        <label class="form-label">Model</label>
                                                        <input type="text" name="car[1][model]" value="Accord" class="form-control">
                                                    </div><!--end col-->

                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="customCheck7" name="car[0][features][]" value="ac">
                                                            <label class="form-check-label" for="customCheck7">
                                                                Air Conditioning
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="customCheck8" name="car[0][features][]" value="abs">
                                                            <label class="form-check-label" for="customCheck8">
                                                                Anti-Lock Brakes
                                                            </label>
                                                        </div>
                                                    </div><!--end col-->

                                                    <div class="col-sm-1">
                                                        <span data-repeater-delete="" class="btn btn-outline-danger">
                                                            <span class="far fa-trash-alt me-1"></span> Delete
                                                        </span>
                                                    </div><!--end col-->
                                                </div><!--end row-->
                                            </div><!--end /div-->
                                        </div><!--end repet-list-->

                                        <div class="form-group row mb-0">
                                            <div class="col-sm-12">
                                                <span data-repeater-create="" class="btn btn-outline-secondary">
                                                    <span class="fa fa-plus"></span> Add
                                                </span>
                                                <input type="submit" value="Submit" class="btn btn-outline-primary">
                                            </div><!--end col-->
                                        </div><!--end row-->
                                    </div> <!--end repeter-->
                                </fieldset><!--end fieldset-->
                            </form><!--end form-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
            </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/plugins/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/jquery.form-repeater.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection

