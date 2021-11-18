@extends('admin.layouts.app')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title-wrap">
                        <h4 class="card-title">Update Profile</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="px-3">
                        <form action="{{route('profile')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                @foreach ($errors->all() as $error)
                                    <p class="text-danger">{{ $error }}</p>
                                @endforeach

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Full Name</label>
                                            <input id="name" name="name" class="form-control border-primary" type="text" value="{{old('name', $user->name)}}" required>
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
                                            <input id="email" name="email" class="form-control border-primary" type="email" value="{{ $user->email }}" required>
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

                                                <input type="date" id="dob" class="form-control border-primary" name="dob" placeholder="Date of birth" value="{{ $user->dob}}" required>
                                        </div>
                                    </div>
                                    @if($errors->first('email'))
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Old Password</label>
                                            <input id="password" name="oldPassword" class="form-control border-primary"  placeholder="Old Password" type="password" value="" required>
                                        </div>
                                        @if($errors->first('password'))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Password</label>
                                            <input id="password" name="password" class="form-control border-primary"  placeholder="Password" type="password" value="" required>
                                        </div>
                                        @if($errors->first('password'))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-control" for="vendor_no">Confirm Password</label>

                                            <input type="password" id="con_pass" class="form-control border-primary" name="password_confirmation" placeholder="Confirm Password" required>
                                        </div>
                                        @if($errors->first('password_confirmation'))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">School</label>
                                            <input id="school" name="school" class="form-control border-primary" type="text" value="{{ $user->school }}">
                                        </div>
                                        @if($errors->first('school'))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('school') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Grade Level</label>
                                            <input id="grade" name="grade" class="form-control border-primary" type="text" value="{{ $user->grade_level }}">
                                        </div>
                                        @if($errors->first('grade'))
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $errors->first('grade') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">No Of Students</label>
                                            <input id="students" name="students" class="form-control border-primary" type="number" value="{{ $user->students }}">
                                        </div>
                                        @if($errors->first('students'))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('students') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="label-control">Select Subjects</label>
                                            <select name="subjects[]" id="user" value="{{old('user')}}" class="form-control border-primary" multiple>
                                            </select>
                                        </div>
                                        @if($errors->first('subjects'))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('subjects') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-control">Avatar</label>
                                            <input type="file" name="avatar" id="avatar" class="form-control border-primary">

                                        </div>
                                        @if($errors->first('avatar'))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('avatar') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <input type="hidden" name="imageRemove" id="imageRemove" value="{{$user->avatar !== 'storage/avatars/no-image.png' ? 0 : 1}}">
                                    @if($user->avatar !== 'storage/avatars/no-image.png')
                                        <div class="col-lg-4 col-md-6 col-sm-12" id="imageShow">
                                            <img src="{{ asset("storage/{$user->avatar}") }}" class="img-thumbnail cursor-pointer" style="width:30%; height:50%;">
                                            <button class="btn btn-danger" id="removeImage"> <i class="ft-trash font-sm-1 right"></i></button>
                                        </div>
                                    @endif
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


    $('#user').select2({
        placeholder: "Search Subjects",
        allowClear: true,
        ajax: {
            url: "{{ route('users.get-user') }}",
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

    $('#removeImage').click(function(){
        $('#imageRemove').val(1);
        $('#imageShow').remove();

    });
</script>
@endsection

