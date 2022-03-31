@extends('errors::minimal')

@section('title', __('error.http.501.title'))
@section('code', '501')
@section('message', __($exception->getMessage() ?: __('error.http.501.message')))
