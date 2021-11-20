@extends('admin.layouts.app')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title-wrap">
                        <h4 class="card-title">Edit User</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="px-3">
                        <form action="{{route('users.update',$user->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Full Name</label>
                                            <input id="name" name="name" class="form-control border-primary" type="text" value="{{$user->name}}" required>
                                        </div>
                                        @if($errors->first('name'))
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                    <input id="userId" name="userId" class="form-control border-primary" type="hidden" value="{{$user->id}}" required>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input id="email" name="email" class="form-control border-primary" type="email" value="{{$user->email}}" required>
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

                                                <input type="date" id="dob" class="form-control border-primary" name="dob" placeholder="Date of birth" value="{{$user->dob}}" required>
                                        </div>
                                    </div>
                                    @if($errors->first('email'))
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input id="password" name="password" class="form-control border-primary" type="password" value="{{old('password')}}">
                                        </div>
                                        @if($errors->first('password'))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="label-control">Select Roles</label>
                                            <select name="roles" id="roles" value="{{old('roles')}}" class="form-control border-primary">
                                            </select>
                                        </div>
                                        @if($errors->first('roles'))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('roles') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="label-control" for="vendor_no">Status </label>
                                            <select name="status" id="status" class="form-control form-control-sm" required>
                                                <option value="1"{{$user->is_active =1  ? 'selected' : ''}}>Active</option>
                                                <option value="0" {{$user->is_active =0  ? 'selected' : ''}}>In-Active</option>
                                            </select>
                                        </div>
                                        @if($errors->first('status'))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-actions left">
                                            <button type="submit" id="submit" class="btn btn-raised btn-success">
                                                <i class="icon-note"></i> Save
                                            </button>
                                            <a href="{{route('users.index')}}">
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
@section('afterScript')
<script>
    let user = `{!! $user->roles()->first()->id !!}`
    $('#roles').select2({
        placeholder: "Search Role",
        allowClear: true,
        ajax: {
            url: "{{ route('role.get-role') }}",
            type: "GET",
            dataType: 'json',
            data: function (params) {
                return {
                    search: params.term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });
</script>
@endsection
