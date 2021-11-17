@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title-wrap bar-teal">
                    <h4 class="card-title" id="horz-layout-colored-controls">Register User</h4>
                </div>
            </div>
            <div class="card-body px-4">
                <form class="form" id="goalForm" action="{{route('goals.store')}}">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">Name </label>
                                <input type="text" id="name" class="form-control border-primary" name="name" placeholder="Enter Vendor Name">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">Phone No. </label>
                                <input type="text" id="phone" class="form-control border-primary" name="phone" placeholder="Enter Vendor Phone Number">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">Email </label>
                                <input type="email" id="email" class="form-control border-primary" name="email" placeholder="Enter Vendor Email">
                            </div>
                        </div>
                    </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control">Role</label>
                                <select name="users[]" id="user" value="{{old('user')}}" class="form-control border-primary" multiple >
                                </select>
                            </div>
                        </div>
                    <div class="form-actions right">
                    <a href="{{route('dashboard')}}">
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
        placeholder: "Search User",
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
</script>
@endsection
