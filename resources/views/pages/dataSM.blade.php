@extends('layouts.app')

@section('content_header')

@stop

@section('content')
@section('plugins.Datatables', true)
@section('plugins.Toastr', true)
<div class="container">
    <div class="col-md-12">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h4 class="card-title">Data Surat Masuk</h4>
                <a class="btn btn-outline-primary float-right" href="{{URL::to('suratmasuk/create')}}">Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover display table-sm" id="surat-masuk">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>NA.</th>
                                <th>Asal Surat</th>
                                <th>Perihal</th>
                                <th>Nomor | Tanggal</th>
                                <th>Tanggal Terima</th>
                                <th class="notexport">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sm as $r)
                            <tr onClick="window.location.href='{{URL::to('suratmasuk/'.$r->id)}}'">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $r->nomor_agenda }}</td>
                                <td>{{ $r->asal_surat }}</td>
                                <td>{{ $r->perihal }}</td>
                                <td>{{ $r->nomor() .' | '. \Carbon\Carbon::parse($r->tanggal())->isoFormat('D-MMMM-Y')}}</td>
                                <td>{{ \Carbon\Carbon::parse($r->tanggal_terima)->isoFormat('D-MMMM-Y') }}</td>
                                <td>
                                    <div class="input-group">
                                        @if(count($r->berkas) == 0)
                                        <i class="fa fa-file" aria-hidden="true" style="color:red;"></i>&nbsp;
                                        @else
                                        <span class="badge badge-success">{{ count($r->berkas) }}</span>&nbsp;
                                        @endif
                                        @if($r->tindak_lanjut == 'Belum Proses')
                                        <i class="fa fa-window-close" aria-hidden="true" style="color:red;"></i>
                                        @elseif($r->tindak_lanjut == 'Proses')
                                        <i class="fa fa-check-square" aria-hidden="true" style="color:green;"></i>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<!-- /.card -->

@endsection

@section('adminlte_js')
{!! Toastr::message() !!}

<script>
    $(function() {
        $("#surat-masuk").DataTable({
            language: {
                search: 'Cari:',
                previous: 'Cari:',
                lengthMenu: 'Tampilkan _MENU_ baris',
                zeroRecords: 'Data Tidak Ditemukan',
                info: 'Total data _MAX_',
                infoEmpty: 'Data Kosong',
                infoFiltered: '(filtered from _MAX_ total records)'
            },
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excel',
                text: 'Export',
                exportOptions: {
                    columns: ':not(.notexport)'
                }
            }]
        });
    });
</script>
@endsection