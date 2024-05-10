@extends('layouts.backend.app')
@section('title')
    Formulir Baru APAR
@endsection
@section('css')
<link href="{{ URL::asset('public/assets/css/iziToast.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('public/assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet"
    type="text/css">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Pengecekkan APAR
        @endslot
        @slot('li_3')
            @yield('title')
        @endslot
        @slot('title')
            @yield('title')
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="card-title text-center text-white">@yield('title')</h4>
                </div>
                <form id="form-simpan" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Kode Tabung</th>
                                        <th class="text-center">:</th>
                                        <td>
                                            <input type="text" name="kode_tabung" class="form-control" placeholder="Kode Tabung" value="{{ $form_aparts->kode_tabung }}" style="width: 50%" id="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Lokasi</th>
                                        <th class="text-center">:</th>
                                        <td>
                                            <input type="text" name="tempat" class="form-control" placeholder="Lokasi" value="{{ $form_aparts->tempat }}" id="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jenis</th>
                                        <th class="text-center">:</th>
                                        <td>
                                            <input type="text" name="jenis" class="form-control" placeholder="Jenis" style="width: 50%" value="{{ $form_aparts->jenis }}" id="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Warna</th>
                                        <th class="text-center">:</th>
                                        <td>
                                            <input type="text" name="warna" class="form-control" placeholder="Warna" style="width: 50%" value="{{ $form_aparts->warna }}" id="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Berat</th>
                                        <th class="text-center">:</th>
                                        <td>
                                            <input type="text" name="berat" class="form-control" placeholder="Berat" style="width: 50%" value="{{ $form_aparts->berat }}" id="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Expired</th>
                                        <th class="text-center">:</th>
                                        <td>
                                            <input type="date" name="expired" class="form-control" placeholder="Expired" style="width: 50%" id="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Periode</th>
                                        <th class="text-center">:</th>
                                        <td>
                                            <input type="text" name="periode" class="form-control" placeholder="Periode" style="width: 50%" id="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <th class="text-center">:</th>
                                        <td>
                                            <select name="status" class="form-control" style="width: 50%" id="">
                                                <option value="">-- Pilih Status --</option>
                                                <option value="Y">Aktif</option>
                                                <option value="N">Tidak Aktif</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="{{ URL::asset('public/assets/js/app.js') }}"></script>
<script src="{{ URL::asset('public/assets/js/iziToast.min.js') }}"></script>
<script src="{{ URL::asset('public/assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script>
    $('#form-simpan').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $('#image-input-error').text('');
        $.ajax({
            type: 'POST',
            url: "{{ route('inventaris.k3.check_expired_simpan',['id' => $inventaris_k3_detail->inventaris_k3_id]) }}",
            data: formData,
            contentType: false,
            processData: false,
            success: (result) => {
                if (result.success != false) {
                    iziToast.success({
                        title: result.message_title,
                        message: result.message_content
                    });
                } else {
                    iziToast.error({
                        title: result.success,
                        message: result.error
                    });
                }
            },
            error: function(request, status, error) {
                iziToast.error({
                    title: 'Error',
                    message: error,
                });
            }
        });
    });
</script>
@endsection