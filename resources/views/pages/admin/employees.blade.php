@extends('layout.main')

@push('css')
    <link rel="stylesheet" href="{{ asset('styles/employees.css') }}">
@endpush

@push('title')
    <title>Employees</title>
@endpush

@section('main-section')
    <div class="table-responsive m-3">

        <div class="container-fluid py-2 d-flex align-items-center justify-content-between">
            <form action="" class="d-flex align-items-center gap-2">
                <input type="search" name="search" value="{{ $search }}" placeholder="Search name:"
                    class="px-2 py-1 rounded-2 border border-secondary" />
                <button type="submit" class="btn btn-primary">Search</button>
                <a class="btn btn-danger" href="{{ url('/') }}" role="button">
                    Reset
                </a>
            </form>

            <div class="btn-actions-div">
                <a class="btn btn-primary mb-1 px-4" href="{{ url('/create') }}" role="button">
                    ADD
                </a>

                <a class="btn btn-danger mb-1 px-4" href="{{ url('/trash') }}" role="button">
                    View Trash
                </a>
            </div>
        </div>

        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th class="row-headings">Name</th>
                    <th class="row-headings">Email</th>
                    <th class="row-headings">Phone</th>
                    <th class="row-headings">Role</th>
                    <th class="row-headings">Department</th>
                    <th class="row-headings">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>
                            @if($employee->role)
                                {{ $employee->role }}
                            @else
                                NA
                            @endif
                        </td>
                        <td>
                            @if ($employee->department)
                                {{ ucwords($employee->department->dept_name) }}
                            @else
                                NA
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('/edit') }}/{{ $employee->eid }}">
                                <button class="btn btn-primary px-3">
                                    Edit
                                </button>
                            </a>
                            &nbsp;
                            <a href="{{ url('/delete') }}/{{ $employee->eid }}">
                                <button class="btn btn-danger">
                                    Trash
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row">
            {{ $employees->links('vendor/pagination/bootstrap-5') }}
        </div>
    </div>
@endsection
