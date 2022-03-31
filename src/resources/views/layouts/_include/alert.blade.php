@if(session()->has('alert'))
<div class="alert alert-{{ session('alert.status') }}" role="alert">
  {{ session('alert.message') }}
</div>
@endif
