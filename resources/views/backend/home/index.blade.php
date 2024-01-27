@extends('layouts.backend.app')
@section('title')
    Dashboard
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            -
        @endslot
        @slot('title')
            Dashboard
        @endslot
    @endcomponent

    <div class="row">
        @if (Session::has('success'))
            <div class="alert custom-alert custom-alert-success icon-custom-alert shadow-sm fade show d-flex justify-content-between"
                role="alert">
                <div class="media">
                    <i class="fa fa-check alert-icon text-success align-self-center font-30 me-3"></i>
                    <div class="media-body align-self-center">
                        <h5 class="mb-1 fw-bold mt-0">Success</h5>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
                <button type="button" class="btn-close align-self-center" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert custom-alert custom-alert-danger icon-custom-alert shadow-sm fade show d-flex justify-content-between"
                role="alert">
                <div class="media">
                    <i class="fa fa-times alert-icon text-danger align-self-center font-30 me-3"></i>
                    <div class="media-body align-self-center">
                        <h5 class="mb-1 fw-bold mt-0">Error</h5>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
                <button type="button" class="btn-close align-self-center" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif
        @if (env('NOTIF_INFORMASI') == true)
        <div class="col-md-12">
            <div class="alert alert-outline-primary" role="alert">
                <strong>Informasi!</strong> Alamat website aplikasi pengecekkan <b>APAR & HYDRANT</b> berubah ke alamat website <a href="https://app.indonesianshagtobacco.com" class="text-blue"><b>https://app.indonesianshagtobacco.com</b></a>
            </div>
        </div>
        @endif
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Penyimpanan</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="my-5">
                                <div id="ana_12" class="apex-charts d-block w-90 mx-auto"></div>
                                <hr class="hr-dashed w-25 mt-0">
                            </div>
                            <div class="text-center">
                                <h5>{{ round($disk_used_size, 2) }} GB dari {{ round($total_disk_size, 2) }} GB telah
                                    digunakan</h5>
                            </div>
                        </div>
                    </div>
                </div>
                @if (auth()->user()->created_at >= auth()->user()->updated_at)
                <div class="col-lg-6">
                    <div class="alert custom-alert custom-alert-primary icon-custom-alert shadow-sm fade show d-flex justify-content-between" role="alert">
                        <div class="media">
                            <i class="la la-exclamation-triangle alert-icon text-primary align-self-center font-30 me-3"></i>
                            <div class="media-body align-self-center">
                                <h5 class="mb-1 fw-bold mt-0">Notifikasi</h5>
                                <span>Terima kasih telah mengunjungi aplikasi PT. Indonesian Tobacco Tbk.</span>
                                <span>Dari Tim IT sarankan, akun <b>{{ auth()->user()->name }}</b> segera melakukan perubahan <b>Password Akun</b> tersebut.</span>
                                <span>Password default: <b>user1234</b>. Jika telah melakukan perubahan, notifikasi ini akan melakukan menutup pemberitahuan.</span>
                            </div>
                        </div>
                        <button type="button" class="btn-close align-self-center" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                {{-- @if (auth()->user()->roles != 3)
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">Surat Office</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nomor Surat</th>
                                            <th class="text-center">Tanggal Buat</th>
                                            <th class="text-center">Perihal</th>
                                            <th class="text-center">Pengguna</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($surat_offices as $key => $so)
                                            <tr>
                                                <td class="text-center">{{ $no }}</td>
                                                <td class="text-center">{{ $so->nomor_surat }}</td>
                                                <td class="text-center">
                                                    {{ \Carbon\Carbon::create($so->tanggal)->isoFormat('LL') }}</td>
                                                <td class="text-center">{{ $so->keterangan }}</td>
                                                <td class="text-center">{{ $so->pengguna }}</td>
                                                <td class="text-center">
                                                    @if ($so->status == 1)
                                                        <span class="badge badge-outline-warning">Menunggu
                                                            Persetujuan</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $surat_offices->links('vendor.pagination.backend-paginate') }}
                            </div>
                        </div>
                    </div>
                @endif --}}
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Teams</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="project-overview-activity" data-simplebar>
                        <div class="activity">
                            @forelse ($departemen_details as $dd)
                                <div class="activity-info">
                                    <div class="icon-info-activity">
                                        <i class="las la-user bg-soft-primary"></i>
                                    </div>
                                    <div class="activity-info-text">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="text-muted mb-0 font-13"><span>{{ $dd->user->name }} : </span>
                                                {{ $dd->departemen->nama_departemen }}
                                            </p>
                                            @if (Cache::has('is_online' . $dd->user->id))
                                                <small class="text-success">Online</small>
                                            @else
                                                <small
                                                    class="text-muted">{{ \Carbon\Carbon::parse($dd->user->last_seen)->diffForHumans() }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('public/assets/plugins/apex-charts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/app.js') }}"></script>
    <script>
        var options = {
            series: [{{ $diskuses }}],
            chart: {
                type: 'radialBar',
                offsetY: -20,
                sparkline: {
                    enabled: true
                }
            },
            plotOptions: {
                radialBar: {
                    startAngle: -90,
                    endAngle: 90,
                    hollow: {
                        size: '75%',
                        position: 'front',
                    },
                    track: {
                        background: ["rgba(42, 118, 244, .18)"],
                        strokeWidth: '80%',
                        opacity: 0.5,
                        margin: 5,
                    },
                    dataLabels: {
                        name: {
                            show: false
                        },
                        value: {
                            offsetY: -2,
                            fontSize: '20px'
                        }
                    }
                }
            },
            stroke: {
                lineCap: 'butt'
            },
            colors: ["#2a76f4"],
            grid: {
                padding: {
                    top: -10
                }
            },

            labels: ['Average Results'],
        };

        var chart = new ApexCharts(document.querySelector("#ana_12"), options);
        chart.render();
    </script>
@endsection
