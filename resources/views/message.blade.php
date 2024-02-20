{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>Alerts</h2>
  <p>Alerts are created with the .alert class, followed by a contextual color classes:</p>

 --}}

@if (!empty(session('success')))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> {{ session('success') }}
  </div>
@endif

@if (!empty(session('error')))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> {{ session('error') }}
  </div>
@endif

@if (!empty(session('info')))
  <div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>Info!</strong> {{ session('info') }}
  </div>
@endif
{{-- 
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Warning!</strong> This alert box could indicate a warning that might need attention.
  </div>



  <div class="alert alert-primary alert-dismissible fade show" role="alert">
    <strong>Primary!</strong> Indicates an important action.
  </div>

  <div class="alert alert-secondary alert-dismissible fade show" role="alert">
    <strong>Secondary!</strong> Indicates a slightly less important action.
  </div>

  <div class="alert alert-dark alert-dismissible fade show" role="alert">
    <strong>Dark!</strong> Dark grey alert.
  </div>

  <div class="alert alert-light alert-dismissible fade show" role="alert">
    <strong>Light!</strong> Light grey alert.
  </div>


</div>

</body>
</html> --}}