@extends('admin.layouts.app')

@section('content')
<style>
    .alert-info{
        position: absolute;
        left: 240px;
        right: 0;
    }
    body{
        background-color: #EBEDEF;
    }
    .nav-pills .nav-link{
        color: #321fdb !important;
    }
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
        color: #768192 !important;
        background-color: #ebedef !important;
        /* border-color: #c4c9d0 #c4c9d0 #ebedef; */
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
    }
    
</style>
<div class="alert alert-info pt-1 pb-1 mb-0" role="alert">
       
    This is a <strong>Global</strong> announcement that will show on both the frontend and backend. <em>See <strong>AnnouncementSeeder</strong> for more usage examples.</em>
</div>
<section class="py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <p class="mb-0">Your charities</p>
                        <a href="{{route('charities.create')}}" class="btn btn-create mb-0 grey"><i class="ft-plus grey grey"></i> Create Charity</a>
                    </div>
                    <div class="card-body pt-3">
                        <table class="table table-striped table-bordered" id="dTable">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Test Teacher</td>
                                    <td>Test Teacher</td>
                                    <td>
                                        <button class="btn btn-sm btn-info"><i class="icon-magnifier mr-1" ></i>View</button>
                                        <button class="btn btn-sm btn-primary"><i class="icon-pencil mr-1" ></i>Edit</button>
                                        <button class="btn btn-sm btn-danger"><i class="icon-trash mr-1" ></i>Delete</button>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Change Password</a>
                                                <a class="dropdown-item" href="#">Clear Session</a>
                                                <a class="dropdown-item" href="#">Login As Test Teacher</a>
                                                <a class="dropdown-item" href="#">Deactivate</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection
@section('afterScript')
    <script>
        $('#dTable').DataTable();
    </script>
@endsection
