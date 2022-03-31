@extends('errors::minimal')

@section('title', __('error.http.404.title'))
@section('code', '404')
@section('message', __($exception->getMessage() ?: __('error.http.404.message')))
