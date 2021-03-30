@extends('layouts.app')

@section('content_header')

@stop

@section('content')
@section('plugins.Datatables', true)
@section('plugins.Toastr', true)
<div class="container">

</div>
<!-- /.card -->

@endsection

@section('adminlte_js')
{!! Toastr::message() !!}

@endsection