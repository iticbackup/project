@extends('layouts.master')
@section('title') Dashboard @endsection

@section('css')
    <link href="{{ URL::asset('assets/plugins/prettify/prettify.css') }}" rel="stylesheet" type="text/css" />
@endsection

    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') Advanced UI @endslot
            @slot('li_3') Highlight @endslot
            @slot('title') Highlight @endslot
        @endcomponent

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">HTML Highlight</h4>
                            <p class="text-muted mb-0">It will automatically be pretty-printed.</p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <pre class="prettyprint lang-html escape">
<div class="card-header">
    <h4 class="card-title">Clipboard Examples of Textarea</h4>
    <p class="text-muted mb-0">Textarea example of clipboard</p>
</div>
                            </pre>
                        </div><!--end card-body-->
                    </div><!--end card-->


                </div> <!-- end col -->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Css Highlight</h4>
                            <p class="text-muted mb-0">It will automatically be pretty-printed.</p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <pre class="prettyprint lang-css escape">
.example {
    font-family: Georgia, Times, serif;
    color: #555;
    text-align: center;
}
                            </pre>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->
            </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/plugins/prettify/run_prettify.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.core.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
