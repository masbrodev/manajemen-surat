@extends('layouts.app')

@section('content_header')
@stop

@section('content')
@section('plugins.Toastr', true)
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
                        @if(count($berkas) != 0)
                        <br>
                        <button type="button" class="btn btn-outline-success float-sm-right" data-toggle="modal" data-target="#opsi-berkas">Opsi Berkas</button>
                        @endif
                        <br>
                        <br>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Nomor Agenda <span class="text-danger">*</span></label></small>
                                    <input type="number" class="form-control" name="nomor_agenda" id="nomor_agenda" value="{{ $sk->nomor_agenda }}" placeholder="Nomor Agenda" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                                </div>
                                <div class="col-sm-6">
                                    <label>Konseptor<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="konseptor" name="konseptor" value="{{ $sk->konseptor }}" placeholder="Konseptor" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Nomor Surat <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nomor_surat" id="nomor_surat" value="{{ $sk->nomor_surat }}" placeholder="Nomor Surat" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                                </div>
                                <div class="col-sm-6">
                                    <label>Tanggal Keluar<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar" value="{{ $sk->tanggal_keluar }}" placeholder="Tanggal" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Tujuan Surat <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tujuan_surat" id="tujuan_surat" value="{{ $sk->tujuan_surat }}" placeholder="Tujuan Surat" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                                </div>
                                <div class="col-sm-6">
                                    <label>Perihal <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="perihal" id="perihal" value="{{ $sk->perihal }}" placeholder="Perihal" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan">{{ $sk->keterangan }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <label>Tindak Lanjut <span class="text-danger">*</span></label>

                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" {{ in_array("Tuntas", $ss) ? "checked" : "" }} name="tdl[]" id="ss3" value="Tuntas">
                                                    <label for="ss3" class="custom-control-label">Tuntas</label>
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" {{ in_array("Belum Tuntas", $ss) ? "checked" : "" }} name="tdl[]" id="ss4" value="Belum Tuntas">
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
                        <input type="submit" id="edit" name="edit" value="Simpan" class="btn btn-success float-sm-right">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="opsi-berkas">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Opsi Berkas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                    @foreach($berkas as $b)
                    <li>
                        <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>

                        <div class="mailbox-attachment-info">
                            <a href=" {{URL::to( 'berkas/surat_keluar/' . $b->lokasi .'/'. $b->nama_berkas)}}" target="_blank" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i>{{ Str::of($b->nama_berkas)->afterLast('_ks_')}}</a>
                            <span class="mailbox-attachment-size clearfix mt-1">
                                <span>Hapus File</span>
                                <a href=" {{ URL::to('del_berkas/surat_keluar/'.$b->id)}} " class="btn btn-outline-danger btn-sm float-right"><i class="fas fa-trash"></i></a>
                            </span>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
    <!-- /.modal-content -->
</div>

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
{!! Toastr::message() !!}

<script>
    Dropzone.options.dropzoneForm = {
        autoProcessQueue: false,
        acceptedFiles: ".pdf",
        addRemoveLinks: false,
        parallelUploads: 5,
        dictDefaultMessage: "<strong>Drop files here or click to upload. </strong>",
        removedfile: function(file) {
            file.previewElement.remove();
        },
        init: function() {
            myDropzone = this;
            var ss = [];


            $.ajax({
                url: "{{ URL::to('get_berkas_sk/'. $sk->id) }}",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    //console.log(data);
                    $.each(data, function(key, value) {

                        var file = {
                            name: value.name,
                            size: value.size
                        };
                        myDropzone.options.addedfile.call(myDropzone, file);
                        myDropzone.options.thumbnail.call(myDropzone, file, "/pdf.png");
                        // myDropzone.emit("complete", file);
                    });
                },

                error: function(error) {
                    console.log(error);
                }

            });

            var tdl = [];

            console.log(tdl);
            $('input[type="checkbox"]').on('change', function() {
                $('input[type="checkbox"]').not(this).prop('checked', false);
                tdl.push($(this).val());
            });

            $("#edit").on('click', function() {

                $.ajax({
                    async: true,
                    url: "{{ route('suratkeluar.update', $sk->id ) }}",
                    method: 'POST',
                    data: {
                        'tanggal_keluar': $('#tanggal_keluar').val(),
                        'tujuan_surat': $('#tujuan_surat').val(),
                        'nomor_surat': $('#nomor_surat').val(),
                        'nomor_agenda': $('#nomor_agenda').val(),
                        'perihal': $('#perihal').val(),
                        'keterangan': $('#keterangan').val(),
                        'konseptor': $('#konseptor').val(),
                        'tindak_lanjut': tdl,

                        'tdl_null': "{{ $sk->tindak_lanjut }}",

                        '_method': 'PUT',
                        '_token': '{{ csrf_token() }}'
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $.LoadingOverlay("show");

                        // console.log("{{ csrf_token() }}");
                    },
                    success: function(response) {
                        if (myDropzone.getQueuedFiles().length == 0) {
                            window.location.href = "{{ URL::to('suratkeluar/'.$sk->id) }}" + "?success=update";
                        } else {
                            myDropzone.processQueue();
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            });

            this.on("addedfile", function(file) {
                if (!file.type.match(/image.*/)) {
                    // This is not an image, so Dropzone doesn't create a thumbnail.
                    // Set a default thumbnail:
                    myDropzone.emit("thumbnail", file, "/pdf.png");

                    // You could of course generate another image yourself here,
                    // and set it as a data url.
                }
            });

            this.on('sending', function(file, xhr, formData) {
                console.log(file);
                formData.append('bulan', $('#tanggal_keluar').val());
                formData.append('id', '{{ $sk->id }}');
                formData.append('type', 'surat_keluar');

            });

            this.on('complete', function() {
                if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                    var _this = this;
                    _this.getUploadingFiles();
                    $.LoadingOverlay("hide");
                    window.location.href = "{{ URL::to('suratkeluar/'.$sk->id) }}" + "?success=update";
                }
            });

            this.on('error', function(file, errormessage, xhr) {
                $.LoadingOverlay("hide");
                console.log(errormessage);
                toastr.error('Gagal memperbarui data');
            });
        }
    };
</script>
@endsection