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
                <input type="text" class="form-control" name="name" value="{{ old('name',  $employee->name ?? '') }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" value="{{ old('email',$employee->email ?? '' ) }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" class="form-control" name="phone" value="{{ old('phone', $employee->phone ?? '') }}">
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="role" class="form-label">Role:</label>
                <select name="role" class="form-control">
                    <option value="">Select</option>
                    <option value="intern" {{ strtolower($employee->role) === 'intern' ? 'selected' : null }}>Intern</option>
                    <option value="bda" {{ strtolower($employee->role) === 'bda' ? 'selected' : null }}>BDA</option>
                    <option value="team lead" {{ strtolower($employee->role) === 'team lead' ? 'selected' : null }}>Team Lead</option>
                    <option value="senior team lead" {{ strtolower($employee->role) === 'senior team lead' ? 'selected' : null }}>
                        Senior Team Lead
                    </option>
                    <option value="senior manager" {{ strtolower($employee->role) === 'senior manager' ? 'selected' : null }}>Senior
                        Manager
                    </option>
                </select>
                @error('role')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="deptId" class="form-label">Department:</label>
                <select name="deptId" class="form-control">
                    <option value="">Select</option>
                    <option value="1" {{ $employee->deptId == '1' ? 'selected' : null }}>Pre Sales</option>
                    <option value="2" {{ $employee->deptId == '2' ? 'selected' : null }}>Post Sales</option>
                    <option value="3" {{ $employee->deptId == '3' ? 'selected' : null }}>Lead Generation</option>
                    <option value="4" {{ $employee->deptId == '4' ? 'selected' : null }}>Technical</option>
                    <option value="5" {{ $employee->deptId == '5' ? 'selected' : null }}>Human Resource</option>
                </select>
                @error('deptId')
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
