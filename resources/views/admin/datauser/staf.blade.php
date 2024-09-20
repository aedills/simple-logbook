@extends('admin/template/layout')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>{{$title}}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Data User</a></li>
                <li class="breadcrumb-item active">Staf</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Managemen Data Staf</h5>
                            <button type="button" class="btn btn-outline-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> Add</button>
                        </div>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>
                                        <b>N</b>ama
                                    </th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Foto</th>
                                    <th style="width: 15%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Zaedil Febriansyah</td>
                                    <td>aedils</td>
                                    <td>Admin</td>
                                    <td>Foto</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <button type="button" class="btn btn-outline-info btn-sm"><i class="bi bi-pencil me-1"></i> Edit</button>
                                            <button type="button" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash me-1"></i> Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </section>



</main>

@endsection