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
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="{{ route('user.aktifitasuser.upload.store') }}" method="POST" class="p-4">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Judul Kegiatan</label>
                                <input required name="judul" type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Masukkan judul kegiatan">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Deskripsi</label>
                                <input required name="deskripsi" type="text" class="form-control" id="exampleInputPassword1"
                                    placeholder="Jelaskan kegiatan kamu">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Gambar</label>
                                <input required name="gambar" class="form-control" type="file" id="formFile"
                                    onchange="previewImage(event)">
                            </div>
                            <div class="img-container">
                                <img id="imgPreview" class="img-preview" src="#" alt="Image Preview"
                                    style="display: none;">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tanggal</label>
                                <input required name="tanggal" type="date" class="form-control" id="tanggal">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
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

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imgPreview.src = e.target.result;
                imgPreview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    const dateInput = document.getElementById('tanggal');
    const today = new Date();
    const formattedDate = today.toISOString().split('T')[0];
    dateInput.min = formattedDate;

    dateInput.addEventListener('change', function() {
        console.log(dateInput.value);
    });
</script>

@endsection