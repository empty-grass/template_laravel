@extends('errors::minimal')

@section('title', __('error.http.403.title'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: __('error.http.403.message')))
