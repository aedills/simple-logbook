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
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal"><i class="bi bi-plus-lg me-1"></i> Add</button>
                        </div>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable" id="stafTable">
                                <thead>
                                    <tr>
                                        <th>
                                            <b>N</b>ama
                                        </th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th class="sorting: false" style="width: 10%;">Foto</th>
                                        <th class="sorting: false" style="width: 15%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($staf as $list)
                                    <tr>
                                        <td>{{$list->nama}}</td>
                                        <td>{{$list->username}}</td>
                                        <td>{{ucfirst($list->role)}}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal" data-bs-foto="{{$list->foto}}"><i class="bi bi-eye me-1"></i> Lihat</button>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" data-bs-id="{{$list->id}}" data-bs-nama="{{$list->nama}}" data-bs-username="{{$list->username}}" data-bs-role="{{$list->role}}" data-bs-foto="{{$list->foto}}"><i class="bi bi-pencil me-1"></i> Edit</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-id="{{$list->id}}" data-bs-nama="{{$list->nama}}"><i class="bi bi-trash me-1"></i> Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Create Modal -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Tambah Staf</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addForm" action="{{route('admin.datauser.staf.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" id="nama" class="form-control" required placeholder="Masukkan Nama Staf" maxlength="100">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" name="username" id="username" class="form-control" required placeholder="Masukkan username" maxlength="25">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="role" class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="role" id="role">
                                    <option value="staf">Staf/Dosen</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="profile" class="col-sm-2 col-form-label">Foto Profile</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="profile" name="profile">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" form="addForm" class="btn btn-sm btn-outline-primary">Tambah</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Edit Staf</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="{{route('admin.datauser.staf.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" id="id" name="id" value="" hidden>
                        <div class="row mb-3">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" id="nama" class="form-control" required placeholder="Masukkan Nama Staf" maxlength="100" value="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" name="username" id="username" class="form-control" required placeholder="Masukkan username" maxlength="25" value="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="role" class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="role" id="role">
                                    <option value="staf">Staf/Dosen</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="profile" class="col-sm-2 col-form-label">Foto Profile</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="profile" name="profile">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" form="editForm" class="btn btn-sm btn-outline-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Apakah Anda yakin ingin menghapus <span>Cuki</span> ?</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="deleteForm" action="{{route('admin.datauser.staf.delete')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="id" id="id" value="" hidden>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" form="deleteForm" class="btn btn-sm btn-outline-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Foto Profile</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="" id="image-preview" style="width: 40%;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('bs-id');
                var nama = button.data('bs-nama');
                var username = button.data('bs-username');
                var role = button.data('bs-role');
                var foto = button.data('bs-foto');

                var modal = $(this);
                modal.find('#id').val(id);
                modal.find('#nama').val(nama);
                modal.find('#username').val(username);
                modal.find('#role').val(role);
            });

            $('#deleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var nama = button.data('bs-nama');
                var id = button.data('bs-id');

                var modal = $(this);
                modal.find('span').text(nama);
                modal.find('#id').val(id);
            });

            $('#imageModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var filename = button.data('bs-foto');
                var path = "{{url('assets/profiles/')}}/"

                var modal = $(this);
                modal.find('#image-preview').attr('src', path + filename);
            });

            $('#stafTable').DataTable({
                "columnDefs": [{
                    "orderable": false,
                    "targets": [3, 4]
                }]
            });
        });
    </script>

</main>

@endsection