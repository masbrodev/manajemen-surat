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
                        <form id="dropzoneForm" class="dropzone" action="{{ URL::to('produk/upload_foto') }}" method="post" enctype="multipart/form-data">
                            @csrf
                        </form>
                        <div class="form-group">
                            <label>Asal Surat</label>
                            <input type="text" class="form-control" name="asal_surat" placeholder="Asal Surat" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label>Nomor Surat</label>
                            <input type="text" class="form-control" name="nomor_surat" placeholder="Nomor Surat" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label>Perihal</label>
                            <input type="text" class="form-control" name="perihal" placeholder="Perihal" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group" id="date">
                            <label>Tanggal Terima</label>
                            <input type="text" class="form-control" id="datepicker" name="tanggal_terima" placeholder="Tanggal Terima" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label>Isi Disposisi KABAG</label>
                            <textarea type="text" class="form-control" name="idk" placeholder="Isi Disposisi KABAG" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Lajur Disposisi</label>
                            <input type="text" class="form-control" name="lajur_disposisi" placeholder="Lajur Disposisi" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label>Berkas</label>
                            <input type="text" class="form-control" name="id_berkas" placeholder="Berkas" oninvalid="this.setCustomValidity('Lengkapi Inputan')" required="" oninput="setCustomValidity('')">
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
            $("#tambah").on('click', function() {
                console.log('aaa');
                $.ajax({
                    async: true,
                    url: "{{ URL::to('suratmasuk/store') }}",
                    type: 'POST',
                    data: {

                        'tanggal_terima': $('tanggal_terima').val(),
                        'asal_surat': $('asal_surat').val(),
                        'nomor_surat': $('nomor_surat').val(),
                        'perihal': $('perihal').val(),
                        'idk': $('idk').val(),
                        'lajur_disposisi': $('lajur_disposisi').val(),
                        'keterangan': $('keterangan').val(),
                        'id_berkas': $('id_berkas').val(),

                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $.LoadingOverlay("show");
                    },
                    success: function(response) {
                        id_produk = response.id_produk;
                        myDropzone.processQueue();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            });

            this.on('complete', function() {
                if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                    var _this = this;
                    _this.removeAllFiles();
                    $.LoadingOverlay("hide");
                    window.location.href = "{{ URL::to('/') }}";
                }
            });
        }
    };
</script>
@endsection