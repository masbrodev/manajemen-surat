@extends('layouts.app')

@section('content_header')
@stop

@section('content')
@section('plugins.Toastr', true)
@section('plugins.Datepicker', true)
@section('plugins.Dropzone', true)
@section('plugins.LoadingOverlay', true)


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Surat Masuk</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <form id="dropzoneForm" class="dropzone" action="{{ URL::to('upload_berkas') }}" method="post" enctype="multipart/form-data">
                            @csrf
                        </form>
                        <br>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <label>Sifat Surat <span class="text-danger">*</span></label>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="sifat_surat[]" id="ss1" value="Rahasia">
                                                    <label for="ss1" class="custom-control-label">Rahasia</label>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="sifat_surat[]" id="ss2" value="Penting / Segera">
                                                    <label for="ss2" class="custom-control-label">Penting / Segera</label>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="sifat_surat[]" id="ss3" value="Biasa">
                                                    <label for="ss3" class="custom-control-label">Biasa</label>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="sifat_surat[]" id="ss4" value="Tembusan">
                                                    <label for="ss4" class="custom-control-label">Tembusan</label>
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <form id="form-tambah" action="javascript:$.LoadingOverlay('show');">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Nomor Agenda <span class="text-danger">*</span></label> <small class="text-muted">(nomor sebelumnya {{ $na }})</small>
                                        <input type="text" class="form-control" name="nomor_agenda" id="nomor_agenda" value="{{ $na + 1}}" placeholder="Nomor Agenda" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Tanggal Terima <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="datepicker" name="tanggal_terima" placeholder="Tanggal Terima" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Nomor Surat <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nomor_surat" id="nomor_surat" placeholder="Nomor Surat">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Tanggal Surat<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" placeholder="Tanggal">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Asal Surat <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="asal_surat" id="asal_surat" placeholder="Asal Surat" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Perihal <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="perihal" id="perihal" placeholder="Perihal" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Keterangan 1 <small>(KABAG)</small></label>
                                <textarea type="text" class="form-control" name="keterangan1" id="keterangan1" placeholder="Keterangan 1"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Keterangan 2 <small>(KASUBAG)</small></label>
                                <textarea type="text" class="form-control" name="keterangan2" id="keterangan2" placeholder="Keterangan 2"></textarea>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">

                                            <h4>Lajur Disposisi</h4>
                                            <hr>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj1" value="Untuk diselesaikan">
                                                    <label for="lj1" class="custom-control-label">Untuk diselesaikan</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj2" value="Siapkan bahan">
                                                    <label for="lj2" class="custom-control-label">Siapkan bahan</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj3" value="Untuk ditinjaklanjuti">
                                                    <label for="lj3" class="custom-control-label">Untuk ditinjaklanjuti</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj4" value="Bahas dengan saya">
                                                    <label for="lj4" class="custom-control-label">Bahas dengan saya</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj5" value="Dipelajari/dicermati">
                                                    <label for="lj6" class="custom-control-label">Dipelajari/dicermati</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj6" value="Untuk dipedomani">
                                                    <label for="lj6" class="custom-control-label">Untuk dipedomani</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj7" value="Saran/penjelasan">
                                                    <label for="lj7" class="custom-control-label">Saran/penjelasan</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj8" value="Dikoordinasikan">
                                                    <label for="lj8" class="custom-control-label">Dikoordinasikan</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj9" value="Untuk diketahui / dipergunakan seperlunya">
                                                    <label for="lj9" class="custom-control-label">Untuk diketahui / dipergunakan seperlunya</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj10" value="Agar dimonitor">
                                                    <label for="lj10" class="custom-control-label">Agar dimonitor</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj11" value="Segera Buat Laporan">
                                                    <label for="lj11" class="custom-control-label">Segera Buat Laporan</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj12" value="Siapkan konsep jawaban">
                                                    <label for="lj12" class="custom-control-label">Siapkan konsep jawaban</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj13" value="Mewakili">
                                                    <label for="lj13" class="custom-control-label">Mewakili</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj14" value="Mendampingi">
                                                    <label for="lj14" class="custom-control-label">Mendampingi</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj15" value="Agendakan/acarakan">
                                                    <label for="lj15" class="custom-control-label">Agendakan/acarakan</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="lajur_disposisi[]" id="lj16" value="Arsip/File">
                                                    <label for="lj16" class="custom-control-label">Arsip/File</label>
                                                </div>
                                            </div>
                                            <br>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">

                                            <h4>Catatan</h4>
                                            <hr>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="catatan[]" id="ct1" value="KASUBAG ATLHP">
                                                    <label for="ct1" class="custom-control-label">KASUBAG ATLHP</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="catatan[]" id="ct2" value="KASUBAG UMUM">
                                                    <label for="ct2" class="custom-control-label">KASUBAG UMUM</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">

                                            <h4>Tindak Lanjut</h4>
                                            <hr>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="tindak_lanjut[]" id="tdl1" value="Proses">
                                                    <label for="tdl1" class="custom-control-label">Proses</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="tindak_lanjut[]" id="tdl2" value="Belum Proses">
                                                    <label for="tdl2" class="custom-control-label">Belum Proses</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h4>Tindak Lanjut Staf</h4>
                                            <hr>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="tls" name="tls" placeholder="Tindak Lanjut Staf">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                        <span style="color: red;">* Wajib diisi</span>
                        <input type="submit" id="tambah" name="tambah" value="Simpan" class="btn btn-success float-sm-right">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('adminlte_css')

