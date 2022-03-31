{{-- TemplateSample --}}
@inject('UserConst', 'App\Consts\UserConst')
@inject('session', 'App\Sessions\AdminUserSearchSession')
@extends('layouts.app')
@section('title','ユーザ一覧')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      @include('layouts._include.alert')

      <div class="card">
        <div class="card-header">@yield('title')</div>
        <div class="card-body">
          <div class="col-md-12">
            <form method="POST" action="{{ route('admin.user.filter') }}">
              @csrf

              <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label text-md-right">ユーザ名</label>
                <div class="col-md-4">
                  <input
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $session->get('name')) }}"
                  >

                </div>
              </div>

              <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label text-md-right">Email</label>
                <div class="col-md-4">
                  <input
                    type="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $session->get('email')) }}"
                  >
                  @component('comps.error', ['input' => 'email'])
                  @endcomponent
                </div>
                <div class="col-md-2">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" name="submit_kind" class="btn btn-primary">検索</button>
                </div>
              </div>

            </form>
          </div>
          <a href="{{ route('admin.user.create') }}" class="btn btn-success mb-2 float-right">ユーザ登録</a>
          @if($users->isEmpty())
          <span>検索結果は0件です。</span>
          @else

          {{ $users->links() }}

          <table class="table">
            <tr>
              <th>ユーザ名</th>
              <th>Email</th>
            </tr>
            @foreach($users as $user)
            <tr>
              <td>
                <a href="{{ route('admin.user.edit', $user->id) }}">{{ $user->name }}</a>
                @if($user->id === auth()->id())(Me)@endif
              </td>
              <td>{{ $user->email }}</td>
            </tr>
              @endforeach
          </table>
          @endempty
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
