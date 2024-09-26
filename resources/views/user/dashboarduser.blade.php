@extends('user/template/layout')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('')}}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            @if($total != 0)
            <div class="col-lg-8">
                <div class="row">

                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Aktifitas</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-ui-radios-grid"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$total}}</h6>
                                        <span class="text-muted small pt-2 ps-1">Total aktifitas</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="filter">
                                <a class="icon" href="{{route('user.aktifitasuser.history')}}"><i class="bi bi-box-arrow-up-right"></i></a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Terverifikasi <span><i class="box-arrow-up-right"></i></span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-ui-checks"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$totalAcc}}</h6>
                                        @if($totalAcc > 0 && $total > 0)
                                        <span class="text-success small pt-1 fw-bold">{{ floor(($totalAcc / $total) * 100) }}%</span> <span class="text-muted small pt-2 ps-1">Terverifikasi</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">
                            <div class="filter">
                                <a class="icon" href="{{route('user.aktifitasuser.pending')}}"><i class="bi bi-box-arrow-up-right"></i></a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Pending</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-ui-radios"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$totalPending}}</h6>
                                        @if($totalPending != 0)
                                        <span class="text-danger small pt-1 fw-bold">{{ floor(($totalPending / $total) * 100) }}%</span> <span class="text-muted small pt-2 ps-1">Menunggu verifikasi</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <h5 class="card-title">Grafik Keaktifan <span>| Pekan ini</span></h5>

                                <div id="grafikKeaktifan"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#grafikKeaktifan"), {
                                            series: [{
                                                name: 'Jumlah Aktifitas',
                                                data: [
                                                    <?php foreach ($data as $d) {
                                                        echo $d->count . ',';
                                                    } ?>
                                                ],
                                            }],
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
                                            colors: ['#2eca6a'],
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
                                                    <?php foreach ($data as $d) {
                                                        echo '"' . $d->day . '",';
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

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Aktifitas Terakhir <span>| Hari Ini</span></h5>

                        <div class="activity">

                            @forelse($recent as $list)
                            <div class="activity-item d-flex">
                                @if($list->is_verified == true)
                                <div class="activite-label"><span class="badge bg-success">Verified</span></div>
                                <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                @else
                                <div class="activite-label"><span class="badge bg-danger">Pending</span></div>
                                <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                                @endif
                                <div class="activity-content">
                                    {{$list->judul}}
                                </div>
                            </div>
                            @empty
                            <span>Belum ada aktifitas hari ini.</span>
                            @endforelse

                        </div>

                    </div>
                </div>

            </div>
            @else
            <div class="text-center">
                <h5 class="card-title text-center">Anda Belum Upload Aktifitas</h5>
            </div>
            @endif

        </div>
    </section>

</main>

@endsection