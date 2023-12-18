@extends('layouts.backend.app')
@section('title') Buat Akses - {{ $portal->title }} @endsection
@section('css')
    {{-- <link href="{{ URL::asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ URL::asset('assets/css/iziToast.css') }}" rel="stylesheet" type="text/css" />
    
    <link href="{{ URL::asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/plugins/huebee/huebee.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/plugins/timepicker/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Buat Akses @endslot
@slot('li_3') @yield('title') @endslot
@slot('title') @yield('title') @endslot
@endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Buat Akses - {{ $portal->title }}</h4>
                </div>
                <form id="form-simpan" method="post">
                @csrf
                <div class="card-body bootstrap-select-1">
                    <div class="mb-3">
                        <label class="form-label">Departemen</label>
                        <select name="departemen_id" class="form-control select2 custom-select" id="">
                            <option>-- Pilih Departemen --</option>
                            <option value="HRGA">HRGA</option>
                            <option value="Purchasing">Purchasing</option>
                            <option value="Corsec">Corsec</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Color</label>
                        <select name="color" class="form-control select2 custom-select" id="">
                            <option>-- Pilih Warna --</option>
                            <option value="full-type">Hijau</option>
                            <option value="internship-type">Merah</option>
                        </select>
                        {{-- <input type="text" name="link" class="form-control" placeholder="Link"> --}}
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-soft-primary btn-sm">Submit</button>
                    <a href="{{ route('portal') }}" class="btn btn-soft-secondary btn-sm">Back</a>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- <script src="{{ URL::asset('assets/plugins/select2/select2.min.js') }}"></script> --}}
    <script src="{{ URL::asset('assets/js/iziToast.min.js') }}"></script>

    <script src="{{ URL::asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/huebee/huebee.pkgd.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/timepicker/bootstrap-material-datetimepicker.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/jquery.forms-advanced.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script>
        // $('.js-example-basic-single').select2({
        //     placeholder: 'Select an option'
        // });

        $('#form-simpan').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');
            $.ajax({
                type:'POST',
                url: "{{ route('portal.detail_simpan',['id' => $portal->id]) }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (result) => {
                    if(result.success != false){
                        iziToast.success({
                            title: result.message_title,
                            message: result.message_content
                        });
                        this.reset();
                    }else{
                        iziToast.error({
                            title: result.success,
                            message: result.error
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