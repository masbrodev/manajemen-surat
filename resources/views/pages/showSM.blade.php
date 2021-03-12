@extends('layouts.app')

@section('content_header')
<h1></h1>
@stop

@section('content')
@section('plugins.Datatables', true)
@section('plugins.Toastr', true)

<div class="col-md-9">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Surat Masuk</h3>

            <div class="card-tools">
                <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Previous"><i class="fas fa-chevron-left"></i></a>
                <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Next"><i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="mailbox-read-info">
                <h5>Perihal: {{ $sm->perihal }}</h5>
                <h6>Nomor Surat: {{ $sm->nomor_surat  }} <br>
                    Asal Surat: {{ $sm->asal_surat  }}
                    <span class="mailbox-read-time float-right"> {{ \Carbon\Carbon::parse($sm->tanggal_terima)->isoFormat('D - MMMM - Y') }}</span>
                </h6>
            </div>
            <!-- /.mailbox-read-info -->
            <div class="mailbox-controls with-border text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
                        <i class="far fa-trash-alt"></i></button>
                    <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
                        <i class="fas fa-reply"></i></button>
                    <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Forward">
                        <i class="fas fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                    <i class="fas fa-print"></i></button>
            </div>
            <!-- /.mailbox-controls -->
            <div class="mailbox-read-message">
                <p>ISI DISPOSISI KABAG : {{ $sm->idk }}</p>
                <p>Lajur Disposisi : {{ $sm->lajur_disposisi }}</p>
                <p>Keterangan : {{ $sm->keterangan }}</p>

            </div>
            <!-- /.mailbox-read-message -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer bg-white">
            <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                @foreach($berkas as $b)
                <li>
                    <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>

                    <div class="mailbox-attachment-info">
                        <a href=" {{URL::to( 'berkas/' . $b->lokasi .'/'. $b->nama_berkas)}}" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i>{{ Str::of($b->nama_berkas)->afterLast('_ks_')}}</a>
                        <span class="mailbox-attachment-size clearfix mt-1">
                            <span>file PDF </span>
                            <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                        </span>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <!-- /.card-footer -->
        <div class="card-footer">
            <div class="float-right">
                <button type="button" class="btn btn-default"><i class="fas fa-reply"></i> Reply</button>
                <button type="button" class="btn btn-default"><i class="fas fa-share"></i> Forward</button>
            </div>
            <button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</button>
            <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->
</div>
<!-- /.row -->

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