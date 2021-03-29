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
                <h4 class="card-title">Data Surat Keluar</h4>
                <a class="btn btn-outline-primary float-right" href="{{URL::to('suratkeluar/create')}}">Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover display nowrap table-sm" id="surat-keluar">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Tujuan Surat</th>
                                <th>Perihal</th>
                                <th>Nomor Surat</th>
                                <th>Tanggal</th>
                                <th style="width: 200px">Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sk as $r)
                            <tr onClick="window.location.href='{{URL::to('suratkeluar/'.$r->id)}}'">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $r->tujuan_surat }}</td>
                                <td>{{ $r->perihal }}</td>
                                <td>{{ $r->nomor_surat}}</td>
                                <td>{{ \Carbon\Carbon::parse($r->tanggal_keluar)->isoFormat('D-MMMM-Y') }}</td>
                                <td>
                                    <div class="input-group">
                                        @if(count($r->berkas2) == 0)
                                        <i class="fa fa-file" aria-hidden="true" style="color:red;"></i>&nbsp;
                                        @else
                                        <span class="badge badge-success">{{ count($r->berkas2) }}</span>&nbsp;
                                        @endif
                                        @if($r->tindak_lanjut == 'Belum Tuntas')
                                        <i class="fa fa-window-close" aria-hidden="true" style="color:red;"></i>
                                        @elseif($r->tindak_lanjut == 'Tuntas')
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
        $("#surat-keluar").DataTable({
            language: {
                search: 'Cari:',
                previous: 'Cari:',
                lengthMenu: 'Tampilkan _MENU_ baris',
                zeroRecords: 'Data Tidak Ditemukan',
                info: 'Total data _MAX_',
                infoEmpty: 'Data Kosong',
                infoFiltered: '(filtered from _MAX_ total records)'
            },
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>
@endsection