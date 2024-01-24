@extends('layout.main')

@push('css')
    <link rel="stylesheet" href="{{ asset('styles/employeeForm.css') }}">
@endpush

@push('title')
    <title>Employee Form</title>
@endpush

@section('main-section')
    <section class="form-section-bg">
        <h4>Employees Form</h4>
        <form action="{{ url($route) }}" method="POST" class="form-main-div">
            @csrf
            <div>
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" name="name" 
                value="{{ $employee->name }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" 
                value="{{ $employee->email }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="contactNo" class="form-label">Contact No:</label>
                <input type="text" class="form-control" name="contactNo" 
                value="{{ $employee->contactNo }}">
                @error('contactNo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="actions-btn-div">
                <button type="submit" class="submit-btn">Submit</button>
                <a href="{{ url('/') }}" class="back-btn">Back</a>
            </div>
        </form>
    </section>
@endsection
