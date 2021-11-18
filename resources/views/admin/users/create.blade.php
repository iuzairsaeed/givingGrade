@extends('admin.layouts.app')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title-wrap">
                        <h4 class="card-title">Create User</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="px-3">
                        <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Full Name</label>
                                            <input id="name" name="name" class="form-control border-primary" type="text" value="{{old('name')}}" required>
                                        </div>
                                        @if($errors->first('name'))
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input id="email" name="email" class="form-control border-primary" type="email" value="{{old('email')}}" required>
                                        </div>
                                        @if($errors->first('email'))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-control" for="vendor_no">Date Of Birth </label>

                                                <input type="date" id="dob" class="form-control border-primary" name="dob" placeholder="Date of birth" value="{{old('dob')}}" required>
                                        </div>
                                    </div>
                                    @if($errors->first('email'))
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Password</label>
                                            <input id="password" name="password" class="form-control border-primary" type="password" value="{{old('password')}}">
                                        </div>
                                        @if($errors->first('password'))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-actions left">
                                            <button type="button" class="btn btn-danger mr-1">
                                                <i class="icon-trash"></i> Delete User
                                            </button>

                                            <button type="submit" id="submit" class="btn btn-raised btn-success">
                                                <i class="icon-note"></i> Update Profile
                                            </button>
                                            <a href="{{route('dashboard')}}">
                                                <button type="button" class="btn btn-secondary mr-1">
                                                    <i class="icon-back"></i> Cancel
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
