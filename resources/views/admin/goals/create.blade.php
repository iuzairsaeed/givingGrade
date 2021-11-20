@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title-wrap bar-teal">
                    <h4 class="card-title" id="horz-layout-colored-controls">Create Goal</h4>
                </div>
            </div>
            <div class="card-body px-4">
                <form class="form" action="{{route('goals.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">Title </label>
                                <input type="text" id="title" class="form-control border-primary  @error('title') is-invalid @enderror" name="title" placeholder="Enter Title">
                            </div>
                            @if($errors->first('title'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">Description </label>
                                <textarea type="text" id="description" class="form-control border-primary @error('description') is-invalid @enderror" name="description" placeholder="Enter Description"></textarea>
                            </div>
                            @if($errors->first('description'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">Target </label>
                                <input type="number" id="target" class="form-control border-primary @error('target') is-invalid @enderror" name="target" placeholder="Enter Current Target">
                            </div>
                            @if($errors->first('target'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('target') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">Target </label>
                                <input type="number" id="currentTarget" class="form-control border-primary @error('donations') is-invalid @enderror" name="donations" placeholder="Enter Donations Received">
                            </div>
                            @if($errors->first('donations'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('donations') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">No Of Student </label>
                                <input type="number" id="student" class="form-control border-primary @error('student') is-invalid @enderror" name="student" placeholder="Enter No of Student">
                            </div>
                            @if($errors->first('student'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('student') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">Start Date </label>
                                <input type="date" id="startDate" class="form-control border-primary @error('startDate') is-invalid @enderror" name="startDate" placeholder="Enter Start date">
                            </div>
                            @if($errors->first('startDate'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('startDate') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">End Date </label>
                                <input type="date" id="endDate" class="form-control border-primary @error('endDate') is-invalid @enderror" name="endDate" placeholder="Enter End date">
                            </div>
                            @if($errors->first('endDate'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('endDate') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">Status </label>
                                <select name="status" id="status" class="form-control form-control-sm" required>
                                    <option value="1">Active</option>
                                    <option value="0" >In-Active</option>
                                </select>
                            </div>
                            @if($errors->first('status'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control">Select Charity</label>
                                <select name="charity" id="user" value="{{old('user')}}" class="form-control border-primary" >
                                </select>
                            </div>
                            @if($errors->first('charity'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('charity') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control">Image</label>
                                <input type="file" name="image" id="image" value="{{old('user')}}" class="form-control border-primary" >
                            </div>
                        </div>
                        @if($errors->first('image'))
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-actions right">
                        <a href="{{route('goals.index')}}">
                            <button type="button" class="btn btn-danger mr-1">
                                <i class="icon-trash"></i> Cancel
                            </button>
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="icon-note"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('afterScript')
<script>
    $('#user').select2({
        placeholder: "Search Charity",
        allowClear: true,
        ajax: {
            url: "{{ route('charities.get-charity') }}",
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
