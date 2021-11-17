@extends('dashboard.layout.master')
@section('title')
Edit Employee
@endsection
@section('content')
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-6">
            <div class="card card-info mt-3">
                <div class="card-header">
                    <h3 class="card-title">Update Employee</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ url('admin/employee/update/'.encrypt($emp->id))}}" method="post">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Frist Name</label>
                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder=" Enter First Name" value="{{ $emp->first_name }}">
                            @error('first_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder=" Enter Last Name" value="{{ $emp->last_name }}">
                            @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email </label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email" value="{{ $emp->email }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder=" Enter First Name" value="{{ $emp->phone }}">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>File input</label>
                            <div class="input-group">
                               <select class="form-control" name="company_id">
                                   @foreach ($cmp as $comp)
                                   <option value="{{ $comp->id }}"
                                    {{ $comp->id == $emp->company_id ? 'selected' : ''}}
                                    >{{ $comp->name }}</option>
                                   @endforeach
                               </select>
                               @error('company_id')
                               <span class="text-danger">{{ $message }}</span>
                           @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
