@extends('layouts.backend.app')
@section('title') Profile @endsection
@section('css')
    <link href="{{ URL::asset('public/assets/css/iziToast.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
    @slot('li_1') Profile @endslot
    @slot('title') Profile @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dastone-profile">
                        <div class="row">
                            <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                <div class="dastone-profile-main">
                                    <div class="dastone-profile-main-pic">
                                        <div class="avatar-box thumb-xxl align-self-center me-2">
                                            <span class="avatar-title bg-secondary rounded-circle"><i class="far fa-user"></i></span>
                                        </div>
                                        {{-- <img src="{{ (isset(Auth::user()->avatar) && Auth::user()->avatar != '') ? asset(Auth::user()->avatar) : asset('/assets/images/users/user-1.jpg') }}" alt="" height="110" class="rounded-circle"> --}}
                                        {{-- <span class="dastone-profile_main-pic-change" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </span> --}}
                                    </div>
                                    <div class="dastone-profile_user-detail">
                                        <h5 class="dastone-user-name">{{ Auth::user()->name }}</h5>
                                        <p class="mb-0 dastone-user-name-post">{{ $departemen_detail->departemen->nama_departemen }}</p>
                                    </div>
    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-4">
        <ul class="nav-border nav nav-pills mb-0" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="settings_detail_tab" data-bs-toggle="pill" href="#Profile_Settings">Settings</a>
            </li>
        </ul>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="Profile_Settings" role="tabpanel" aria-labelledby="settings_detail_tab">
                    <form id="update-profile" method="post">
                        @csrf
                    <div class="row">
                        <div class="col-lg-6 col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h4 class="card-title">Personal Information</h4>
                                        </div>
                                    </div>
                                </div>
                                <!--end card-header-->
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Username</label>
                                        <div class="col-lg-9 col-xl-8">
                                            <input class="form-control" type="text" name="username" value="{{ $user->username }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Name</label>
                                        <div class="col-lg-9 col-xl-8">
                                            <input class="form-control" type="text" name="name" value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Access</label>
                                        <div class="col-lg-9 col-xl-8 align-self-center mb-lg-0 ">
                                            {{ $user->role->roles }}
                                            {{-- <input class="form-control" type="text" value="{{ $user->name }}"> --}}
                                        </div>
                                    </div>
                                    {{-- <div class="form-group row">
                                        <div class="col-lg-9 col-xl-8 offset-lg-3">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                                            <button type="button" class="btn btn-sm btn-outline-danger">Cancel</button>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-6 col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Change Password</h4>
                                </div>
                                <!--end card-header-->
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Current Password</label>
                                        <div class="col-lg-9 col-xl-8">
                                            <input class="form-control" type="password" name="current_password" placeholder="Current Password">
                                            {{-- <a href="#" class="text-primary font-12">Forgot password ?</a> --}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">New Password</label>
                                        <div class="col-lg-9 col-xl-8">
                                            <input class="form-control" type="password" placeholder="New Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Confirm Password</label>
                                        <div class="col-lg-9 col-xl-8">
                                            <input class="form-control" type="password" name="password" placeholder="Re-Password">
                                            <span class="form-text text-muted font-12">Never share your password.</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-9 col-xl-8 offset-lg-3">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">Change Password</button>
                                            <button type="button" class="btn btn-sm btn-outline-danger">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div> <!-- end col -->
                    </div>
                    </form>
                    <!--end row-->
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
<script src="{{ URL::asset('public/assets/js/app.js') }}"></script>
<script src="{{ URL::asset('public/assets/js/iziToast.min.js') }}"></script>
<script>
    $('#update-profile').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $('#image-input-error').text('');
        $.ajax({
            type:'POST',
            url: "{{ route('profile.update') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: (result) => {
                if(result.success == true){
                    iziToast.success({
                        title: result.message_title,
                        message: result.message_content
                    });
                }else{
                    iziToast.error({
                        title: result.message_title,
                        message: result.message_content
                    });
                }
            },
            error: function (request, status, error) {
                iziToast.error({
                    title: 'Error',
                    message: error,
                });
            }
        });
    });
</script>
@endsection