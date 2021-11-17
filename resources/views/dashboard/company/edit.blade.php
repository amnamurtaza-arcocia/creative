@extends('dashboard.layout.master')
@section('title')
Edit Company
@endsection
@section('content')
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-6">
            <div class="card card-info mt-3">
                <div class="card-header">
                    <h3 class="card-title">Update Company</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ url('admin/company/update/'.encrypt($cmp->id))}}" method="post" enctype="multipart/form-data">

                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder=" Enter Name" value="{{ $cmp->name }}">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email </label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email" value="{{ $cmp->email }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="logo" class="custom-file-input
                                     @error('logo') is-invalid @enderror" value="{{asset('storage/'.$cmp->logo)}}"
                                     >
                                    <label class="custom-file-label">Choose file</label>
                                    @error('logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
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
