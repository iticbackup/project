@extends('layouts.master')
@section('title') Dashboard @endsection

    @section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dastone @endslot
            @slot('li_2') Ecommerce @endslot
            @slot('li_3') Detail @endslot
            @slot('title') Procuct Detail @endslot
        @endcomponent

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 align-self-center">
                                    <img src="{{ URL::asset('assets/images/products/04.png') }}" alt="" class=" mx-auto  d-block" height="300">
                                </div><!--end col-->
                                <div class="col-lg-6 align-self-center">
                                    <div class="single-pro-detail">
                                        <p class="mb-1">Dastone</p>
                                        <div class="custom-border mb-3"></div>
                                        <h3 class="pro-title">Dastone Mask - 101</h3>
                                        <p class="text-muted mb-0">Morden and good look model 2020</p>
                                        <ul class="list-inline mb-2 product-review">
                                            <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                            <li class="list-inline-item"><i class="mdi mdi-star-half text-warning"></i></li>
                                            <li class="list-inline-item">4.5 (9830 reviews)</li>
                                        </ul>
                                        <h2 class="pro-price">$49.00 <span><del>$100.00</del></span><span class="text-danger fw-bold ms-2">50% Off</span></h2>
                                        <h6 class="text-muted font-13">Features :</h6>
                                        <ul class="list-unstyled pro-features border-0">
                                            <li>It is a long established fact that a reader will be distracted.</li>
                                            <li>Contrary to popular belief, Lorem Ipsum is not text. </li>
                                        </ul>
                                        <h6 class="text-muted font-13 d-inline-block align-middle me-2">Color :</h6>
                                        <div class="radio2 radio-info2 form-check-inline ms-2">
                                            <input type="radio" id="inlineRadio1" value="option1" name="radioInline" checked="">
                                            <label for="inlineRadio1"></label>
                                        </div>
                                        <div class="radio2 radio-dark2 form-check-inline">
                                            <input type="radio" id="inlineRadio2" value="option2" name="radioInline">
                                            <label for="inlineRadio2"></label>
                                        </div>
                                        <div class="quantity mt-3 ">
                                            <input class="form-control form-control-sm" type="number" min="0" value="0" id="example-number-input">
                                            <a href="" class="btn btn-primary btn-sm text-white px-4 d-inline-block"><i class="mdi mdi-cart me-2"></i>Add to Cart</a>
                                        </div>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <i data-feather="truck" class="align-self-center"></i>
                            <h4 class="font-15 text-dark">Fast Delivery</h4>
                            <p class="text-muted mb-0">
                                It is a long established fact that a reader will be distracted.
                                Contrary to popular belief.
                            </p>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <i data-feather="rotate-cw" class="align-self-center"></i>
                            <h4 class="font-15 text-dark">Returns in 30 Days</h4>
                            <p class="text-muted mb-0">
                                It is a long established fact that a reader will be distracted.
                                Contrary to popular belief.
                            </p>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <i data-feather="headphones" class="align-self-center"></i>
                            <h4 class="font-15 text-dark">Online Support 24/7</h4>
                            <p class="text-muted mb-0">
                                It is a long established fact that a reader will be distracted.
                                Contrary to popular belief.
                            </p>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <i data-feather="dollar-sign" class="align-self-center"></i>
                            <h4 class="font-15 text-dark">Secure Payment</h4>
                            <p class="text-muted mb-0">
                                It is a long established fact that a reader will be distracted.
                                Contrary to popular belief.
                            </p>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="ribbon1 rib1-primary">
                                <span class="text-white text-center rib1-primary">50% off</span>
                            </div><!--end ribbon-->
                            <img src="{{ URL::asset('assets/images/products/01.png') }}" alt="" class="d-block mx-auto my-4" height="150">
                            <div class="row my-4">
                                <div class="col">
                                    <span class="badge badge-light mb-2">Security</span>
                                    <a href="#" class="title-text d-block">Unique Desk Camera</a>
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
                            <div class="ribbon4 rib4-secondary">
                                <span class="ribbon4-band ribbon4-band-secondary text-white text-center">50% off</span>
                            </div><!--end ribbon-->
                            <img src="{{ URL::asset('assets/images/products/06.png') }}" alt="" class="d-block mx-auto my-4" height="150">
                            <div class="row my-4">
                                <div class="col">
                                    <span class="badge badge-light mb-2">Fashion</span>
                                    <a href="#" class="title-text d-block">Sport Bag</a>
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
                            <div class="ribbon1 rib1-primary">
                                <span class="text-white text-center rib1-primary">50% off</span>
                            </div><!--end ribbon-->
                            <img src="{{ URL::asset('assets/images/products/05.png') }}" alt="" class="d-block mx-auto my-4" height="150">
                            <div class="row my-4">
                                <div class="col">
                                    <span class="badge badge-light mb-2">Health</span>
                                    <a href="#" class="title-text d-block">Fever Gun</a>
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
            </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
