@extends('layouts.backend.app')
@section('title')
    Inventaris K3 - APAR & HYDRANT - Periode
@endsection

@section('css')
    <link href="{{ URL::asset('public/assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('public/assets/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Inventaris
        @endslot
        @slot('li_3')
            @yield('title')
        @endslot
        @slot('title')
            @yield('title')
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title text-center" style="font-size: 12pt">INPUT PERIODE APAR & HYDRANT</div>
                </div>
                <div class="card-body">
                    <form id="form-simpan" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="">Periode</label>
                                <input type="text" name="periode" class="form-control" placeholder="Input Periode"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                @foreach ($inventarisK3s as $inventarisK3)
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-header bg-primary">
                                                <div class="card-title text-center text-white" style="font-size: 12pt">Kode Barcode :
                                                    {{ $inventarisK3->kode_barcode }}</div>
                                                <div class="card-title text-center text-white" style="font-size: 12pt">Lokasi :
                                                    {{ $inventarisK3->lokasi }}</div>
                                            </div>
                                            <div class="card-body">
                                                @foreach ($inventarisK3->inventaris_k3_detail as $ikd)
                                                    @if ($ikd->jenis_barang == 'APAR')
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered dt-responsive nowrap">
                                                                <tr>
                                                                    <th>Jenis Barang</th>
                                                                    <th>:</th>
                                                                    <td>{{ $ikd->jenis_barang }}</td>
                                                                </tr>
                                                                @foreach ($ikd->form_apart as $fa)
                                                                    <tr>
                                                                        <th>Kode Tabung</th>
                                                                        <th>:</th>
                                                                        <td>{{ $fa->kode_tabung }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Jenis</th>
                                                                        <th>:</th>
                                                                        <td>{{ $fa->jenis }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Warna</th>
                                                                        <th>:</th>
                                                                        <td>{{ $fa->warna }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Berat</th>
                                                                        <th>:</th>
                                                                        <td>{{ $fa->berat }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Expired</th>
                                                                        <th>:</th>
                                                                        <td>{{ $fa->expired }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Periode</th>
                                                                        <th>:</th>
                                                                        <td>{{ $fa->periode }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                    @elseif($ikd->jenis_barang == 'HYDRANT')
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered dt-responsive nowrap">
                                                                <tr>
                                                                    <th>Jenis Barang</th>
                                                                    <th>:</th>
                                                                    <td>{{ $ikd->jenis_barang }}</td>
                                                                </tr>
                                                                @foreach ($ikd->form_hydrant as $fh)
                                                                    <tr>
                                                                        <th>Kode Hydrant</th>
                                                                        <th>:</th>
                                                                        <td>{{ $fh->kode_hydrant }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Lokasi</th>
                                                                        <th>:</th>
                                                                        <td>{{ $fh->lokasi }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Periode</th>
                                                                        <th>:</th>
                                                                        <td>{{ $fh->periode }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                    @endif
                                                    
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-upload"></i>
                                Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('public/assets/js/app.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#form-simpan').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');
            swal.fire({
                title: 'Apakah anda yakin?',
                // text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, submit',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('inventaris.k3.periode_simpan') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: (result) => {
                            if (result.success != false) {
                                // iziToast.success({
                                //     title: result.message_title,
                                //     message: result.message_content
                                // });
                                // this.reset();
                                // table.ajax.reload();
                                swal.fire(
                                    'Success',
                                    result.message,
                                    'success'
                                ).then(function(result) {
                                    if (result.value) {
                                        location.reload()
                                    }
                                })
                            } else {
                                swal.fire(
                                    'Cancelled',
                                    result.message,
                                    'error'
                                )
                                // iziToast.error({
                                //     title: result.success,
                                //     message: result.error
                                // });
                            }
                        },
                        error: function(request, status, error) {
                            swal.fire(
                                'Error',
                                'error',
                                'error'
                            )
                            // iziToast.error({
                            //     title: 'Error',
                            //     message: error,
                            // });
                        }
                    });
                    // swal.fire(
                    //     'Deleted!',
                    //     'Your file has been deleted.',
                    //     'success'
                    // )
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swal.fire(
                        'Cancelled',
                        'error'
                    )
                }
            })
            // $.ajax({
            //     type: 'POST',
            //     url: "{{ route('inventaris.k3.periode_simpan') }}",
            //     data: formData,
            //     contentType: false,
            //     processData: false,
            //     success: (result) => {
            //         if (result.success != false) {
            //             iziToast.success({
            //                 title: result.message_title,
            //                 message: result.message_content
            //             });
            //             this.reset();
            //             // $('.modalBuat').hide();
            //             table.ajax.reload();
            //         } else {
            //             iziToast.error({
            //                 title: result.success,
            //                 message: result.error
            //             });
            //         }
            //     },
            //     error: function(request, status, error) {
            //         iziToast.error({
            //             title: 'Error',
            //             message: error,
            //         });
            //     }
            // });
        });
    </script>
@endsection
