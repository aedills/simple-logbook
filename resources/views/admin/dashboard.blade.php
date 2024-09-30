@extends('admin/template/layout')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg-12">
                <div class="row">

                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Total User <span>| Peserta aktif</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$totalUser}} User</h6>
                                        <a href="{{route('admin.datauser.magang.index')}}">
                                            <span class="text-success small pt-1 fw-bold">{{$magang}}</span> <span class="text-muted small pt-2 ps-1">Magang</span>
                                        </a>
                                        |
                                        <a href="{{route('admin.datauser.pkl.index')}}">
                                            <span class="text-success small pt-1 fw-bold">{{$pkl}}</span> <span class="text-muted small pt-2 ps-1">PKL</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Revenue <span>| This Month</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>$3,264</h6>
                                        <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Customers <span>| This Year</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>1244</h6>
                                        <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Grafik Keaktifan Per User dalam Satu Pekan -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Grafik Keaktifan <span>| Pekan Ini</span></h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [
                                                <?php
                                                foreach ($dataPerUser as $dataUser) {
                                                    echo "{name: '" . $dataUser['nama'] . "',";
                                                    echo "data: [";
                                                    foreach ($dataUser['data'] as $counted) {
                                                        echo $counted . ',';
                                                    }
                                                    echo "],},";
                                                }
                                                ?>
                                            ],
                                            chart: {
                                                height: 350,
                                                type: 'area',
                                                toolbar: {
                                                    show: false
                                                },
                                            },
                                            markers: {
                                                size: 4
                                            },
                                            colors: ['#4154f1', '#2eca6a', '#ff771d', '#ff5733', '#8e44ad'],
                                            fill: {
                                                type: "gradient",
                                                gradient: {
                                                    shadeIntensity: 1,
                                                    opacityFrom: 0.3,
                                                    opacityTo: 0.4,
                                                    stops: [0, 90, 100]
                                                }
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                curve: 'smooth',
                                                width: 2
                                            },
                                            xaxis: {
                                                type: 'date',
                                                categories: [
                                                    <?php foreach ($graphData as $d) {
                                                        echo '"' . $d['date'] . '",';
                                                    } ?>
                                                ]
                                            },
                                            tooltip: {
                                                x: {
                                                    format: 'dd/MM/yy'
                                                },
                                            }
                                        }).render();
                                    });
                                </script>
                                <!-- End Line Chart -->

                            </div>

                        </div>
                    </div><!-- End Reports -->

                    <!-- Grafik Upload Terbaru -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Ajuan Verifikasi Terbaru <span>| Hari Ini ({{$recentTotal}} total)</span></h5>

                                <div class="activity">
                                    @foreach($recent as $list)
                                    <div class="activity-item d-flex">
                                        <div class="activite-label">{{ \Carbon\Carbon::parse($list->created_at)->format('H:m') }}</div>
                                        <i class='bi bi-circle-fill activity-badge {{ $list->is_verified ? "text-success" : "text-danger"}} align-self-start'></i>
                                        <div class="activity-content">
                                            {{$list->judul}} - <strong>{{$list->upload_by->nama}}</strong>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                        </div><!-- End Recent Activity -->
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection