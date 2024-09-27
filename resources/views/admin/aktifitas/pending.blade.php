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
                <div class="card-body table-responsive">
                    <form id="bulkUpdate" action="{{route('admin.aktifitas.updateBulk')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="action" id="action" value="" hidden>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>?</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Judul</th>
                                    <th>Keterangan</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                    <th style="width: 14%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($aktifitas as $item)
                                <tr>
                                    <td><input class="inputCheck" type="checkbox" name="pendingItem[]" id="pendingItem{{$item->id}}" value="{{$item->id}}"></td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
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
                                    <td class="green">
                                        <span type="" class="badge {{ $item->is_verified ? 'bg-success' : 'bg-warning text-dark' }}">
                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                            {{ $item->is_verified ? 'Verified' : 'Pending' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center gap-1">
                                            <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#verifModal" data-bs-id="{{ $item->id }}" data-bs-judul="{{ $item->judul}}"> Verifikasi</button>
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#declineModal" data-bs-id="{{ $item->id }}" data-bs-judul="{{ $item->judul}}"> Tolak</button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada aktifitas pending</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" id="selectAll" class="btn btn-sm btn-outline-primary">Pilih Semua</button>
                            <div>
                                <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#verifBulkModal" data-bs-action="accept"> Verifikasi</button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#verifBulkModal" data-bs-action="decline"> Tolak</button>
                            </div>
                        </div>
                    </form>



                    <!-- Image Modal -->
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

                    <!-- Verif Modal -->
                    <div class="modal fade" id="verifModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Apakah Anda yakin ingin memverifikasi <strong><span></span></strong> ?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form id="verifForm" action="{{ route('admin.aktifitas.update') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="text" name="id" id="id" value="" hidden>
                                </form>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" form="verifForm" class="btn btn-sm btn-outline-success">Verivikasi</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Verif Bulk Modal -->
                    <div class="modal fade" id="verifBulkModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><strong></strong></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" form="bulkUpdate" class="btn btn-sm btn-outline-success">Ya, Yakin.</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Decline -->
                    <div class="modal fade" id="declineModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tolak ajuan verifikasi kegiatan <strong><span></span> </strong>?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form id="verifDeleteForm" action="{{ route('admin.aktifitas.delete') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="text" name="id" id="id" value="" hidden>
                                </form>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" form="verifDeleteForm" class="btn btn-sm btn-outline-danger">Tolak</button>
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
                    var path = "{{ url('assets/aktifitasimages/') }}/"

                    var modal = $(this);
                    modal.find('#image-preview').attr('src', path + filename);
                });

                $('#selectAll').on('click', function() {
                    var form = $('#bulkUpdate');
                    var checkBox = form.find('input[type=checkbox]');
                    var isChecked = checkBox.prop('checked');
                    checkBox.prop('checked', !isChecked);

                    if (!isChecked) {
                        $(this).removeClass('btn-outline-primary').addClass('btn-primary');
                    } else {
                        $(this).removeClass('btn-primary').addClass('btn-outline-primary');
                    }
                });

                $('#verifModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var nama = button.data('bs-judul');
                    var id = button.data('bs-id');
                    var modal = $(this);
                    modal.find('span').text(nama);
                    modal.find('#id').val(id);
                });

                $('#verifBulkModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var action = button.data('bs-action');

                    var modal = $(this);
                    var textDisplay = "";

                    if (action == 'accept') {
                        textDisplay = "Apakah Anda yakin ingin memverifikasi semua item yang dipilih?";
                    } else {
                        textDisplay = "Apakah Anda yakin ingin menolak semua item yang dipilih?";
                    }

                    modal.find('strong').text(textDisplay);

                    var form = $('#bulkUpdate');
                    form.find('input[name=action]').val(action);
                });

                $('#declineModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var nama = button.data('bs-judul');
                    var id = button.data('bs-id');
                    var modal = $(this);
                    modal.find('span').text(nama);
                    modal.find('#id').val(id);
                });
            });
        </script>
    </section>
</main><!-- End #main -->
@endsection