@extends('errors::minimal')

@section('title', __('error.http.503.title'))
@section('code', '503')
@section('message', $exception->getMessage())
