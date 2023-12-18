@extends('layouts.backend.app')
@section('title')
    Notifikasi
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Notifikasi
        @endslot
        @slot('title')
            Notifikasi
        @endslot
    @endcomponent

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <h4 class="card-title"><i data-feather="bell" class="align-self-center topbar-icon"></i> Notifikasi</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="project-overview-activity" style="height: 100%" data-simplebar>
                    <div class="activity">
                        @forelse (auth()->user()->unreadNotifications as $notification)
                            <a href="{{ $notification->data['url'] }}" class="mark-as-read" data-id="{{ $notification->id }}">
                                <div class="activity-info">
                                    <div class="icon-info-activity">
                                        <div class="avatar-md bg-soft-{{ $notification->data['color_icon'] }}">
                                            <i data-feather="{{ $notification->data['icon'] }}" class="align-self-center icon-xs"></i>
                                        </div>
                                        {{-- <i class="las la-user bg-soft-{{ $notification->data['color_icon'] }}"></i> --}}
                                    </div>
                                    <div class="activity-info-text">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="mb-0 font-13"><span style="font-weight: bold">{{ $notification->data['title'] }}</span> <br>
                                                {{ $notification->data['message'] }}
                                            </p>
                                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                        Notifikasi tidak ada
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('public/assets/js/app.js') }}"></script>
@endsection
