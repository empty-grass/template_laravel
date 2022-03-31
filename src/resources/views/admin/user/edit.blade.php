{{-- TemplateSample --}}
@inject('UserConst', 'App\Consts\UserConst')
@extends('layouts.app')
@section('title','ユーザ詳細')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      @include('layouts._include.alert')
      <div class="card">
        <div class="card-header">@yield('title')</div>
        <div class="card-body">
          <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
            @method('PUT')
            @csrf

            <!-- name -->
            <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">ユーザ名</label>
              <div class="col-md-3">
                  <input
                    id="name"
                    type="name"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $user->name) }}"
                  >
                  @component('comps.error', ['input' => 'name'])
                  @endcomponent
              </div>
            </div>

            <!-- email -->
            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
              <div class="col-md-4">
                <input
                  id="email"
                  type="email"
                  name="email"
                  class="form-control @error('email') is-invalid @enderror"
                  value="{{ old('email', $user->email) }}"
                >
                @component('comps.error', ['input' => 'email'])
                @endcomponent
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  更新
                </button>
              </div>
            </div>
          </form>

          <div class="row">
            <div class="col-md-3">
                <button class="btn btn-warning" data-toggle="modal" data-target="#deleteModal">このユーザをログイン不可にする</button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@include('admin.user._include.delete_modal', ['modal_id' => 'deleteModal'])

@endsection
