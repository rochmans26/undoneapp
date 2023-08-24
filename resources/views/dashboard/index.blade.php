@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <h1>Dashboard</h1>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>

    <section class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ count($proposals) }}</h3>

                            <p>Pengajuan Proposal</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-document"></i>
                        </div>
                        <a href="#" class="small-box-footer">Selengkapnya <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ count($laporan_pkm) }}</h3>

                            <p>Laporan Hasil PKM</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-filing"></i>
                        </div>
                        <a href="#" class="small-box-footer">Selengkapnya <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ count($admin) }}</h3>

                            <p>User Admin</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="#" class="small-box-footer">Selengkapnya <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ count($publikasi) }}</h3>

                            <p>Publikasi</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-copy"></i>
                        </div>
                        <a href="#" class="small-box-footer">Selengkapnya <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title"><b>Total Pendanaan Yang Diterima</b></h3>
                                {{-- <a href="javascript:void(0);">View Report</a> --}}
                            </div>
                        </div>
                        <div class="card-body">

                            <!-- /.d-flex -->
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select id="tahun" class="form-control select2">
                                                <option selected class="text-center" value="{{ date('Y') }}">
                                                    {{ date('Y') }} - {{ date('Y') + 1 }}</option>
                                                @php
                                                    $tahunSekarang = date('Y');
                                                    $tahunAwal = $tahunSekarang - 100;
                                                    $tahunAkhir = $tahunSekarang + 5;
                                                    for ($tahun = $tahunAkhir; $tahun >= $tahunAwal; $tahun--) {
                                                        echo '<option value="' . $tahun . '" class="text-center">' . $tahun . ' - ' . $tahun + 1 . '</option>';
                                                    }
                                                @endphp
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="position-relative mb-4">
                                <canvas id="sales-chart" height="400"></canvas>
                            </div>

                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i> Total Pendanaan UNLA
                                </span>

                                <span class="mr-2">
                                    <i class="fas fa-square text-danger"></i> Total Pendanaan DIKTI
                                </span>

                                <span>
                                    <i class="fas fa-square text-success"></i> Total Pendanaan Lainnya
                                </span>
                            </div>
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg" id="t_pertahun">
                                        @php
                                            $total1 = 0;
                                            $total2 = 0;
                                            $total3 = 0;
                                            $total = 0;
                                            foreach ($laporan_pkm as $key => $value) {
                                                $total1 = $total1 + $value->dana_dikti;
                                                $total2 = $total2 + $value->dana_unla;
                                                $total3 = $total3 + $value->dana_lainnya;
                                            }
                                            $total = $total1 + $total2 + $total3;
                                        @endphp
                                        Rp. {{ number_format($total) }},-
                                    </span>
                                    <span>Pendapatan selama 1 periode</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right"></p>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('admintemp') }}/plugins/chart.js/Chart.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('admintemp') }}/dist/js/pages/dashboard3.js"></script> --}}

    <script>
        const ctx = document.getElementById('sales-chart');
        let def_val = document.getElementById('tahun').value;
        let link = '{{ route('data-laphas', ':def_val') }}';
        link = link.replace(':def_val', def_val);
        console.log(link);
        //console.log(def_val);
        $.ajax({
            url: link,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                if (response != null) {
                    //console.log(response);
                    let d_unla_def = [];
                    let d_dikti_def = [];
                    let d_lainnya_def = [];
                    let t_unla_def = 0;
                    let t_dikti_def = 0;
                    let t_lainnya_def = 0;
                    for (let x in response) {
                        d_unla_def.push(response[x].dana_unla);
                        d_dikti_def.push(response[x].dana_dikti);
                        d_lainnya_def.push(response[x].dana_lainnya);
                    }
                    for (i = 0; i < d_unla_def.length; i++) {

                        t_unla_def += d_unla_def[i];
                    }
                    for (i = 0; i < d_dikti_def.length; i++) {

                        t_dikti_def += d_dikti_def[i];
                    }
                    for (i = 0; i < d_lainnya_def.length; i++) {

                        t_lainnya_def += d_lainnya_def[i];
                    }
                    myChart.data.datasets[0].data = [t_unla_def, t_dikti_def, t_lainnya_def];
                    myChart.update();
                    let num = t_unla_def + t_dikti_def + t_lainnya_def;
                    document.getElementById('t_pertahun').innerHTML = formatRupiah(num);
                }

            }
        });
        //console.log(t_lainnya_def);
        let ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }
        let myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Unla', 'Dikti', 'Lainnya'],
                datasets: [{
                    label: def_val,
                    data: [10000, 20000, 30000],
                    borderWidth: 1,
                    backgroundColor: ['#007bff', '#e74c3c', '#16a085']
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true,
                            lineWidth: '4px',
                            color: 'rgba(0, 0, 0, .2)',
                            zeroLineColor: 'transparent'
                        },
                        ticks: $.extend({
                            beginAtZero: true,

                            // Include a dollar sign in the ticks
                            callback: function(value) {
                                if (value >= 1000000) {
                                    value /= 1000000
                                    value += 'jt'
                                }

                                return 'Rp.' + value
                            }
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: true,
                        },
                        ticks: ticksStyle
                    }]
                }
            }
        });

        function formatRupiah(num) {
            let rupiahFormat = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
            }).format(num);
            return rupiahFormat;
        }
        const yearsales = document.getElementById('tahun');
        yearsales.addEventListener('change', salesTracker);

        function salesTracker() {
            let year = yearsales.value;
            let url = '{{ route('data-laphas', ':year') }}';
            url = url.replace(':year', year);
            console.log(url);
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response != null) {
                        //console.log(response);
                        let d_unla = [];
                        let d_dikti = [];
                        let d_lainnya = [];
                        let t_unla = 0;
                        let t_dikti = 0;
                        let t_lainnya = 0;
                        for (let x in response) {
                            d_unla.push(response[x].dana_unla);
                            d_dikti.push(response[x].dana_dikti);
                            d_lainnya.push(response[x].dana_lainnya);
                        }
                        for (i = 0; i < d_unla.length; i++) {

                            t_unla += d_unla[i];
                        }
                        for (i = 0; i < d_dikti.length; i++) {

                            t_dikti += d_dikti[i];
                        }
                        for (i = 0; i < d_lainnya.length; i++) {

                            t_lainnya += d_lainnya[i];
                        }
                        myChart.data.datasets[0].data = [t_unla, t_dikti, t_lainnya];
                        myChart.data.datasets[0].label = [year];
                        myChart.update();
                        let num = t_unla + t_dikti + t_lainnya;
                        document.getElementById('t_pertahun').innerHTML = formatRupiah(num);
                    }

                }

            });
        }
        //console.log(thn_mulai);
        /*$('#tahun').change(function() {
            var thn_mulai = $(this).val();
            var url = '{{ route('data-laphas', ':thn_mulai') }}';
            url = url.replace(':thn_mulai', thn_mulai);
            console.log(thn_mulai);
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response != null) {
                        //console.log(response);
                        let d_unla = [];
                        let d_dikti = [];
                        let d_lainnya = [];
                        let t_unla = 0;
                        let t_dikti = 0;
                        let t_lainnya = 0;
                        for (let x in response) {
                            d_unla.push(response[x].dana_unla);
                            d_dikti.push(response[x].dana_dikti);
                            d_lainnya.push(response[x].dana_lainnya);
                        }
                        for (i = 0; i < d_unla.length; i++) {

                            t_unla += d_unla[i];
                        }
                        for (i = 0; i < d_dikti.length; i++) {

                            t_dikti += d_dikti[i];
                        }
                        for (i = 0; i < d_lainnya.length; i++) {

                            t_lainnya += d_lainnya[i];
                        }

                        //console.log(t_unla);
                        let ticksStyle = {
                            fontColor: '#495057',
                            fontStyle: 'bold'
                        }
                        document.getElementById('t_pertahun').innerHTML = t_unla + t_dikti + t_lainnya;

                        //var mode = 'index'
                        //var intersect = true
                        var $salesChart = $('#sales-chart')
                        // eslint-disable-next-line no-unused-vars
                        var salesChart = new Chart($salesChart, {
                            type: 'bar',
                            data: {
                                labels: [thn_mulai],
                                datasets: [{
                                        backgroundColor: '#007bff',
                                        borderColor: '#007bff',
                                        data: [t_unla],
                                    },
                                    {
                                        backgroundColor: '#e74c3c',
                                        borderColor: '#ced4da',
                                        data: [t_dikti],
                                    },
                                    {
                                        backgroundColor: '#16a085',
                                        borderColor: '#ced4da',
                                        data: [t_lainnya],
                                    }
                                ]
                            },
                            options: {
                                maintainAspectRatio: false,
                                legend: {
                                    display: false
                                },
                                scales: {
                                    yAxes: [{
                                        // display: false,
                                        gridLines: {
                                            display: true,
                                            lineWidth: '4px',
                                            color: 'rgba(0, 0, 0, .2)',
                                            zeroLineColor: 'transparent'
                                        },
                                        ticks: $.extend({
                                            beginAtZero: true,

                                            // Include a dollar sign in the ticks
                                            callback: function(value) {
                                                if (value >= 1000000) {
                                                    value /= 1000000
                                                    value += 'jt'
                                                }

                                                return 'Rp.' + value
                                            }
                                        }, ticksStyle)
                                    }],
                                    xAxes: [{
                                        display: true,
                                        gridLines: {
                                            display: false
                                        },
                                        ticks: ticksStyle
                                    }]
                                }
                            }
                        })
                        //  $('#id_bidang').val(response.id_bidang);
                        //  $('#id_skim').val(response.id_skim);
                        //  $('#lok_kegiatan').val(response.lokasi_kegiatan);
                        //  $('#thn_mulai').val(response.thn_mulai);
                        //  $('#thn_selesai').val(response.thn_selesai);
                    }

                }
            });
        });*/
    </script>
@endpush
