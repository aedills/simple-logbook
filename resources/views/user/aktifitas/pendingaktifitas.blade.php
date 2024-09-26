@extends('user/template/layout')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>{{$title}}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('user.dashboarduser')}}">Home</a></li>
                <li class="breadcrumb-item active">Pending</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @if (empty($pending->aktifitas))
                <div class="text-center">
                    <h5 class="card-title text-center">Anda Belum Upload Aktifitas</h5>
                </div>
                @else
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Pending Aktifitas
                                    @if($total > 0)
                                    <span>({{$total}} total aktifitas)</span>
                                    @endif
                                </h5>
                            </div>
                        </div>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th style="width: 8%;">Foto</th>
                                        <th style="width: 15%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pending->aktifitas as $list)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($list->tanggal)->format('d-M-Y') }}</td>
                                        <td>{{$list->judul}}</td>
                                        <td>{{$list->keterangan}}</td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal" data-bs-foto="{{$list->foto}}"><i class="bi bi-eye me-1"></i> Lihat</button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center gap-1">
                                                <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" data-bs-id="{{$list->id}}" data-bs-judul="{{$list->judul}}" data-bs-keterangan="{{$list->keterangan}}" data-bs-tanggal="{{$list->tanggal}}" data-bs-foto="{{$list->foto}}"><i class="bi bi-pencil"></i> Edit</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal" data-bs-id="{{$list->id}}" data-bs-judul="{{$list->judul}}"><i class="bi bi-trash"></i> Batal Ajukan</button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Foto</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="" id="image-preview" style="width: 85%;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Aktifitas Pending -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Foto</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" enctype="multipart/form-data" action="{{ route('user.aktifitasuser.upload.update') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="judul">Judul Kegiatan</label>
                            <div class="col-sm-10">
                                <input required name="judul" type="text" class="form-control" id="judul">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="deskripsi">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea required name="deskripsi" id="deskripsi" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="gambar">Gambar</label>
                            <div class="col-sm-10">
                                <input required name="gambar" class="form-control" type="file" id="gambar" accept="image/*" onchange="previewImage(event)">
                            </div>
                        </div>
                        <div class="row mb-3" id="imgPreviewContainer">
                            <label class="col-sm-2 col-form-label" for="imgPreview">Foto</label>
                            <div class="col-sm-10 img-container">
                                <img id="imgPreview" class="img-preview" src="#" alt="Image Preview" style="width: 30%;">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="tanggal">Tanggal</label>
                            <div class="col-sm-10">
                                <input required name="tanggal" type="date" class="form-control" id="tanggal" min="{{session('tgl_mulai')}}" max="{{ \Carbon\Carbon::now()->format('Y-m-d') < session('tgl_selesai') ? \Carbon\Carbon::now()->format('Y-m-d') : session('tgl_selesai') }}">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="editForm" class="btn btn-sm btn-outline-primary">Simpan</button>
                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>



</main>

<script>
    $(document).ready(function() {
        $('#imageModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var filename = button.data('bs-foto');
            var path = "{{url('assets/aktifitasimages/')}}/";

            var modal = $(this);
            modal.find('#image-preview').attr('src', path + filename);
        });

        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);

            var id = button.data('bs-id');
            var judul = button.data('bs-judul');
            var keterangan = button.data('bs-keterangan');
            var tanggal = button.data('bs-tanggal');
            var filename = button.data('bs-foto');

            var modal = $(this);
            var path = "{{ url('assets/aktifitasimages/') }}/"

            modal.find('#id').val(id);
            modal.find('input[name=judul]').val(judul);
            modal.find('textarea[name=deskripsi]').text(keterangan);
            modal.find('input[name=tanggal]').val(tanggal);
            modal.find('#imgPreview').attr('src', path + filename);
        });
    });

    function previewImage(event) {
        var input = event.target;
        var imgPreview = document.getElementById('imgPreview');
        var imgPreviewContainer = document.getElementById('imgPreviewContainer');

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                imgPreview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function redirectDownload() {
        const url = "{{url('')}}/user/aktifitasuser/download-pdf/" + "{{session('uuid')}}"
        window.location.href = url;
    }
</script>

@endsection