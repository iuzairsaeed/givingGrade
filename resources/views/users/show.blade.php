@extends('layouts.app')
@section('content')
<section id="user-area">
    <a class="btn btn-primary" href="/users"><i class="fa fa-reply"></i> Go Back</a>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="card-title-wrap">
                        <h4 class="card-title">User Detail</h4>
                    </div>
                </div>
                <div class="card-body px-4">
                    <form action="/users/{{$user->id}}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-body">

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="text-bold-700">Full Name</label>
                                        <p>{{ $user->name??'-' }}</p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="text-bold-700">Username</label>
                                        <p>{{ $user->username??'-' }}</p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="text-bold-700">Email</label>
                                        <p>{{ $user->email??'-' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="text-bold-700">Phone</label>
                                        <p>{{ $user->phone??'-' }}</p>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="text-bold-700">Gender</label>
                                        <p>{{ Str::ucfirst($user->gender)??'-' }}</p>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="text-bold-700">Country</label>
                                        <p>{{ Str::ucfirst($user->country)??'-' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="text-bold-700">Date of Birth</label>
                                        <p>{{ $user->dob??'-' }}</p>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="text-bold-700">Avatar</label>
                     
                                        <p><img style=" width: 50px; height: 50px;" src=" {{  url($user->avatar)}}" alt=""> </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-sm-12">
                                    <div class="form-group">
                                        <label class="text-bold-700">Address</label>
                                        <p>{{ $user->address??'-' }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="form-group">
                                        <label class="text-bold-700">Street</label>
                                        <p>{{ $user->street??'-' }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-12">
                                    <div class="form-group">
                                        <label class="text-bold-700">City</label>
                                        <p>{{ $user->city??'-' }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-12">
                                    <div class="form-group">
                                        <label class="text-bold-700">Zip Code</label>
                                        <p>{{ $user->zipcode??'-' }}</p>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-bold-700">Account Status</label>
                                        <div class="input-group">
                                            <div class="custom-control custom-radio display-inline-block pr-3">
                                                <input type="radio" class="custom-control-input" name="is_active" id="is_active1" value='1' {{($user->is_active == 1) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="is_active1">Active</label>
                                            </div>
                                            <div class="custom-control custom-radio display-inline-block">
                                                <input type="radio" class="custom-control-input" name="is_active" id="is_active2" value='0' {{($user->is_active == 0) ? 'checked' :'' }}>
                                                <label class="custom-control-label" for="is_active2">Deactive</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-bold-700">Profile Status</label>
                                        <div class="input-group">
                                            <div class="custom-control custom-radio display-inline-block pr-3">
                                                <input type="radio" class="custom-control-input" name="status" id="status1" value='1' {{($user->status == CompleteProfile() ) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="status1">Pending</label>
                                            </div>
                                            <div class="custom-control custom-radio display-inline-block">
                                                <input type="radio" class="custom-control-input" name="status" id="status2" value='0' {{($user->status == ApprovalPending() ) ? 'checked' :'' }}>
                                                <label class="custom-control-label" for="status2">Completed</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-7 col-sm-12">
                                    <div class="form-group">
                                        <label class="label-control">Role</label>
                                        <select name="roles[]" id="role" value="{{old('role')}}" class="form-control border-primary" >
                                            @foreach($roles as $r)
                                                <option value="{{$r}}"  {{!isset($user->roles[0]) ? "" : ($user->roles[0]->name == $r ? "selected" : "")}}>{{$r}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-actions left">
                                        <a href="{{route('dashboard')}}">
                                            <button type="button" class="btn btn-danger mr-1">
                                                <i class="icon-trash"></i> Cancel
                                            </button>
                                        </a>
                                        <button type="submit" class="btn btn-raised btn-success">
                                            <i class="icon-check"></i> Update User
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
</section>
@endsection

@section('afterScript')
<script>
    $('#dTable').DataTable({
        order: [0 , 'desc'],
        columnDefs: [
            { width: "10%", "targets": [-1, 0] },
            { orderable: false, targets: [-2, -1] }
        ]
    });

    $('#role').select2({
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
