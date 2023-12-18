@extends('layouts.master')
@section('title') Dashboard @endsection

@section('css')
    <link href="{{ URL::asset('assets/plugins/fullcalendar/packages/core/main.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/fullcalendar/packages/daygrid/main.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/fullcalendar/packages/bootstrap/main.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/fullcalendar/packages/timegrid/main.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/fullcalendar/packages/list/main.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/lightpick/lightpick.css') }}" rel="stylesheet" />
@endsection
    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') Apps @endslot
            @slot('li_3') Calendar @endslot
            @slot('title') Calendar @endslot
        @endcomponent

            <div class="row">
                <div class="col-12">
                    <div class="card calendar-cta">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <img src="{{ URL::asset('assets/images/widgets/calendar.svg') }}" alt="" class="" height="150">
                                </div><!--end col-->
                                <div class="col">
                                    <h5 class="font-20">Welcome to your theme Calendar!</h5>
                                    <P>Hi, You can see all your meetings, events and create new ones.</P>
                                    <p>There are many variations of passages of Lorem Ipsum available,
                                        but the majority have suffered alteration in some form, by injected humour,
                                        or randomised words which don't look even slightly believable.
                                    </p>
                                    <button type="button" class="btn btn-outline-primary btn-sm">All Time chedule</button>
                                </div><!--end col-->

                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <div class="dash-datepick mb-3">
                        <input type="hidden" id="light_datepick"/>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item align-items-center d-flex">
                            <div class="media">
                                <img src="{{ URL::asset('assets/images/widgets/project1.jpg') }}" class="me-3 thumb-sm align-self-center rounded-circle" alt="...">
                                <div class="media-body align-self-center">
                                    <h5 class="m-0 font-13">Meeting with UI/UX Designers</h5>
                                    <p class="text-muted mb-0">Today 07:30 AM</p>
                                </div><!--end media body-->
                            </div>
                        </li>
                        <li class="list-group-item align-items-center ">
                            <div class="media">
                                <img src="{{ URL::asset('assets/images/users/user-5.jpg') }}" class="me-3 thumb-sm align-self-center rounded-circle" alt="...">
                                <div class="media-body align-self-center">
                                    <h5 class="m-0 font-13">Lunch with my friend</h5>
                                    <p class="text-muted mb-0">Today 12:30 PM</p>
                                </div><!--end media body-->
                            </div>
                        </li>
                        <li class="list-group-item align-items-center">
                            <div class="media">
                                <img src="{{ URL::asset('assets/images/widgets/project3.jpg') }}" class="me-3 thumb-sm align-self-center rounded-circle" alt="...">
                                <div class="media-body align-self-center">
                                    <h5 class="m-0 font-13">Call for payment Project ID : #254136</h5>
                                    <p class="text-muted mb-0">Tomorrow 10:30 AM</p>
                                </div><!--end media body-->
                            </div>
                        </li>
                        <li class="list-group-item align-items-center ">
                            <div class="media">
                                <img src="{{ URL::asset('assets/images/users/user-4.jpg') }}" class="me-3 thumb-sm align-self-center rounded-circle" alt="...">
                                <div class="media-body align-self-center">
                                    <h5 class="m-0 font-13">Picnic with my Family</h5>
                                    <p class="text-muted mb-0">01 June 2019 - 09:30 AM</p>
                                </div><!--end media body-->
                            </div>
                        </li>
                        <li class="list-group-item align-items-center">
                            <div class="media">
                                <img src="{{ URL::asset('assets/images/widgets/project4.jpg') }}" class="me-3 thumb-sm align-self-center rounded-circle" alt="...">
                                <div class="media-body align-self-center">
                                    <h5 class="m-0 font-13">Meeting with Developers</h5>
                                    <p class="text-muted mb-0">04 June 2019 - 07:30 AM</p>
                                </div><!--end media body-->
                            </div>
                        </li>
                    </ul>
                </div><!--end col-->
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div id='calendar'></div>
                            <div style='clear:both'></div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
            </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/plugins/fullcalendar/packages/core/main.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fullcalendar/packages/daygrid/main.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fullcalendar/packages/timegrid/main.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fullcalendar/packages/interaction/main.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fullcalendar/packages/list/main.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/lightpick/lightpick.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/jquery.calendar.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
