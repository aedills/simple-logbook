@extends('admin/template/layout')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ $title }}</h1>
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
                    <h5 style="margin-left:20px">Semua Aktifitas Pending</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Judul</th>
                                    <th>Keterangan</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($aktifitas as $item)
                                    <tr>
                                        <td>{{ $item->uuid_user }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ substr($item->keterangan, 0, 60) }}</td>
                                        <td>
                                            @if ($item->foto)
                                                <button type="button" class="btn btn-outline-success btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#imageModal"
                                                    data-bs-foto="{{ $item->foto }}">Lihat Foto
                                                </button>
                                            @else
                                                Tidak ada foto
                                            @endif
                                        </td>
                                        <td class="green">
                                            <span type=""
                                                class="badge {{ $item->is_verified ? 'bg-success' : 'bg-warning text-dark' }}">
                                                <i class="bi bi-exclamation-triangle me-1">
                                                </i>
                                                {{ $item->is_verified ? 'Verified' : 'Pending' }}
                                            </span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                                data-bs-target="#verifModal" data-bs-id="{{ $item->id }}" data-bs-judul="{{ $item->judul}}"> Verifikasi
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Tidak ada aktifitas pending</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="modal fade" id="imageModal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><strong>Foto Kegiatan</strong></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <img src="" id="image-preview" style="width: 40%;">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                            data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Verif Modal  --}}
                        <div class="modal fade" id="verifModal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><strong>Apakah Anda yakin ingin memverifikasi
                                                <span></span> ?</strong></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="verifForm" action="{{ route('admin.aktifitas.update') }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" name="id" id="id" value="" hidden>
                                    </form>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" form="verifForm"
                                            class="btn btn-sm btn-outline-danger">Verifikasi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $('#imageModal').on('show.bs.modal', function(event) {
                        var button = $(event.relatedTarget);
                        var filename = button.data('bs-foto');
                        var path = "{{ url('assets/images/') }}/"

                        var modal = $(this);
                        modal.find('#image-preview').attr('src', path + filename);
                    });

                    $('#verifModal').on('show.bs.modal', function(event) {
                        var button = $(event.relatedTarget);
                        var nama = button.data('bs-judul');
                        var id = button.data('bs-id');
                        var modal = $(this);
                        modal.find('span').text(nama);
                        modal.find('#id').val(id); // Ganti uuid dengan id

                    });
                });
            </script>
        </section>
    </main><!-- End #main -->
@endsection
