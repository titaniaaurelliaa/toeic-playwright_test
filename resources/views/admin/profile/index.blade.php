@extends('layouts_admin.template')

@section('title', 'Profil Admin')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container-fluid mt-4">
        <!-- Header Profile -->
        <div class="row">
            <div class="col-lg-12 position-relative">
                <!-- Banner -->
                <img src="{{ asset('landingpage/img/bg.png') }}" class="img-fluid w-100" alt="Banner Image"
                    style="opacity: 0.8; height: 200px; object-fit: cover;">

                <!-- Foto Profil -->
                <div class="profile-picture">
                    @if (auth()->user()->admin->foto_profil)
                        <img src="{{ asset('storage/profile_pictures/foto_user_' . auth()->id() . '.' . pathinfo(auth()->user()->admin->foto_profil, PATHINFO_EXTENSION)) }}"
                            alt="Profile Picture" class="img-fluid rounded-circle shadow">
                    @else
                        <img src="{{ asset('landingpage/img/team-1.jpg') }}" alt="Profile Picture"
                            class="img-fluid rounded-circle shadow">
                    @endif
                </div>
            </div>
        </div>

        <!-- Tab Menu -->
        <ul class="nav nav-tabs mt-4" id="profileTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab">Detail
                    Profil</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="editProfile-tab" data-bs-toggle="tab" href="#editProfile" role="tab">Edit
                    Profil</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="changePassword-tab" data-bs-toggle="tab" href="#changePassword" role="tab">Ubah
                    Password</a>
            </li>
        </ul>

        <!-- Isi Tab -->
        <div class="tab-content mt-3" id="profileTabsContent">
            <!-- Overview -->
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5>Detail Profil</h5>
                    </div>
                    <div class="card-body">
                        @auth
                            @if (auth()->user()->admin)
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ auth()->user()->admin->admin_nama }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ auth()->user()->admin->email }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ auth()->user()->admin->no_telp }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat"
                                        value="{{ auth()->user()->admin->alamat }}" readonly>
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        value="{{ auth()->user()->admin->username }}" readonly>
                                </div> --}}
                            @endif
                        @endauth
                    </div>
                </div>
            </div>

            @include('admin.profile.edit')

            @include('admin.profile.change_password')
        </div>
    </div>
@endsection

<style>
    .profile-picture {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 140px;
        height: 140px;
        border: 5px solid white;
        border-radius: 50%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        z-index: 10;
    }

    .profile-picture img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .img-thumbnail {
        max-width: 150px;
        max-height: 150px;
        border-radius: 50%;
    }
</style>
@section('styles')
    <style>
        .document-box {
            position: relative;
            width: 259px;
            height: 304px;
            background: white;
            border: 1px solid #AEB1B6;
            padding: 10px;
        }

        .document-box img {
            width: 100%;
            /* Adjust to 100% to take full width of the container */
            height: auto;
            /* Maintain aspect ratio */
            margin: 0 auto;
            display: block;
        }
    </style>
@endsection
