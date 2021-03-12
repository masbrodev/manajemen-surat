@extends('layouts.app')

@section('content_header')
<h1>Data Surat Masuk</h1>
@stop

@section('content')
@section('plugins.Datatables', true)
@section('plugins.Toastr', true)
<div class="container">
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="table-responsive">
                <table class="table table-bordered" id="surat-masuk">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Asal Surat</th>
                            <th>Perihal</th>
                            <th>Nomor Surat</th>
                            <th>Tanggal Terima</th>
                            <th style="width: 200px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sm as $r)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $r->asal_surat }}</td>
                            <td>{{ $r->perihal }}</td>
                            <td>{{ $r->nomor_surat }}</td>
                            <td>{{ $r->tanggal_terima }}</td>
                            <td>
                                <div class="input-group">
                                    <a class="btn btn-outline-secondary" href="{{URL::to('suratmasuk/'.$r->id)}}">lihat</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<!-- /.card -->

@endsection

@section('adminlte_js')
<script>
    $(function() {
        $("#surat-masuk").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>
@endsection