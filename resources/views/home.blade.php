@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $sm }}</h3>

                    <p>Total Surat Masuk</p>
                </div>
                <div class="icon">
                    <i class="fa fa-envelope"></i>
                </div>
                <a href="{{ URL::to('suratmasuk')}}" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $sk }}</h3>

                    <p>Total Surat Keluar</p>
                </div>
                <div class="icon">
                    <i class="fa fa-envelope-open"></i>
                </div>
                <a href="{{ URL::to('suratkeluar')}}" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $ts }}</h3>

                    <p>Total Keseluruhan Surat</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cube"></i>
                </div>
                <a href="" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $bk }}</h3>

                    <p>Total Berkas</p>
                </div>
                <div class="icon">
                    <i class="fa fa-paperclip"></i>
                </div>
                <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Grafik Surat Keseluruhan</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="donutChart" style="height:230px; min-height:386px"></canvas>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Surat Masuk & Keluar Terbaru</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                    @foreach($dtsa as $d)
                        <li class="item">
                            <div class="product-img">
                                <img src="pdf.png" alt="Product Image" class="img-size-50">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">{{ Str::limit($d->asal_surat . $d->tujuan_surat, 30) }}
                                    <span class="badge badge-warning float-right">{{ $d->nomor_agenda }}</span></a>
                                <span class="product-description">
                                {{ Str::limit($d->perihal, 60) }}
                                </span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- <canvas id="donutChart" style="height:230px; min-height:250px"></canvas> -->
            </div>
            <!-- /.card-body -->
        </div>

        <div class="col-md-12">
            <!-- AREA CHART -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Data Statistik Keseluruhan Surat</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="areaChart" style="height:250px; min-height:250px"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

</div>
@endsection

@section('adminlte_js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var dlb = @json($lb);
    var ddt = @json($ds);
    var ddtm = @json($dtm);
    var ddtk = @json($dtk);

    var rgb = function() {
        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        return "rgb(" + r + "," + g + "," + b + ")";
    };

    var rgba = function() {
        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        return "rgba(" + r + "," + g + "," + b + ", 0.2)";
    };

    var donutData = {
        labels: dlb,
        datasets: [{
            data: ddt,
            backgroundColor: [rgb(), rgb()],
        }]
    }
    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    })

    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        datasets: [{
            label: dlb[0],
            data: ddtm,
            backgroundColor: [rgba()],
            borderColor: [
                rgb()
            ],
            borderWidth: 1
        }, {
            label: dlb[1],
            data: ddtk,
            backgroundColor: [
                rgba()
            ],
            borderColor: [
                rgb()
            ],
            borderWidth: 1
        }]
    };


    // This will get the first returned node in the jQuery collection.
    var areaChart = new Chart(areaChartCanvas, {
        type: 'bar',
        data: areaChartData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    });
</script>
@endsection