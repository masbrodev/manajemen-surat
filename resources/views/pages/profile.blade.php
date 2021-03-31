@extends('layouts.app')

@section('content_header')

@stop

@section('content')
@section('plugins.Datatables', true)
@section('plugins.Toastr', true)
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Profil</h3>
                </div>
                <div class="card-body">
                    <form id="form-tambah" action="javascript:$.LoadingOverlay('show');">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" id="konseptor" name="konseptor" value="{{ Auth::user()->name }}" disabled>
                                    <br>
                                </div>
                                <div class="col-sm-12">
                                    <label>Email</label>
                                    <input type="text" class="form-control" id="konseptor" name="konseptor" value="{{ Auth::user()->email }}" disabled>
                                    <br>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-default float-sm-right" data-toggle="modal" data-target="#gp"><i class="fa fa-key"></i> Ganti Password</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.card -->

<div class="modal fade" id="gp">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ganti Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('profil.update', Auth::user()->id ) }}" method="POST">
                <div class="modal-body">
                    <label>Masukkan Password</label>
                    <input type="password" class="form-control" id="ps" name="ps">
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-outline-success float-sm-left">Simpan</button>
                </div>
            </form>
        </div>

    </div>
    <!-- /.modal-content -->
</div>

@endsection

@section('adminlte_js')
{!! Toastr::message() !!}

@endsection