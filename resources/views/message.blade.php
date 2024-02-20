
@if (!empty(session('success')))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <a href=""><strong>X</strong></a><strong>  Success!</strong> {{ session('success') }}
  </div>
@endif

@if (!empty(session('error')))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <a href=""><strong>X</strong></a><strong>  Error!</strong> {{ session('error') }}
  </div>
@endif

@if (!empty(session('info')))
  <div class="alert alert-info alert-dismissible fade show" role="alert">
    <a href=""><strong>X</strong></a><strong>  Info!</strong> {{ session('info') }}
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