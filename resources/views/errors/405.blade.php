@extends('errors::minimal')

@section('title', __('error.http.405.title'))
@section('code', '405')
@section('message', __($exception->getMessage() ?: __('error.http.405.message')))
