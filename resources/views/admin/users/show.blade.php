@extends('admin.layouts.app')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title-wrap">
                        <h4 class="card-title">Show User</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="px-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input id="name" name="name" class="form-control border-primary" type="text" value="{{$record->name}}" readonly>
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
                                    <input id="email" name="email" class="form-control border-primary" type="email" value="{{$record->email}}" readonly>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control" for="vendor_no">Date Of Birth </label>

                                        <input type="date" id="dob" class="form-control border-primary" name="dob" placeholder="Date of birth" value="{{$record->dob}}" readonly>
                                </div>
                            </div>


                            <div class="col-6">
                                <div class="form-group">
                                    <label class="label-control" for="vendor_no">Roles </label>
                                    <input type="text"  class="form-control border-primary" value="{{$record->roles->first()->name}}" readonly >
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="label-control" for="vendor_no">Status</label>
                                    <input type="text"  class="form-control border-primary" value="{{$record->is_active}}" readonly >
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
