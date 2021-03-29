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
                        <h3 class="card-title">Tambah Surat Keluar</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <form id="dropzoneForm" class="dropzone" action="{{ URL::to('upload_berkas') }}" method="post" enctype="multipart/form-data">
                            @csrf
                        </form>
                        <br>
                        <form id="form-tambah" action="javascript:$.LoadingOverlay('show');">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Nomor Agenda <span class="text-danger">*</span></label> <small class="text-muted">(nomor sebelumnya {{ $na }})</small>
                                        <input type="number" class="form-control" name="nomor_agenda" id="nomor_agenda" value="{{ $na + 1}}" placeholder="Nomor Agenda" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Konseptor<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="konseptor" name="konseptor" placeholder="Konseptor" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Nomor Surat <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nomor_surat" id="nomor_surat" placeholder="Nomor Surat" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Tanggal Keluar<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar" placeholder="Tanggal" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Tujuan Surat <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="tujuan_surat" id="tujuan_surat" placeholder="Tujuan Surat" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Perihal <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="perihal" id="perihal" placeholder="Perihal" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <label>Tindak Lanjut <span class="text-danger">*</span></label>

                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" name="tdl[]" id="ss3" value="Tuntas">
                                                        <label for="ss3" class="custom-control-label">Tuntas</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" name="tdl[]" id="ss4" value="Belum Tuntas">
                                                        <label for="ss4" class="custom-control-label">Belum Tuntas</label>
                                                    </div>
                                                </div>
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
    Dropzone.options.dropzoneForm = {
        autoProcessQueue: false,
        acceptedFiles: ".pdf",
        addRemoveLinks: false,
        parallelUploads: 5,
        removedfile: function(file) {
            file.previewElement.remove();
        },

        init: function() {
            myDropzone = this;
            var tdl = [];
            console.log(tdl);
            $('input[type="checkbox"]').on('change', function() {
                $('input[type="checkbox"]').not(this).prop('checked', false);
                tdl.push($(this).val());
            });
            $("#form-tambah").submit(function() {
                $.ajax({
                    async: true,
                    url: "{{ URL::to('suratkeluar') }}",
                    type: 'POST',
                    data: {
                        'tanggal_keluar': $('#tanggal_keluar').val(),
                        'tujuan_surat': $('#tujuan_surat').val(),
                        'nomor_surat': $('#nomor_surat').val(),
                        'nomor_agenda': $('#nomor_agenda').val(),
                        'perihal': $('#perihal').val(),
                        'keterangan': $('#keterangan').val(),
                        'konseptor': $('#konseptor').val(),
                        'tindak_lanjut': tdl,
                        'id_r': '{{$id}}',
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $.LoadingOverlay("show");
                        myDropzone.processQueue();
                    },
                    success: function() {
                        $.LoadingOverlay("hide");
                        window.location.href = "{{ URL::to('suratkeluar/'. $id) }}" + "?success=add";
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
                formData.append('bulan', $('#tanggal_keluar').val());
                formData.append('type', 'surat_keluar');
            });

            this.on('complete', function() {
                if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                    var _this = this;
                    _this.removeAllFiles();
                    $.LoadingOverlay("hide");
                    window.location.href = "{{ URL::to('suratkeluar/'. $id) }}" + "?success=add";

                }
            });
        }
    };
</script>
@endsection