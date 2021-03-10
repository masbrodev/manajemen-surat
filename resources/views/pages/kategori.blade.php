@extends('layouts.app')

@section('content_header')
<h1>Kategori</h1>
@stop

@section('content')
@section('plugins.Datatables', true)
@section('plugins.Toastr', true)


@endsection

@push('scripts')
<script>
    $(function() {
        $("#table-kategori").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>
@endpush