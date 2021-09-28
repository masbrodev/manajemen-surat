@extends('layouts.app')

@section('content_header')
<h1></h1>
@stop

@section('content')
@section('plugins.Datatables', true)
@section('plugins.Toastr', true)
<div class="container">
    <div class="col-md-12">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">Surat Keluar</h3>

                <div class="card-tools">
                    <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Previous"><i class="fas fa-chevron-left"></i></a>
                    <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Next"><i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="mailbox-read-info">
                    <table>
                        <tr>
                            <td>
                                <h5>Perihal </h5>
                            </td>
                            <td>
                                <h5>: {{ $sk->perihal }}</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Nomor Surat</h6>
                            </td>
                            <td>
                                <h6>: {{ $sk->nomor_surat }} </h6>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Nomor Agenda </h6>
                            </td>
                            <td>
                                <h6>: {{ $sk->nomor_agenda  }}</h6>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Tindak Lanjut </h6>
                            </td>
                            <td>
                                <h6>: {{ $sk->tindak_lanjut  }}</h6>
                            </td>
                        </tr>
                    </table>
                    <h6>
                        <span class="mailbox-read-time float-right"> {{ \Carbon\Carbon::parse($sk->tanggal_terima)->isoFormat('D - MMMM - Y') }}</span>
                    </h6>
                </div>
                <!-- /.mailbox-read-info -->
                <div class="mailbox-controls with-border text-center">
                    <h4 class="text-center text-bold"><ins> Asal Surat : {{ $sk->tujuan_surat  }}</ins></h4>
                </div>
                <!-- /.mailbox-controls -->

                <!-- BUG LEFT-NAVBAR-FOOTER -->
                <div class="mailbox-read-message">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="text-center">@if(count($berkas) == 0) Berkas Tidak Ada @else Berkas @endif</h4>
                                    <hr>
                                    <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                                        @foreach($berkas as $b)
                                        <li>
                                            <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>

                                            <div class="mailbox-attachment-info">
                                                <a href="{{URL::to( 'berkas/surat_keluar/' . $b->lokasi .'/'. $b->nama_berkas)}}" target="_blank" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i>{{ Str::of($b->nama_berkas)->afterLast('_ks_')}}</a>
                                                <span class="mailbox-attachment-size clearfix mt-1">
                                                    <span>file PDF </span>
                                                    <a href="{{URL::to( 'berkas/surat_keluar/' . $b->lokasi .'/'. $b->nama_berkas)}}" download="{{ Str::of($b->nama_berkas)->afterLast('_ks_')}}" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                                                </span>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">

                                    <h4 class="text-center">Keterangan</h4>
                                    <hr>
                                    <div class="form-group">
                                        <p>Keterangan : {{ $sk->keterangan1 }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">

                                    <h4 class="text-center">Tindak Lanjut Staf</h4>
                                    <hr>
                                    <div class="form-group">
                                        <p>Tindak Lanjut Staf : {{ $sk->tls }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.mailbox-read-message -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="float-right">
                        <a class="btn btn-default" href="{{ URL::to('suratkeluar/'.$sk->id.'/edit') }}"><i class="fa fa-cog"></i> Edit</a>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#hapus"><i class="far fa-trash-alt"></i> Hapus</button>
                    </div>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
<!-- /.row -->

<div class="modal fade" id="hapus">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Data Surat Masuk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Apakah Anda Yakin Menghapus Data Ini ?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="btnclose" data-dismiss="modal">Close</button>
                <form action="{{ URL::route('suratkeluar.destroy', $sk->id) }}" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-outline-danger float-sm-left">Hapus</button>
                    <!-- <button>Delete User</button> -->
                    <!-- <a href="{{ URL::to('suratmasuk//'.$sk->id) }}" class="btn btn-outline-danger float-sm-left">Hapus</a> -->
                </form>
            </div>
        </div>

    </div>
    <!-- /.modal-content -->
</div>

@endsection

@section('adminlte_js')

{!! Toastr::message() !!}

<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const success = urlParams.get('success')

    if (success == 'update') {
        toastr.success('Berhasil memperbarui data');
        var newURL = location.href.split("?")[0];
        window.history.pushState('object', document.title, newURL);
    } else if (success == 'add') {
        toastr.success('Berhasil menambah data');
        var newURL = location.href.split("?")[0];
        window.history.pushState('object', document.title, newURL);
    }
</script>
@endsection