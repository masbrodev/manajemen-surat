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
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Surat Masuk</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <form id="dropzoneForm" class="dropzone" action="{{ URL::to('upload_berkas') }}" method="post" enctype="multipart/form-data">
                            @csrf
                        </form>
                        <div class="form-group">
                            <label>Asal Surat</label>
                            <input type="text" class="form-control" name="asal_surat" id="asal_surat" placeholder="Asal Surat" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label>Nomor Surat</label>
                            <input type="text" class="form-control" name="nomor_surat" id="nomor_surat" placeholder="Nomor Surat" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label>Perihal</label>
                            <input type="text" class="form-control" name="perihal" id="perihal" placeholder="Perihal" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group" id="date">
                            <label>Tanggal Terima</label>
                            <input type="text" class="form-control" id="datepicker" name="tanggal_terima" placeholder="Tanggal Terima" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label>Isi Disposisi KABAG</label>
                            <textarea type="text" class="form-control" name="idk" id="idk" placeholder="Isi Disposisi KABAG" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')"></textarea>
                        </div>
                        <label>Lajur Disposisi</label><br>
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
                                <label for="lj5" class="custom-control-label">Dipelajari/dicermati</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" id="tambah" name="tambah" value="Simpan" class="btn btn-primary float-sm-right">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('adminlte_js')


<script>
    // $('#datepicker').datepicker("setDate", new Date());
    $('#datepicker').datepicker({
        format: "dd-mm-yyyy",
        language: "id",
        autoclose: true,
        toggleActive: true,
        todayHighlight: true
    });



    Dropzone.options.dropzoneForm = {
        autoProcessQueue: false,
        acceptedFiles: ".pdf",
        addRemoveLinks: true,
        parallelUploads: 5,
        removedfile: function(file) {
            file.previewElement.remove();
        },
        init: function() {
            myDropzone = this;
            var aa = [];
            $("#tambah").on('click', function() {
                $("input[type=checkbox]:checked").each(function() {
                    aa.push($(this).val());
                });
                $.ajax({
                    async: true,
                    url: "{{ URL::to('suratmasuk') }}",
                    type: 'POST',
                    data: {
                        'tanggal_terima': $('#datepicker').val(),
                        'asal_surat': $('#asal_surat').val(),
                        'nomor_surat': $('#nomor_surat').val(),
                        'perihal': $('#perihal').val(),
                        'idk': $('#idk').val(),
                        'lajur_disposisi': aa,
                        'keterangan': $('#keterangan').val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $.LoadingOverlay("show");
                    },
                    success: function(response) {
                        myDropzone.processQueue();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            });

            this.on('sending', function(file, xhr, formData) {
                formData.append('id', '{{ $id }}');
                formData.append('bulan', $('#datepicker').val());
            });

            this.on('complete', function() {
                if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                    var _this = this;
                    _this.removeAllFiles();
                    $.LoadingOverlay("hide");
                    window.location.href = "{{ URL::to('suratmasuk') }}";

                }
            });
        }
    };
</script>
@endsection