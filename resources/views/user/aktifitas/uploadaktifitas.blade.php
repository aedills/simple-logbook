@extends('user/template/layout')

@section('content')
<style>
    .img-preview {
        max-width: 20%;
        height: auto;
        margin-top: 10px;
    }
</style>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>{{$title}}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('user.dashboarduser')}}">Home</a></li>
                <li class="breadcrumb-item active">Upload</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Upload Aktifitas/Kegiatan</h5>
                        </div>
                        <form id="aktifitasForm" enctype="multipart/form-data" action="{{ route('user.aktifitasuser.upload.store') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="judul">Judul Kegiatan</label>
                                <div class="col-sm-10">
                                    <input required name="judul" type="text" class="form-control" id="judul" placeholder="Masukkan judul kegiatan">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="deskripsi">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea required name="deskripsi" id="deskripsi" rows="3" placeholder="Jelaskan kegiatan kamu" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="gambar">Gambar</label>
                                <div class="col-sm-10">
                                    <input required name="gambar" class="form-control" type="file" id="formFile" accept="image/*" onchange="previewImage(event)">
                                </div>
                            </div>
                            <div class="row mb-3" style="display: none;" id="imgPreviewContainer">
                                <label class="col-sm-2 col-form-label">Preview</label>
                                <div class="col-sm-10 img-container">
                                    <img id="imgPreview" class="img-preview" src="#" alt="Image Preview" style="display: none;">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tanggal">Tanggal</label>
                                <div class="col-sm-10">
                                    <input required name="tanggal" type="date" class="form-control" id="tanggal" min="{{session('tgl_mulai')}}" max="{{session('tgl_selesai')}}" value="{{ now()->format('Y-m-d') }}">
                                </div>
                            </div>
                        </form>
                        <div class="d-flex justify-content-end align-items-end">
                            <button type="submit" form="aktifitasForm" class="btn btn-primary">Upload</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    function previewImage(event) {
        const input = event.target;
        const imgPreview = document.getElementById('imgPreview');
        const imgPreviewContainer = document.getElementById('imgPreviewContainer');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imgPreview.src = e.target.result;
                imgPreview.style.display = 'block';
                imgPreviewContainer.removeAttribute('style');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // const dateInput = document.getElementById('tanggal');
    // const today = new Date();
    // const formattedDate = today.toISOString().split('T')[0];
    // dateInput.min = formattedDate;

    // dateInput.addEventListener('change', function() {
    //     console.log(dateInput.value);
    // });
</script>

@endsection