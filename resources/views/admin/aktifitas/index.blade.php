@extends('admin/template/layout')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Aktifitas</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="card">
                <div class="card-title">
                    <h5 style="margin-left:20px">Semua Aktifitas</h5>
                </div>
                <div class="card-body table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Foto</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($aktifitas as $item)
                                <tr>
                                    <td>{{ $item->uuid_user }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>@if ($item->foto)
                                        <a href="{{ asset('assets/images/' . $item->foto) }}" target="_blank">
                                            <button class="btn btn-outline-primary">Lihat Foto
                                            </button>    
                                        </a>
                                    @else
                                        Tidak ada foto
                                    @endif
                                    </td>
                                    <td class="green">
                                        <span class="badge {{ $item->is_verified ? 'bg-success' : 'bg-warning' }}">
                                            <i class="bi bi-check-circle me-1">
                                                
                                            </i>
                                            {{ $item->is_verified ? 'Verified' : 'Pending' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
