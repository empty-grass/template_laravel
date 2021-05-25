{{-- TemplateSample --}}
@inject('UserConst', 'App\Consts\UserConst')
@extends('layouts.app')
@section('title','ユーザ登録')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      @include('layouts._include.alert')
      <div class="card">
        <div class="card-header">@yield('title')</div>
        <div class="card-body">
          <p>※パスワードはランダムに生成されるため、登録後はパスワードリマインダ機能から再設定をお願いします。</p>
          <form method="POST" action="{{ route('admin.user.store') }}">
            @csrf

            <!-- name -->
            <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">ユーザ名</label>
              <div class="col-md-3">
                  <input
                    id="name"
                    type="name"
                    class="form-control @error('name') is-invalid @enderror"
                    name="name"
                    value="{{ old('name') }}"
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
                  class="form-control @error('email') is-invalid @enderror"
                  name="email"
                  value="{{ old('email') }}"
                >
                @component('comps.error', ['input' => 'email'])
                @endcomponent
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  ユーザ新規登録
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
