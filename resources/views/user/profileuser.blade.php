@extends('user/template/layout')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div>

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="{{ url('assets/profiles/').'/'.$profile->foto }}" alt="{{ $profile->username }}" class="rounded-circle">
                        <h2>{{ $profile->nama }}</h2>
                        <h3>{{ $profile->username }} | {{ ucfirst($profile->role) }}</h3>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ganti Password</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Detail Profil</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nama</div>
                                    <div class="col-lg-9 col-md-8">{{$profile->nama}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Username</div>
                                    <div class="col-lg-9 col-md-8">{{$profile->username}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Role</div>
                                    <div class="col-lg-9 col-md-8">{{ucfirst($profile->role)}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Tanggal Mulai</div>
                                    <div class="col-lg-9 col-md-8">{{ \Carbon\Carbon::parse($profile->tgl_mulai)->format('d M Y') }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Tanggal Selesai</div>
                                    <div class="col-lg-9 col-md-8">{{ \Carbon\Carbon::parse($profile->tgl_selesai)->format('d M Y') }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Jumlah Aktifitas</div>
                                    @if($pending > 0)
                                    <div class="col-lg-9 col-md-8">{{ $aktifitas }} ({{$pending}} pending)</div>
                                    @else
                                    <div class="col-lg-9 col-md-8">{{ $aktifitas }}</div>
                                    @endif
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form action="{{ route('user.updateProfile') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Foto Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img id="profileImage" src="{{ url('assets/profiles/').'/'.$profile->foto }}" alt="{{ $profile->username }}">
                                            <div class="pt-2">
                                                <input type="file" name="profile" id="profile" accept="image/*" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="nama" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="nama" type="text" class="form-control" id="nama" value="{{$profile->nama}}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="username" type="text" class="form-control" id="username" value="{{$profile->username}}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-md-4 col-lg-3 col-form-label">Tanggal Mulai</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($profile->tgl_mulai)->format('d M Y') }}" disabled>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-md-4 col-lg-3 col-form-label">Tanggal Selesai</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($profile->tgl_selesai)->format('d M Y') }}" disabled>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-md-4 col-lg-3 col-form-label">Role</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" value="{{ ucfirst($profile->role) }}" disabled>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <form action="{{ route('auth.updatePassword') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password Sekarang</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="input-group">
                                                <input name="currentPassword" type="password" class="form-control" id="currentPassword">
                                                <span class="input-group-text eye"><i class="bi bi-eye-fill"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="input-group">
                                                <input name="newPassword" type="password" class="form-control" id="newPassword">
                                                <span class="input-group-text eye"><i class="bi bi-eye-fill"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPasswordConfirm" class="col-md-4 col-lg-3 col-form-label">Konfirmasi</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="input-group">
                                                <input name="newPasswordConfirm" type="password" class="form-control" id="newPasswordConfirm">
                                                <span class="input-group-text eye"><i class="bi bi-eye-fill"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" id="passSubmitButton" class="btn btn-primary">Ganti Password</button>
                                    </div>
                                </form>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            function toggleNewPasswordFields() {
                let currentPasswordVal = $("#currentPassword").val();

                if (currentPasswordVal === "") {
                    $("#newPassword, #newPasswordConfirm").attr("disabled", true);
                } else {
                    $("#newPassword, #newPasswordConfirm").removeAttr("disabled");
                }
            }

            function validatePasswords() {
                let newPasswordVal = $("#newPassword").val();
                let newPasswordConfirmVal = $("#newPasswordConfirm").val();
                let submitButton = $("#passSubmitButton");

                if (newPasswordVal === "" || newPasswordConfirmVal === "" || newPasswordVal !== newPasswordConfirmVal) {
                    submitButton.attr("disabled", true);
                } else {
                    submitButton.removeAttr("disabled");
                }
            }

            toggleNewPasswordFields();
            validatePasswords();

            $("#currentPassword").on('input', function() {
                toggleNewPasswordFields();
            });

            $("#newPassword, #newPasswordConfirm").on('input', function() {
                validatePasswords();
            });

            $(".eye").on('click', function() {
                let inputField = $(this).prev('input');
                let icon = $(this).find('i');

                if (inputField.attr("type") === "password") {
                    inputField.attr("type", "text");
                    icon.removeClass("bi-eye-fill").addClass("bi-eye-slash-fill");
                } else {
                    inputField.attr("type", "password");
                    icon.removeClass("bi-eye-slash-fill").addClass("bi-eye-fill");
                }
            });

            $('#profile').on('change', function(event) {
                const file = event.target.files[0];

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#profileImage').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>

</main>

@endsection