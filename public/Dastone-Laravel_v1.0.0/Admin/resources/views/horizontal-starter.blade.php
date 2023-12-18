@extends('layouts.master-layout-horizontal')
@section('title') Dashboard @endsection

@section('css')
    <link href="{{ URL::asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') Pages @endslot
            @slot('li_3') Starer @endslot
            @slot('title') Starer @endslot
        @endcomponent

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
