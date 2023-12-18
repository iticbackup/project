@extends('layouts.master')
@section('title') Dashboard @endsection

    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') Forms @endslot
            @slot('li_3') Form Editor @endslot
            @slot('title') Form Editor @endslot
        @endcomponent

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tinymce wysihtml5</h4>
                            <p class="text-muted mb-0">Bootstrap-wysihtml5 is a javascript
                                plugin that makes it easy to create simple, beautiful wysiwyg editors
                                with the help of wysihtml5 and Twitter Bootstrap.
                            </p>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <form method="post">
                                <textarea id="basic-conf">Hello, World!</textarea>
                            </form>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!-- end col -->
            </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/jquery.form-editor.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection

