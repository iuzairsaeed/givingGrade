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
            <div class="col-md-12 pl-4 pt-5 pb-5 pr-4 bg-white ">
                <h1>Admin <strong>Dashboard</strong></h1>
                <ul class="nav nav-pills mb-3 pt-4" id="pills-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <table class="table table-striped table-bordered" id="dTable">
                            <thead>
                                <tr>
                                    <th>Serial #</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
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
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <table class="table table-striped table-bordered" id="dTable1">
                            <thead>
                                <tr>
                                    <th>Serial #</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Test Corporate</td>
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
                                <tr>
                                    <td>1</td>
                                    <td>Test Private</td>
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
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <table class="table table-striped table-bordered" id="dTable2">
                            <thead>
                                <tr>
                                    <th>Serial #</th>
                                    <th>Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            
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
        $('#dTable1').DataTable();
        $('#dTable2').DataTable();
    </script>
@endsection
