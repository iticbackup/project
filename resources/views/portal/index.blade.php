<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php $asset = asset('public/portal/'); ?>
    <title>Portal - PT Indonesian Tobacco Tbk.</title>
    <link rel="stylesheet" href="{{ $asset }}/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ $asset }}/assets/plugins/bootstrap/css/bootstrap-select.min.css">
    <link href="{{ $asset }}/assets/plugins/icons/css/icons.css" rel="stylesheet">
    <link href="{{ $asset }}/assets/plugins/animate/animate.css" rel="stylesheet">
    <link href="{{ $asset }}/assets/plugins/bootstrap/css/bootsnav.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ $asset }}/assets/plugins/nice-select/css/nice-select.css">
    <link href="{{ $asset }}/assets/plugins/aos-master/aos.css" rel="stylesheet">
    <link href="{{ $asset }}/assets/css/style.css" rel="stylesheet">
    <link href="{{ $asset }}/assets/css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap" rel="stylesheet">
    <style>
        @media only screen and (max-width: 800px) {
            .login {
                display: block
            }

            .button-login {
                background-color: #d6d124;
                color: white;
                padding: 2.5%;
                margin-bottom: 5%
            }
        }

        @media only screen and (min-width: 800px) {
            .login {
                visibility: hidden;
            }
        }
    </style>
</head>

<body class="utf_skin_area">
    {{-- <div class="page_preloader"></div> --}}

    <nav class="navbar navbar-default navbar-mobile navbar-fixed white no-background bootsnav">
        <div class="container">
            <div class="navbar-header">
                {{-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"> <i
                        class="fa fa-bars"></i> </button> --}}
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ URL::asset('public/itic/icon_itic.png') }}" class="logo logo-display" alt=""
                        width="30">
                    <img src="{{ URL::asset('public/itic/icon_itic.png') }}" class="logo logo-scrolled" alt=""
                        width="30">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-menu">
                @auth
                    <ul class="nav navbar-nav navbar-right">
                        <li class="br-right"><a href="{{ route('home') }}" class="btn-signup red-btn">
                            <i class="fa fa-user-o"></i> {{ auth()->user()->name }} - {{ auth()->user()->role->roles }}</a>
                        </li>
                    </ul>
                @else
                    <ul class="nav navbar-nav navbar-right">
                        <li class="br-right"><a class="btn-signup red-btn" href="{{ route('login') }}"><i
                                    class="fa fa-user-o"></i> Login</a></li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>
    <div class="utf_main_banner_area" style="background-image:url({{ asset('public/portal/assets/images/T.JPG') }});"
        data-overlay="8">
        <div class="container">
            <div class="col-md-12 col-sm-12">
                <div class="caption cl-white home_two_slid">
                    <h2>PORTAL <br> <span
                            style="color: #d6d124; background: rgba(214, 209, 36, 0.2); border-radius: 4px">PT
                            Indonesian Tobacco Tbk.</span></h2>
                </div>
            </div>
        </div>
    </div>
    <section class="padd-top-80">
        <div class="container">
            <div class="tab-content">
                <div class="tab-pane fade in show active" id="recent" role="tabpanel">
                    @auth
                    @else
                        <div class="login text-center button-login">
                            <a class="btn-signup red-btn" href="{{ route('login') }}"><span style="color: black"><i
                                        class="fa fa-user-o"></i> LOGIN</span></a>
                        </div>
                    @endauth
                    <div class="row">
                        @foreach ($portals as $portal)
                            <div class="col-md-3 col-sm-6">
                                <div class="utf_grid_job_widget_area">
                                        <div class="u-content">
                                            <div class="avatar box-80"> <a href="{{ $portal['link'] }}"> <img
                                                        class="img-responsive" src="{{ $portal['images'] }}"
                                                        alt=""> </a> </div>
                                            <h5><a href="{{ $portal['link'] }}">{{ $portal['title'] }}</a></h5>
                                        </div>

                                        <div class="utf_apply_job_btn_item"> <a href="{{ $portal['link'] }}"
                                                class="btn job-browse-btn btn-radius br-light">Kunjungi</a> </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script src="{{ $asset }}/assets/js/jquery.min.js"></script>
    <script src="{{ $asset }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ $asset }}/assets/plugins/bootstrap/js/bootsnav.js"></script>
    <script src="{{ $asset }}/assets/js/viewportchecker.js"></script>
    <script src="{{ $asset }}/assets/js/slick.js"></script>
    <script src="{{ $asset }}/assets/plugins/bootstrap/js/wysihtml5-0.3.0.js"></script>
    <script src="{{ $asset }}/assets/plugins/bootstrap/js/bootstrap-wysihtml5.js"></script>
    <script src="{{ $asset }}/assets/plugins/aos-master/aos.js"></script>
    <script src="{{ $asset }}/assets/plugins/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="{{ $asset }}/assets/js/custom.js"></script>
    {{-- <script>
        $(window).load(function() {
            $(".page_preloader").fadeOut("slow");;
        });
        AOS.init();
    </script> --}}
</body>

</html>
