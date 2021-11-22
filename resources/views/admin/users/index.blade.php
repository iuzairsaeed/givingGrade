@extends('admin.layouts.app')

@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <p class="mb-0">Your Users</p>
                    <a href="{{route('users.create')}}" class="btn btn-create mb-0 grey"><i class="ft-plus grey"></i> Create User</a>
                </div>
                <div class="card-body pt-3">
                    <table class="table table-striped table-bordered" id="dTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('afterScript')
<script>
    var table = $('#dTable').DataTable({
        processing: true,
        serverSide: true,
        ajax:
        {
            url: '{{ route("users.getList") }}',
            type: 'GET',
            dataType: "JSON",
            error: function (reason) {
                return true;
            }
        },
        columns: [
            { data: 'serial'},
            { data: 'name' },
            { data: 'email' },
            { data: 'is_active', render:function (data, type, full, meta) {
                                return full.is_active   ? `<i class="fa fa-dot-circle-o success font-medium-1 mr-1"></i> Active`
                                                        : `<i class="fa fa-dot-circle-o danger font-medium-1 mr-1"></i> InActive`;  }
            },
            { data: 'actions', render:function (data, type, full, meta) {
                                return `<a href="/users/${full.id}" class="showStatus info p-0 mr-2 success" title="View">
                                            <i class="ft-eye font-medium-3"></i>
                                        </a>
                                        <a  href="/users/${full.id}/edit"  class="showStatus info p-0 mr-2 success" title="View">
                                            <i class="ft-edit font-medium-3"></i>
                                        </a>
                                        <a href="/users/${full.id}/destroy"  class="showStatus danger p-0 mr-2 success" title="View">
                                            <i class="ft-trash font-medium-3"></i>
                                        </a>`;  }
            }
        ],
        order: [0 , 'desc'],
        columnDefs: [
            { width: "10%", "targets": [-1, 0] },
            { orderable: false, targets: [-1] }
        ],
    });
</script>
@endsection
