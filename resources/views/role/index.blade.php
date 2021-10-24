@extends('admin.layouts.app')

@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <p class="mb-0">Your Roles</p>
                    <a href="{{route('role.create')}}" class="btn btn-create mb-0"><i class="icon-plus"></i> Create Role</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="dTable">
                        <thead>
                            <tr>
                                <th>Serial #</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Modal --}}
<div class="modal fade text-left" id="editPerm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header gradient-green-tea">
                <h3 class="modal-title text-white" id="myModalLabel3">Edit Roles</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" class="form-control" name="id" id="id">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-bold-500" for="name">Name: </label>
                            <input type="text" id="name" class="form-control border-primary" name="name">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="text-bold-500" for="permission">Permission: </label>
                            <select name="permission[]" id="permission" class="form-control border-primary" multiple>
                                @foreach ($permission as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-actions center pt-2">
                <a href="{{route('dashboard')}}">
                        <button type="button" class="btn btn-danger mr-1">
                            <i class="icon-trash"></i> Cancel
                        </button>
                        </a>
                    <button type="submit" class="btn btn-raised btn-success updatebtn">
                        <i class="icon-note"></i> Update
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('afterScript')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    }); 
    $(document).ready(function() {
        var table = $('#dTable').DataTable({
            processing: true,
            serverSide: true,
            ajax:
            {
                url: '{{ route("role.get-list") }}',
                type: 'GET',
                dataType: "JSON",
                error: function (reason) {
                    return true;
                }
            },
            columns: [
                { data: 'serial'},
                { data: 'name' },
                { data: 'actions', render:function (data, type, full, meta) {
                                    return `<a class="success p-0 mr-2 viewBtn" title="Edit" data-id="${full.id}" data-type="${full.type}" data-name="${full.name}" data-valueOriginal="${full.valueOriginal}" data-value="${full.value}"  data-toggle="modal" data-keyboard="false" data-target="#editPerm">
                                                <i class="ft-edit font-medium-3"></i>
                                            </a>
                                            <a href="#" id="${full.id}"class="danger p-0 mr-2 delete" title="delete" >
                                                <i class="ft-trash-2 font-medium-3"></i>
                                            </a>`;  }
                }
            ],
            order: [0 , 'desc'],
            // columnDefs: [
            //     { width: "10%", "targets": [-1, 0] },
            //     { orderable: false, targets: [-1,-2,-3,-4] }
            // ],
        });

    });

    $(document).on('click','.viewBtn',function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url: 'role/'+id+'/edit',
            method:'GET',
            dataType:'json',
            success:function(data)
            {
                var arr = Object.keys(data.permission).map(function (key) { return data.permission[key]; });
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#permission').val(arr);
                $('#permission').select2();
            },
            error: function(e) {
                console.log(e);
            }
        });
    });

    $(document).on('click','.updatebtn',function(e){
        e.preventDefault();
        var id = $('#id').val();
        var name = $('#name').val();
        var permission = $('#permission').val();
        $.ajax({
            type: 'PUT',
            url: 'role/'+id,
            data: {
                "id":id,
                "name":name,
                "permission" : permission
            },
            success:function(data){
                swal("Updated!", "Action has been performed successfully!", "success").catch(swal.noop);
                $('#dTable').DataTable().ajax.reload();
                $('#ediPerm').modal('hide');
            },
            error: function (e) {
                swal("Error!", e.responseJSON.message, "error");
            }
        });
    });

    $(document).on('click','.delete',function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0CC27E',
            cancelButtonColor: '#FF586B',
            confirmButtonText: 'Yes, Delete it',
            cancelButtonText: "No, Cancel"
        }).then(function (isConfirm) {
            if (isConfirm) {
                $.ajax(
                {
                    url: "/role/"+id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (){
                        $('#dTable').DataTable().ajax.reload();
                        swal("Deleted!", "Action has been performed successfully!", "success");
                    }
                });
            }
        }).catch(swal.noop);
    });
</script>
@endsection
