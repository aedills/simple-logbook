@extends('user/template/layout')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>{{$title}}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('user.dashboarduser')}}">Home</a></li>
                <li class="breadcrumb-item active">History</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @if (empty($history->aktifitas))
                    <div class="d-flex justify-content-center align-items-center">
                        <h3 class="text-center">Kamu belum upload aktifitias / Aktifitas kamu belum diverifikasi</h3>
                    </div>
                @else
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">History Aktifitas</h5>
                        </div>

                        <!-- Table with stripped rows -->
                        
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Foto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($history->aktifitas as $list)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($list->tanggal)->format('d-m-Y') }}</td>
                                        <td>{{$list->judul}}</td>
                                        <td>{{$list->keterangan}}</td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal" data-bs-foto="{{$list->foto}}"><i class="bi bi-eye me-1"></i> Lihat</button>
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

    {{-- Image Modal --}}
    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Foto</strong></h5>
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



</main>

<script>
    $(document).ready(function() {
        $('#imageModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var filename = button.data('bs-foto');
            var path = "{{url('assets/aktifitasimages/')}}/";

            console.log("Image URL:", path + filename); // Debugging line

            var modal = $(this);
            modal.find('#image-preview').attr('src', path + filename);
        });
});

</script>

@endsection