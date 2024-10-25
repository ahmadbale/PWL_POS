{{-- @extends('layouts.template')
@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-3">
                <div class="card shadow border-0 rounded-lg mb-4 hover-shadow">
                    <div class="card-body text-center p-4">
                        <div class="position-relative d-inline-block mb-3">
                            @if ($user->profile_image)
                                <img src="{{ asset('storage/photos/' . $user->profile_image) }}"
                                    class="img-fluid rounded-circle shadow mb-3"
                                    style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #ffffff; box-shadow: 0 0 20px rgba(0,0,0,0.1);">
                            @else
                                <img src="{{ asset('/public/img/polinema-bw.png') }}"
                                    class="img-fluid rounded-circle shadow mb-3"
                                    style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #ffffff; box-shadow: 0 0 20px rgba(0,0,0,0.1);">
                            @endif
                        </div>
                        <h4 class="fw-bold mb-1">{{ $user->nama }}</h4>
                        <p class="text-muted mb-0">
                            <i class="fas fa-user-circle me-1"></i>
                            {{ $user->username }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card shadow border-0 rounded-lg">
                    <div class="card-header bg-gradient-primary text-white py-4">
                        <h4 class="mb-0 text-center">
                            <i class="fas fa-user-edit me-2"></i>
                            <b>Edit Biodata</b>
                        </h4>
                    </div>
                    <div class="card-body p-5">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('profile.update', $user->user_id) }}"
                            enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label fw-bold">
                                        <i class="fas fa-at me-1"></i>
                                        {{ __('Username') }}
                                    </label>
                                    <input id="username" type="text"
                                        class="form-control form-control-lg shadow-sm @error('username') is-invalid @enderror"
                                        name="username" value="{{ $user->username }}" required
                                        autocomplete="username" placeholder="Enter your username">
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="nama" class="form-label fw-bold">
                                        <i class="fas fa-user me-1"></i>
                                        {{ __('Nama Lengkap') }}
                                    </label>
                                    <input id="nama" type="text"
                                        class="form-control form-control-lg shadow-sm @error('nama') is-invalid @enderror"
                                        name="nama" value="{{ old('nama', $user->nama) }}" required
                                        autocomplete="nama" placeholder="Enter your full name">
                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <h5 class="mb-3 text-muted">
                                        <i class="fas fa-lock me-1"></i>
                                        Ubah Password
                                    </h5>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label fw-bold">
                                        <i class="fas fa-lock me-1"></i>
                                        {{ __('Password Baru') }}
                                    </label>
                                    <input id="password" type="password"
                                        class="form-control form-control-lg shadow-sm @error('password') is-invalid @enderror"
                                        name="password" autocomplete="new-password"
                                        placeholder="Masukkan password baru">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12 mb-3">
                                    <label for="profile_image" class="form-label fw-bold">
                                        <i class="fas fa-image me-1"></i>
                                        {{ __('Foto Profil') }}
                                    </label>
                                    <input id="profile_image" type="file" 
                                        class="form-control form-control-lg shadow-sm"
                                        name="profile_image">
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Upload foto dengan format JPG, PNG, atau GIF (max. 2MB)
                                    </div>
                                </div>
                            </div>

                            <div class="text-end mt-4">
                                <button type="button" class="btn btn-light btn-lg me-2">
                                    <i class="fas fa-times me-1"></i>
                                    {{ __('Batal') }}
                                </button>
                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    <i class="fas fa-save me-1"></i>
                                    {{ __('Simpan Perubahan') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}

@extends('layouts.template')
@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card shadow border-0 rounded-lg mb-4">
                    <div class="card-body p-5">
                        <div class="row">
                            <!-- Bagian Foto Profil dan Nama -->
                            <div class="col-lg-4 text-center">
                                <div class="position-relative d-inline-block mb-3">
                                    @if ($user->profile_image)
                                        <img src="{{ asset('storage/photos/' . $user->profile_image) }}"
                                            class="img-fluid rounded-circle shadow mb-3"
                                            style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #ffffff; box-shadow: 0 0 20px rgba(0,0,0,0.1);">
                                    @else
                                        <img src="{{ asset('/public/img/polinema-bw.png') }}"
                                            class="img-fluid rounded-circle shadow mb-3"
                                            style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #ffffff; box-shadow: 0 0 20px rgba(0,0,0,0.1);">
                                    @endif
                                </div>
                                <h4 class="fw-bold mb-1">{{ $user->nama }}</h4>
                                <p class="text-muted mb-0">
                                    {{ $user->username }}
                                </p>
                            </div>

                            <!-- Bagian Biodata -->
                            <div class="col-lg-8">
                                <h4 class="text-center mb-4">
                                    <i class="fas fa-user-edit me-2"></i>
                                    <b>Edit Biodata</b>
                                </h4>

                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fas fa-check-circle me-2"></i>
                                        {{ session('status') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('profile.update', $user->user_id) }}"
                                    enctype="multipart/form-data">
                                    @method('PATCH')
                                    @csrf
                                    
                                    <div class="row">
                                        <!-- Username -->
                                        <div class="col-md-6 mb-3">
                                            <label for="username" class="form-label fw-bold">
                                                {{ __('Username') }}
                                            </label>
                                            <input id="username" type="text"
                                                class="form-control form-control-lg shadow-sm @error('username') is-invalid @enderror"
                                                name="username" value="{{ $user->username }}" required
                                                autocomplete="username" placeholder="Enter your username">
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Nama Lengkap -->
                                        <div class="col-md-6 mb-3">
                                            <label for="nama" class="form-label fw-bold">
                                                <i class="fas fa-user me-1"></i>
                                                {{ __('Nama Lengkap') }}
                                            </label>
                                            <input id="nama" type="text"
                                                class="form-control form-control-lg shadow-sm @error('nama') is-invalid @enderror"
                                                name="nama" value="{{ old('nama', $user->nama) }}" required
                                                autocomplete="nama" placeholder="Enter your full name">
                                            @error('nama')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="password" class="form-label fw-bold">
                                                <i class="fas fa-lock me-1"></i>
                                                {{ __('Password Baru') }}
                                            </label>
                                            <input id="password" type="password"
                                                class="form-control form-control-lg shadow-sm @error('password') is-invalid @enderror"
                                                name="password" 
                                                autocomplete="new-password"
                                                placeholder="Masukkan password ">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Upload Foto Profil -->
                                        <div class="col-md-6 mb-3">
                                            <label for="profile_image" class="form-label fw-bold">
                                                <i class="fas fa-image me-1"></i>
                                                {{ __('Foto Profil') }}
                                            </label>
                                            <input id="profile_image" type="file" 
                                                class="form-control form-control-lg shadow-sm"
                                                name="profile_image">
                                            <div class="form-text">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Upload foto dengan format JPG, PNG, atau GIF (max. 2MB)
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tombol Submit -->
                                    <div class="text-end mt-4">
                                        {{-- <button type="button" class="btn btn-light btn-lg me-2">
                                            <i class="fas fa-times me-1"></i>
                                            {{ __('Batal') }}
                                        </button> --}}
                                        <button type="submit" class="btn btn-primary btn-lg px-4">
                                            <i class="fas fa-save me-1"></i>
                                            {{ __('Simpan Perubahan') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
