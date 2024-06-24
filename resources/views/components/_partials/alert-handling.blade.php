<div>

{{--  Error message handling  --}}
  @if (session('error'))
    @if (isset($br))
      <br>
    @endif
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
  @endif
{{--  Validation error handling  --}}
  @if ($errors->any())
    @if (isset($br))
      <br>
    @endif
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
    @if (isset($br))
      <br>
    @endif
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif
{{--  Info message handling  --}}
  @if (session('warning'))
    @if (isset($br))
      <br>
    @endif
    <div class="alert alert-warning">
      {{ session('warning') }}
    </div>
  @endif


</div>
