@extends('layouts.backend.app')
@section('title') Edit Pengajuan | {{ $surat_office->nomor_surat }} @endsection
@section('css')
    <link href="{{ URL::asset('public/assets/css/iziToast.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('public/assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    @component('components.breadcrumb')
    @slot('li_1') Edit Pengajuan @endslot
    @slot('li_3') @yield('title') @endslot
    @slot('title') @yield('title') @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <form id="upload-pengajuan-edit" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-header bg-primary">
                    <div class="card-title text-white"><i class="mdi mdi-file"></i> Nomor Surat : {{ $surat_office->nomor_surat }}</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="" class="form-label">Tanggal</label>
                                <input type="date" name="pengajuan_tanggal" class="form-control" value="{{ $surat_office->tanggal }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="" class="form-label">Perihal</label>
                                <input type="text" name="pengajuan_perihal" class="form-control" placeholder="Perihal" value="{{ $surat_office->keterangan }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="" class="form-label">Pengguna</label>
                                <select name="pengajuan_pengguna" class="form-control" id="">
                                    <option>-- Pilih Pengguna --</option>
                                    <option value="Direksi">Direksi</option>
                                    <option value="{{ $departemen->departemen->nama_departemen }}">{{ $departemen->departemen->nama_departemen }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Upload Berkas</label>
                        <input type="file" name="pengajuan_files" id="input-file-now" class="dropify" />
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-primary"><i class="mdi mdi-send me-2"></i>Submit</button>
                    <a href="{{ route('surat_office') }}" class="btn btn-outline-secondary"><i class="mdi mdi-keyboard-backspace me-2"></i>Back</a>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('public/assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/pages/jquery.form-upload.init.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/app.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/iziToast.min.js') }}"></script>
    <script>
        $('#upload-pengajuan-edit').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            // $('#image-input-error').text('');
            $.ajax({
                type:'POST',
                url: "{{ route('surat_office.pengajuan.edit.update',['id' => $surat_office->id]) }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (result) => {
                    if(result.success != false){
                        iziToast.success({
                            title: result.message_title,
                            message: result.message_content
                        });
                        // this.reset();
                        window.location.href = "{{ route('surat_office') }}";
                        // $('.modalBuat').hide();
                        // table.ajax.reload();
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