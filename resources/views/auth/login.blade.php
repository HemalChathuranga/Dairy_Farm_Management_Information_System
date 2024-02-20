<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DFMIS | Log in</title>
	
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ url('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">

<!-- Section: Design Block -->
<section class=" text-center text-lg-start mt-5">
  <style>
    .rounded-t-5 {
      border-top-left-radius: 0.5rem;
      border-top-right-radius: 0.5rem;
    }

    @media (min-width: 992px) {
      .rounded-tr-lg-0 {
        border-top-right-radius: 0;
      }

      .rounded-bl-lg-5 {
        border-bottom-left-radius: 0.5rem;
      }
    }
  </style>
  <div class="card mb-3" style="margin-top: 10rem !important;">
    <div class="row g-0 d-flex align-items-center">
      <div class="col-lg-4 d-none d-lg-flex">
        <img src="{{ url('dist\img\logging_page.jpg') }}" alt="Logging_Image"
          class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
      </div>
      <div class="col-lg-8">
        <div class="card-body py-5 px-md-5">

          @include('message')

          <form action="{{ url('login') }}" method="post">
            @csrf
            <!-- User ID input -->
            <div class="form-outline mb-4">
              <input type="text" name="uid" id="uid" class="form-control" placeholder="User ID" required />
              <label class="form-label" for="uid">User ID</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" name="password" id="password" class="form-control" placeholder="Password" required />
              <label class="form-label" for="password">Password</label>
            </div>

            <div class="row mb-4">
              <div class="col d-flex justify-content-center">
                <!-- Checkbox -->
                <div class="form-check">
                  <input class="form-check-input" name="remember" type="checkbox" value="" id="remember" />
                  <label class="form-check-label" for="remember"> Remember me </label>
                </div>
              </div>
            </div>

            <!-- Submit button -->
            <input type="submit" class="btn btn-primary btn-block mb-4" value="Sign in">
          </form>

        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
