<div>
{{--  Error message handling  --}}
  @if (session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
  @endif
{{--  Validation error handling  --}}
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
{{--  Success message handling  --}}
  @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif
{{--  Info message handling  --}}
  @if (session('warning'))
    <div class="alert alert-warning">
      {{ session('warning') }}
    </div>
  @endif


</div>