<style>
    .dz-image img {
        width: 100%;
        height: 100%;
    }

    .dropzone.dz-started .dz-message {
        display: block !important;
    }

    .dropzone {
        border: 2px dashed #0da622 !important;
        color: green;
    }

    .dropzone i {
        font-size: 5rem;
    }

    .dropzone .dz-preview.dz-complete .dz-success-mark {
        opacity: 1;
    }

    .dropzone .dz-preview.dz-error .dz-success-mark {
        opacity: 0;
    }

    .dropzone .dz-preview .dz-error-message {
        top: 144px;
    }
</style>
@endsection

@section('adminlte_js')


<script>
    // $('#datepicker').datepicker("setDate", new Date());
    // $('#datepicker').datepicker({
    //     format: "dd-mm-yyyy",
    //     language: "id",
    //     autoclose: true,
    //     toggleActive: true,
    //     todayHighlight: true
    // });



    Dropzone.options.dropzoneForm = {
        autoProcessQueue: false,
        acceptedFiles: ".pdf",
        addRemoveLinks: false,
        parallelUploads: 5,
        removedfile: function(file) {
            file.previewElement.remove();
        },

        // accept: function(file) {
        //     myDropzone.options.thumbnail.call(myDropzone, file, "/pdf.png");
        // },

        init: function() {
            myDropzone = this;
            var ss = [];
            var lj = [];
            var ct = [];
            var tdl = [];
            $("#form-tambah").submit(function() {

                $("input[name='sifat_surat[]']:checked").each(function() {
                    ss.push($(this).val());
                });

                $("input[name='lajur_disposisi[]']:checked").each(function() {
                    lj.push($(this).val());
                });

                $("input[name='catatan[]']:checked").each(function() {
                    ct.push($(this).val());
                });

                $("input[name='tindak_lanjut[]']:checked").each(function() {
                    tdl.push($(this).val());
                });

                $.ajax({
                    async: true,
                    url: "{{ URL::to('suratmasuk') }}",
                    type: 'POST',
                    data: {
                        'tanggal_terima': $('#datepicker').val(),
                        'tanggal_surat': $('#tanggal_surat').val(),
                        'asal_surat': $('#asal_surat').val(),
                        'nomor_surat': $('#nomor_surat').val(),
                        'nomor_agenda': $('#nomor_agenda').val(),
                        'perihal': $('#perihal').val(),
                        'idk': $('#idk').val(),
                        'keterangan1': $('#keterangan1').val(),
                        'keterangan2': $('#keterangan2').val(),
                        'tls': $('#tls').val(),
                        'sifat_surat': ss,
                        'lajur_disposisi': lj,
                        'catatan': ct,
                        'tindak_lanjut': tdl,
                        'id_r': '{{$id}}',
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        myDropzone.processQueue();
                        $.LoadingOverlay("show");
                        // console.log(myDropzone.getAcceptedFiles().length);
                    },
                    success: function() {
                        $.LoadingOverlay("hide");
                        window.location.href = "{{ URL::to('suratmasuk/'. $id) }}" + "?success=add";
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            });

            this.on("addedfile", function(file) {
                if (!file.type.match(/image.*/)) {
                    myDropzone.emit("thumbnail", file, "/pdf.png");
                }
            });

            this.on('sending', function(file, xhr, formData) {
                formData.append('id', '{{ $id }}');
                formData.append('bulan', $('#datepicker').val());
                formData.append('type', 'surat_masuk');
            });

            this.on('complete', function() {
                if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                    var _this = this;
                    _this.removeAllFiles();
                    $.LoadingOverlay("hide");
                    window.location.href = "{{ URL::to('suratmasuk/'. $id) }}" + "?success=add";

                }
            });
        }
    };
</script>
@endsection