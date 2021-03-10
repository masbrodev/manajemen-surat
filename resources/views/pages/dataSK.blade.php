@extends('layouts.app')

@section('content_header')
<h1>Kategori</h1>
@stop

@section('content')
@section('plugins.Datatables', true)
@section('plugins.Toastr', true)


@endsection

@section('adminlte_js')
<script>
    $(function() {
        $("#table-kategori").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>
@endsection