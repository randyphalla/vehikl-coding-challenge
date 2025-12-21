@extends('errors::minimal')

@section('title', __('404 - '.$exception->getMessage()))
@section('code', '404')
@section('message', __($exception->getMessage()))
