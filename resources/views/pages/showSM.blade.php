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
                <h3 class="card-title">Surat Masuk</h3>

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
                                <h5>: {{ $sm->perihal }}</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Nomor / Tanggal</h6>
                            </td>
                            <td>
                                <h6>: {{ $sm->nomor() . ' | Tanggal: '.\Carbon\Carbon::parse($sm->tanggal())->isoFormat('D MMMM Y') }} </h6>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Nomor Agenda </h6>
                            </td>
                            <td>
                                <h6>: {{ $sm->nomor_agenda  }}</h6>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Sifat Surat </h6>
                            </td>
                            <td>
                                <h6>: {{ $sm->sifat_surat  }}</h6>
                            </td>
                        </tr>
                    </table>
                    <h6>
                        <span class="mailbox-read-time float-right"> {{ \Carbon\Carbon::parse($sm->tanggal_terima)->isoFormat('D - MMMM - Y') }}</span>
                    </h6>
                </div>
                <!-- /.mailbox-read-info -->
                <div class="mailbox-controls with-border text-center">
                    <h4 class="text-center text-bold"><ins> Asal Surat : {{ $sm->asal_surat  }}</ins></h4>
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
                                                <a href="{{URL::to( 'berkas/' . $b->lokasi .'/'. $b->nama_berkas)}}" target="_blank" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i>{{ Str::of($b->nama_berkas)->afterLast('_ks_')}}</a>
                                                <span class="mailbox-attachment-size clearfix mt-1">
                                                    <span>file PDF </span>
                                                    <a href="{{URL::to( 'berkas/' . $b->lokasi .'/'. $b->nama_berkas)}}" download="{{ Str::of($b->nama_berkas)->afterLast('_ks_')}}" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                                                </span>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="text-center text-bold">Keterangan</h4>
                                    <hr>
                                    <div class="form-group">
                                        <p>ISI DISPOSISI <small>(KABAG)</small> : {{ $sm->idk }}</p>
                                        <p>Keterangan 1 <small>(KABAG)</small> : {{ $sm->keterangan1 }}</p>
                                        <p>Keterangan 2 <small>(KASUBAG)</small> : {{ $sm->keterangan2 }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="text-center">Lajur Disposisi</h4>
                                    <hr>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input {{ in_array("Untuk diselesaikan", $lj) ? "checked" : "disabled" }} class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj1" value="Untuk diselesaikan">
                                            <label for="lj1" class="custom-control-label">Untuk diselesaikan</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input {{ in_array("Siapkan bahan", $lj) ? "checked" : "disabled" }} class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj2" value="Siapkan bahan">
                                            <label for="lj2" class="custom-control-label">Siapkan bahan</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input {{ in_array("Untuk ditinjaklanjuti", $lj) ? "checked" : "disabled" }} class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj3" value="Untuk ditinjaklanjuti">
                                            <label for="lj3" class="custom-control-label">Untuk ditinjaklanjuti</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input {{ in_array("Bahas dengan saya", $lj) ? "checked" : "disabled" }} class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj4" value="Bahas dengan saya">
                                            <label for="lj4" class="custom-control-label">Bahas dengan saya</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input {{ in_array("Dipelajari/dicermati", $lj) ? "checked" : "disabled" }} class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj5" value="Dipelajari/dicermati">
                                            <label for="lj5" class="custom-control-label">Dipelajari/dicermati</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input {{ in_array("Untuk dipedomani", $lj) ? "checked" : "disabled" }} class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj6" value="Untuk dipedomani">
                                            <label for="lj6" class="custom-control-label">Untuk dipedomani</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input {{ in_array("Saran/penjelasan", $lj) ? "checked" : "disabled" }} class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj7" value="Saran/penjelasan">
                                            <label for="lj7" class="custom-control-label">Saran/penjelasan</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input {{ in_array("Dikoordinasikan", $lj) ? "checked" : "disabled" }} class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj8" value="Dikoordinasikan">
                                            <label for="lj8" class="custom-control-label">Dikoordinasikan</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input {{ in_array("Untuk diketahui / dipergunakan seperlunya", $lj) ? "checked" : "disabled" }} class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj9" value="Untuk diketahui / dipergunakan seperlunya">
                                            <label for="lj9" class="custom-control-label">Untuk diketahui / dipergunakan seperlunya</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input {{ in_array("Agar dimonitor", $lj) ? "checked" : "disabled" }} class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj10" value="Agar dimonitor">
                                            <label for="lj10" class="custom-control-label">Agar dimonitor</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input {{ in_array("Segera Buat Laporan", $lj) ? "checked" : "disabled" }} class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj11" value="Segera Buat Laporan">
                                            <label for="lj11" class="custom-control-label">Segera Buat Laporan</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input {{ in_array("Siapkan konsep jawaban", $lj) ? "checked" : "disabled" }} class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj12" value="Siapkan konsep jawaban">
                                            <label for="lj12" class="custom-control-label">Siapkan konsep jawaban</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input {{ in_array("Mewakili", $lj) ? "checked" : "disabled" }} class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj13" value="Mewakili">
                                            <label for="lj13" class="custom-control-label">Mewakili</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input {{ in_array("Mendampingi", $lj) ? "checked" : "disabled" }} class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj14" value="Mendampingi">
                                            <label for="lj14" class="custom-control-label">Mendampingi</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input {{ in_array("Agendakan/acarakan", $lj) ? "checked" : "disabled" }} class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj15" value="Agendakan/acarakan">
                                            <label for="lj15" class="custom-control-label">Agendakan/acarakan</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input {{ in_array("Arsip/File", $lj) ? "checked" : "disabled" }} class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj16" value="Arsip/File">
                                            <label for="lj16" class="custom-control-label">Arsip/File</label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="text-center">Catatan</h4>
                                    <hr>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input {{ in_array("KASUBAG ATLHP", $ct) ? "checked" : "disabled" }} class="custom-control-input" type="checkbox" name="catatan[]" id="ct1" value="KASUBAG ATLHP">
                                            <label for="ct1" class="custom-control-label">KASUBAG ATLHP</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input {{ in_array("KASUBAG UMUM", $ct) ? "checked" : "disabled" }} class="custom-control-input" type="checkbox" name="catatan[]" id="ct2" value="KASUBAG UMUM">
                                            <label for="ct2" class="custom-control-label">KASUBAG UMUM</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="text-center">Tindak Lanjut</h4>
                                    <hr>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input {{ in_array("Proses", $tdl) ? "checked" : "disabled" }} class="custom-control-input" type="checkbox" name="tindak_lanjut[]" id="tdl1" value="Proses">
                                            <label for="tdl1" class="custom-control-label">Proses</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input {{ in_array("Belum Proses", $tdl) ? "checked" : "disabled" }} class="custom-control-input" type="checkbox" name="tindak_lanjut[]" id="tdl2" value="Belum Proses">
                                            <label for="tdl2" class="custom-control-label">Belum Proses</label>
                                        </div>
                                    </div>
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
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#hapus"><i class="far fa-trash-alt"></i> Hapus</button>
                    <a class="btn btn-default" href="{{ URL::to('suratmasuk/'.$sm->id.'/edit') }}"><i class="fa fa-cog"></i> Edit</a>
                    <a class="btn btn-default" href="{{ URL::to('printsm/'.$sm->id) }}" target="_blank"><i class="fas fa-print"></i> Print</a>
                </div>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
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
                <form action="{{ URL::route('suratmasuk.destroy', $sm->id) }}" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-outline-danger float-sm-left">Hapus</button>
                    <!-- <button>Delete User</button> -->
                    <!-- <a href="{{ URL::to('suratmasuk//'.$sm->id) }}" class="btn btn-outline-danger float-sm-left">Hapus</a> -->
                </form>
            </div>
        </div>

    </div>
    <!-- /.modal-content -->
</div>

@endsection

@section('adminlte_js')
{!! Toastr::message() !!}

@endsection