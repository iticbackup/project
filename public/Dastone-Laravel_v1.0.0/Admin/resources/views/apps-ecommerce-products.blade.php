@extends('layouts.master')
@section('title') Dashboard @endsection

    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') Ecommerce @endslot
            @slot('li_3') Products @endslot
            @slot('title') Products @endslot
        @endcomponent

        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="ribbon1 rib1-primary">
                            <span class="text-white text-center rib1-primary">50% off</span>
                        </div><!--end ribbon-->
                        <img src="{{ URL::asset('assets/images/products/img-5.png') }}" alt="" class="d-block mx-auto my-4" height="150">
                        <div class="row my-4">
                            <div class="col">
                                <span class="badge badge-light mb-2">Life Style</span>
                                <a href="#" class="title-text d-block">Unique Blue Bag</a>
                            </div>
                            <div class="col-auto">
                                <h4 class="text-dark mt-0">$49.00 <small class="text-muted font-14"><del>$99.00</del></small></h4>
                                <ul class="list-inline mb-0 product-review align-self-center">
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star-half-o text-warning font-16 ms-n2"></i></li>
                                </ul>
                            </div>
                        </div>
                        <button class="btn btn-soft-primary w-100">Add To Cart</button>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="ribbon1 rib1-primary">
                            <span class="text-white text-center rib1-primary">50% off</span>
                        </div><!--end ribbon-->
                        <img src="{{ URL::asset('assets/images/products/img-2.png') }}" alt="" class="d-block mx-auto my-4" height="150">
                        <div class="row my-4">
                            <div class="col">
                                <span class="badge badge-light mb-2">Fashion</span>
                                <a href="#" class="title-text d-block">Unique Black Watch</a>
                            </div>
                            <div class="col-auto">
                                <h4 class="text-dark mt-0">$999.00 <small class="text-muted font-14"><del>$1999.00</del></small></h4>
                                <ul class="list-inline mb-0 product-review align-self-center">
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star-half-o text-warning font-16 ms-n2"></i></li>
                                </ul>
                            </div>
                        </div>
                        <button class="btn btn-soft-primary w-100">Add To Cart</button>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="ribbon1 rib1-primary">
                            <span class="text-white text-center rib1-primary">50% off</span>
                        </div><!--end ribbon-->
                        <img src="{{ URL::asset('assets/images/products/img-3.png') }}" alt="" class="d-block mx-auto my-4" height="150">
                        <div class="row my-4">
                            <div class="col">
                                <span class="badge badge-light mb-2">Footwear</span>
                                <a href="#" class="title-text d-block">Reebok Shoes</a>
                            </div>
                            <div class="col-auto">
                                <h4 class="text-dark mt-0">$39.00 <small class="text-muted font-14"><del>$99.00</del></small></h4>
                                <ul class="list-inline mb-0 product-review align-self-center">
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star-half-o text-warning font-16 ms-n2"></i></li>
                                </ul>
                            </div>
                        </div>
                        <button class="btn btn-soft-primary w-100">Add To Cart</button>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="ribbon1 rib1-primary">
                            <span class="text-white text-center rib1-primary">50% off</span>
                        </div><!--end ribbon-->
                        <img src="{{ URL::asset('assets/images/products/img-4.png') }}" alt="" class="d-block mx-auto my-4" height="150">
                        <div class="row my-4">
                            <div class="col">
                                <span class="badge badge-light mb-2">Life Style</span>
                                <a href="#" class="title-text d-block">Unique Ladies Purse</a>
                            </div>
                            <div class="col-auto">
                                <h4 class="text-dark mt-0">$49.00 <small class="text-muted font-14"><del>$99.00</del></small></h4>
                                <ul class="list-inline mb-0 product-review align-self-center">
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star-half-o text-warning font-16 ms-n2"></i></li>
                                </ul>
                            </div>
                        </div>
                        <button class="btn btn-soft-primary w-100">Add To Cart</button>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="ribbon4 rib4-secondary">
                            <span class="ribbon4-band ribbon4-band-secondary text-white text-center">50% off</span>
                        </div><!--end ribbon-->
                        <img src="{{ URL::asset('assets/images/products/img-6.png') }}" alt="" class="d-block mx-auto my-4" height="150">
                        <div class="row my-4">
                            <div class="col">
                                <span class="badge badge-light mb-2">Fashion</span>
                                <a href="#" class="title-text d-block">Ladies Top</a>
                            </div>
                            <div class="col-auto">
                                <h4 class="text-dark mt-0">$69.00 <small class="text-muted font-14"><del>$99.00</del></small></h4>
                                <ul class="list-inline mb-0 product-review align-self-center">
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star-half-o text-warning font-16 ms-n2"></i></li>
                                </ul>
                            </div>
                        </div>
                        <button class="btn btn-soft-primary w-100">Add To Cart</button>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="ribbon4 rib4-secondary">
                            <span class="ribbon4-band ribbon4-band-secondary text-white text-center">50% off</span>
                        </div><!--end ribbon-->
                        <img src="{{ URL::asset('assets/images/products/img-1.png') }}" alt="" class="d-block mx-auto my-4" height="150">
                        <div class="row my-4">
                            <div class="col">
                                <span class="badge badge-light mb-2">Footwear</span>
                                <a href="#" class="title-text d-block">New White Shoes</a>
                            </div>
                            <div class="col-auto">
                                <h4 class="text-dark mt-0">$120.00 <small class="text-muted font-14"><del>$249.00</del></small></h4>
                                <ul class="list-inline mb-0 product-review align-self-center">
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star-half-o text-warning font-16 ms-n2"></i></li>
                                </ul>
                            </div>
                        </div>
                        <button class="btn btn-soft-primary w-100">Add To Cart</button>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="ribbon4 rib4-secondary">
                            <span class="ribbon4-band ribbon4-band-secondary text-white text-center">50% off</span>
                        </div><!--end ribbon-->
                        <img src="{{ URL::asset('assets/images/products/img-7.png') }}" alt="" class="d-block mx-auto my-4" height="150">
                        <div class="row my-4">
                            <div class="col">
                                <span class="badge badge-light mb-2">Life Style</span>
                                <a href="#" class="title-text d-block">Unique Silver Watch</a>
                            </div>
                            <div class="col-auto">
                                <h4 class="text-dark mt-0">$20.00 <small class="text-muted font-14"><del>$49.00</del></small></h4>
                                <ul class="list-inline mb-0 product-review align-self-center">
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star-half-o text-warning font-16 ms-n2"></i></li>
                                </ul>
                            </div>
                        </div>
                        <button class="btn btn-soft-primary w-100">Add To Cart</button>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="ribbon4 rib4-secondary">
                            <span class="ribbon4-band ribbon4-band-secondary text-white text-center">50% off</span>
                        </div><!--end ribbon-->
                        <img src="{{ URL::asset('assets/images/products/img-8.png') }}" alt="" class="d-block mx-auto my-4" height="150">
                        <div class="row my-4">
                            <div class="col">
                                <span class="badge badge-light mb-2">Interior</span>
                                <a href="#" class="title-text d-block">Night Lamp</a>
                            </div>
                            <div class="col-auto">
                                <h4 class="text-dark mt-0">$69.00 <small class="text-muted font-14"><del>$99.00</del></small></h4>
                                <ul class="list-inline mb-0 product-review align-self-center">
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star text-warning font-16 ms-n2"></i></li>
                                    <li class="list-inline-item"><i class="la la-star-half-o text-warning font-16 ms-n2"></i></li>
                                </ul>
                            </div>
                        </div>
                        <button class="btn btn-soft-primary w-100">Add To Cart</button>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
