
@if (!empty(session('success')))
<div class="row">
  <div class="col-md-11">
    <div class="row alert alert-success">
      <div class="col-md-11">
        Success! </strong> {{ session('success') }}
      </div>
      <div class="col-md-1">
        <a href="" class="btn btn-outline-light btn-sm"><strong></strong>X</a>
      </div>
    </div>
  </div>
</div>
@endif


@if (!empty(session('error')))
<div class="row">
  <div class="col-md-11">
    <div class="row alert alert-danger">
      <div class="col-md-11">
        Error! </strong> {{ session('error') }}
      </div>
      <div class="col-md-1">
        <a href="" class="btn btn-outline-light btn-sm"><strong></strong>X</a>
      </div>
    </div>
  </div>
</div>
@endif

@if (!empty(session('info')))
<div class="row">
  <div class="col-md-11">
    <div class="row alert alert-info">
      <div class="col-md-11">
        Info! </strong> {{ session('info') }}
      </div>
      <div class="col-md-1">
        <a href="" class="btn btn-outline-light btn-sm"><strong></strong>X</a>
      </div>
    </div>
  </div>
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