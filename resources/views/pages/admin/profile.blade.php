@extends('layout.main')

@push('title')
    <title>Admin Profile</title>
@endpush

@section('main-section')
    <div class="container bg-white my-4">
        <div class="row d-flex align-items-start justify-content-center">
            <div class="col-md-4">
                <div class="d-flex flex-column align-items-center gap-2 p-3">
                    <img width="150px" src="{{ asset("uploads/$admin->photo") }}">

                    <form action="{{ route('update_admin_profile') }}" method="POST" enctype="multipart/form-data"
                        class="d-flex flex-column gap-2 mt-2">
                        @csrf

                        <input type="hidden" name="admin_id" value="{{ $admin->admin_id }}">

                        <input id="file-upload" type="file" name="photo" class="btn btn-secondary btn-sm" required>

                        @error('photo')
                            <p class="text-danger" style="font-size: 14px">{{ $message }}</p>
                        @enderror

                        <button class="btn btn-primary btn-sm d-flex align-items-center justify-content-center gap-2"
                            type="submit">
                            <i class="bi bi-cloud-arrow-up-fill" style="font-size: 1.25rem"></i> Upload
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="px-2 py-4">
                    <div class="d-flex flex-column align-items-start gap-3">
                        <h4 class="text-right">Admin Profile</h4>
                        <form action="{{ route('update_admin_profile') }}" method= "POST" class="w-100">
                            @csrf

                            <input type="hidden" name="admin_id" value="{{ $admin->admin_id }}">

                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" name="name" value="{{ $admin->name }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone:</label>
                                <input type="text" class="form-control" name="phone" value="{{ $admin->phone }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" name="email" value="{{ $admin->email }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" name="password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary my-auto mx-1">Update Profile</button>
                                <a href="{{ url('/') }}" class="btn btn-secondary my-auto mx-1"
                                    role="button">
                                    Go to Home</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
