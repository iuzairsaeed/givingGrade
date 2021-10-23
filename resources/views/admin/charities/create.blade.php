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
    .form-group input.form-control:focus {
        border-color: #000  !important;
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
                        <p class="mb-0">Create Charity</p>
                        <a href="{{route('charities.index')}}" class="btn btn-create mb-0"> Cancel</a>
                    </div>
                    <div class="card-body p-3">
                        <form method="post" action="{{route('charities.store')}}">
                            <div class="form-group row">
                                <label for="title" class="col-md-2 col-form-label">Title</label>
                                <div class="col-md-10"><input type="text" name="title" placeholder="Title" value="" maxlength="100" required="required" class="form-control" /></div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-md-2 col-form-label">Description</label>
                                <div class="col-md-10"><textarea name="description" id="description" placeholder="Description" maxlength="255" required="required" class="form-control"></textarea></div>
                            </div>
                            <div class="form-group row">
                                <label for="tagline" class="col-md-2 col-form-label">Tagline</label>
                                <div class="col-md-10"><textarea name="tagline" id="tagline" placeholder="Tagline" maxlength="255" required="required" class="form-control"></textarea></div>
                            </div>
                            <div class="form-group row">
                                <label for="charity_fb" class="col-md-2 col-form-label">Facebook</label>
                                <div class="col-md-10"><input type="text" name="charity_fb" placeholder="Facebook" value="" required="required" class="form-control" /></div>
                            </div>
                            <div class="form-group row">
                                <label for="charity_gplus" class="col-md-2 col-form-label">G+</label>
                                <div class="col-md-10"><input type="text" name="charity_gplus" placeholder="G+" value="" required="required" class="form-control" /></div>
                            </div>
                            <div class="form-group row">
                                <label for="charity_linkedin" class="col-md-2 col-form-label">LinkedIn</label>
                                <div class="col-md-10"><input type="text" name="charity_linkedin" placeholder="LinkedIn" value="" required="required" class="form-control" /></div>
                            </div>
                            <div class="form-group row">
                                <label for="charity_twitter" class="col-md-2 col-form-label">Twitter</label>
                                <div class="col-md-10"><input type="text" name="charity_twitter" placeholder="Twitter" value="" required="required" class="form-control" /></div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-md-2 col-form-label">Image</label>
                                <div class="col-md-10" charity-image="">
                                    <input type="file" accept="image/*" />
                                    <div id="preview" class="col-md-6">
                                        <textarea name="image" id="image" class="form-control" style="display: none;"></textarea>
                                        <!---->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="active" class="col-md-2 col-form-label">Active</label>
                                <div class="col-md-10"><input type="checkbox" class="checkbox" value="0" /> <input type="hidden" name="active" value="0" /> <span class="checkmark"></span></div>
                            </div>
                        </form>
                        
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Create Charity</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection
