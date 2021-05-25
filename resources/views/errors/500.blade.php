@extends('errors::minimal')

@section('title', __('error.http.500.title'))
@section('code', '500')
@section('message', __($exception->getMessage() ?: __('error.http.500.message')))
