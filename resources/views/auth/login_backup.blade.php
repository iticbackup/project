<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('authentication/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('authentication/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('authentication/css/login.css') }}">
</head>
<body>
  <main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          <div class="brand-wrapper">
            <img src="{{ asset('itic/logo_itic.png') }}" alt="logo" class="logo">
          </div>
          <div class="login-wrapper my-auto">
            <h1 class="login-title">Log in</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="email" class="form-control" placeholder="Username">
              </div>
              <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="enter your passsword">
              </div>
              <input class="btn btn-block login-btn" type="submit" value="Login">
            </form>
            {{-- <a href="#!" class="forgot-password-link">Forgot password?</a>
            <p class="login-wrapper-footer-text">Don't have an account? <a href="#!" class="text-reset">Register here</a></p> --}}
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="{{ asset('itic/kantor.webp') }}" alt="login image" class="login-img">
          {{-- <p class="text-white font-weight-medium text-center flex-grow align-self-end footer-link">
            Free <a href="https://www.bootstrapdash.com/" target="_blank" class="text-white">Bootstrap dashboard templates</a> from Bootstrapdash
          </p> --}}
        </div>
      </div>
    </div>
  </main>
  <script src="{{ asset('authentication/js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('authentication/js/popper.min.js') }}"></script>
  <script src="{{ asset('authentication/js/bootstrap.min.js') }}"></script>
</body>
</html>
