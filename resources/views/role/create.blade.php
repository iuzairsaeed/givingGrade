@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title-wrap bar-teal">
                    <h4 class="card-title" id="horz-layout-colored-controls">Add Role</h4>
                </div>
            </div>
            <div class="card-body px-4">
                <form class="form" id="permForm">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="dept_name">Name </label>
                                <input type="text" id="name" class="form-control border-primary" name="name" placeholder="Enter Role Name">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control">Permission</label>
                                <select name="permission[]" id="permission" value="{{old('permission')}}" class="form-control border-primary" multiple>
                                </select>
                            </div>
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
        
    $("#permForm").submit( function(e){
        e.preventDefault();
        vendor = $("#permForm");
        var form_data = new FormData($("#permForm")[0]);
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url : "{{ route('role.store') }}",
            type: "POST",
            data : form_data,
            async: false,
            cache: false,
            contentType: false,
            enctype: 'multipart/form-data',
            processData: false,
            success: function (res) {
                swal("Inserted!", "Role has been Added Successfully!", "success");
                // location.reload();
            },
            error: function(err) {
                swal('Not Valid',err.responseJSON.message,'error')
            }
        });
    });

    $('#permission').select2({
        placeholder: "Search Permission",
        allowClear: true,
        ajax: {
            url: "{{ route('permission.get-permission') }}",
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
