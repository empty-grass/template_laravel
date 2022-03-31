{{-- TemplateSample --}}
@inject('UserConst', 'App\Consts\UserConst')
@extends('layouts.modal', [
  'modal_id' => $modal_id,
  'modal_title' => 'ユーザを削除'
])
@section('modal_body'.$modal_id)
本当にこのユーザを削除してよいですか？
@endsection
@section('modal_footer'.$modal_id)
<form method="POST" action="{{ route('admin.user.delete', $user->id) }}">
  @method('DELETE')
  @csrf
  <button type="submit" class="btn btn-primary">このユーザを削除する</button>
</form>
@endsection
