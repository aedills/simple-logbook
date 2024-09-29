@extends('admin/template/layout')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Aktifitas</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/user')}}">Home</a></li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-title">
                <h5 style="margin-left:20px">Semua Aktifitas</h5>
            </div>
            <form action="{{route('admin.aktifitas.filter')}}" method="get" id="filterForm">
                <div class="card-body row">
                    <div class="col-md-6">
                        <!-- Nama -->
                        <div class="row mb-3">
                            <label for="uuid" class="col-sm-2 col-form-label">Nama<span style="color: red;">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-select" name="uuid" id="uuid" required>
                                    <option value="all">Semua</option>
                                    @foreach($user as $usr)
                                    <option value="{{$usr->uuid}}" {{$usr->uuid == $form_uuid ? 'selected' : ''}}>{{$usr->nama}} ({{ucfirst($usr->role)}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Batas Awal -->
                        <div class="row mb-3">
                            <label for="from" class="col-sm-2 col-form-label">From<span style="color: red;">**</span></label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="from" id="from" value="{{$form_from ? $form_from : ''}}">
                            </div>
                        </div>

                        <!-- Batas Akhir -->
                        <div class="row mb-3">
                            <label for="to" class="col-sm-2 col-form-label">To<span style="color: red;">**</span></label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="to" id="to" value="{{$form_to ? $form_to : ''}}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <span style="color: red;">*</span><span style="font-style: italic; font-size: smaller;">Kolom ini wajib diisi. Harap isi informasi ini.</span><br>
                        <span style="color: red;">**</span><span style="font-style: italic; font-size: smaller;">Opsional.</span>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <button type="submit" form="filterForm" class="btn btn-outline-primary btn-sm">Tampilkan Aktifitas</button>
                    </div>
                </div>
            </form>
            <div class="card-body table-responsive">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Kegiatan</th>
                            <th>Keterangan</th>
                            <th>Foto</th>
                            <th>Verified By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($aktifitas as $item)
                        <tr>
                            <td>{{ $item->upload_by->nama }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ substr($item->keterangan, 0, 60) }}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    @if ($item->foto)
                                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal" data-bs-foto="{{ $item->foto }}">Lihat Foto</button>
                                    @else
                                    <span class="badge bg-warning"><i class="bi bi-x-circle-fill me-1"></i> Tidak ada foto</span>
                                    @endif
                                </div>
                            </td>
                            <td style="color: green;"><i class="bi bi-check-circle-fill"></i> {{ $item->verif_by->nama }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada aktifitas ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>

        <div class="modal fade" id="imageModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><strong>Foto Kegiatan</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="" id="image-preview" style="width: 85%;">
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
                $('#imageModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var filename = button.data('bs-foto');
                    var path = "{{ url('assets/aktifitasimages/') }}/"

                    var modal = $(this);
                    modal.find('#image-preview').attr('src', path + filename);
                });

                $('#from').on('change', function() {
                    var fromDate = $(this).val();
                    $('#to').attr('min', fromDate);
                });
            });
        </script>
    </section>

</main><!-- End #main -->
@endsection