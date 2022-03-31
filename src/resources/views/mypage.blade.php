{{-- TemplateSample --}}
@extends('layouts.app')
@section('title','マイページ')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 justify-content-center">
      <div class="card">
        <div class="card-header">@yield('title')</div>

        <div class="card-body">
          <div class="row mb-2">
            <div class="col-md-2">ユーザ名</div>
            <div class="col-md-10">{{ auth()->user()->name }}</div>
          </div>

          <div class="row mb-2">
            <div class="col-md-2">Email</div>
            <div class="col-md-10">{{ auth()->user()->email }}</div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>
@endsection
