@extends('adminlte::page')

@section('title', 'MS | KEMENDESA')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
@stop

@section('js')
{!! Toastr::message() !!}
@stop