@extends('layouts.app')

@section('content')
<style>
    body:before {
       content: "";
       width: 55%;
       height: 100vh;
       background: url(app-assets/img/line-pattern.png);
       background-size: cover;
       position: absolute;
       right: 0;
       bottom: 0;
       top: 0;
   }
   </style>
   <div class="alert alert-info pt-1 pb-1 mb-0" role="alert">

       This is a <strong>Global</strong> announcement that will show on both the frontend and backend. <em>See <strong>AnnouncementSeeder</strong> for more usage examples.</em>
   </div>
   <div class="container-fluid">
       <div class="row">
            <div class="col-md-5 p-4 pr-5">
               <a href="" class="text-black logoWrapper">
                   <img src="app-assets/img/givinggradeslogo.png" class="img-fluid" width="40" alt="">
                   <strong>Giving</strong> Grades
               </a>
               <div  class=" w-100 d-block px-4 py-5">
                    <ul class="nav nav-pills mb-3 activetab" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Teacher</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Private</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Corporate</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <form method="POST" id="teahcerForm"  class="form"  action="{{ route('register.teacher') }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group">
                                        <label class="label-control" for="vendor_no">Name </label>
                                        <div class="input-wrap  pl-3 pr-3 pt-1 pb-1 w-100">
                                            <i class="icon-user"></i>
                                            <input type="text" id="name" class="form-control pl-2 pr-2 border-0 bg-transparent outline-none" name="name" placeholder="Name" value="{{old('name')}}" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="label-control" for="vendor_no">Display Name </label>
                                        <div class="input-wrap pl-3 pr-3 pt-1 pb-1 w-100">
                                            <i class="icon-user"></i>
                                            <input type="text" id="phone" class="form-control pl-2 pr-2 border-0 bg-transparent outline-none" name="username" placeholder="Display Name" value="{{old('username')}}" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="label-control" for="vendor_no">Date Of Birth </label>
                                        <div class="input-wrap  pl-3 pr-3 pt-1 pb-1 w-100">
                                            <i class="icon-calendar"></i>
                                            <input type="date" id="dob" class="form-control pl-2 pr-2 border-0 bg-transparent outline-none" name="dob" placeholder="Date of birth" value="{{old('dob')}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="label-control" for="vendor_no">Email address </label>
                                        <div class="input-wrap pl-3 pr-3 pt-1 pb-1 w-100">
                                            <i class="icon-envelope"></i>
                                            <input type="email" id="email" class="form-control pl-2 pr-2 border-0 bg-transparent outline-none" name="email" placeholder="Email Address" value="{{old('email')}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="label-control" for="vendor_no">Gender</label>
                                        <div class="input-wrap pl-3 pr-3 pt-1 pb-1 w-100">
                                            <i class="icon-person"></i>
                                            <select name="gender" id="gender" class="form-control pl-2 pr-2 border-0 bg-transparent outline-none" >
                                                <option value="0" class="form-control pl-2 pr-2 border-0 bg-transparent outline-none" selected disabled>Select Gender</option>
                                                <option value="male" class="form-control pl-2 pr-2 border-0 bg-transparent outline-none">Male</option>
                                                <option value="female" class="form-control pl-2 pr-2 border-0 bg-transparent outline-none" >Female</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="label-control" for="vendor_no">Password </label>
                                        <div class="input-wrap pl-3 pr-3 pt-1 pb-1 w-100">
                                            <i class="icon-key"></i>
                                            <input type="password" id="password" class="form-control pl-2 pr-2 border-0 bg-transparent outline-none" name="password" placeholder="Password" value="{{old('password')}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="label-control" for="vendor_no">Confirm Password</label>
                                        <div class="input-wrap pl-3 pr-3 pt-1 pb-1 w-100">
                                            <i class="icon-key"></i>
                                            <input type="password" id="con_pass" class="form-control pl-2 pr-2 border-0 bg-transparent outline-none" name="password_confirmation" placeholder="Confirm Password" value="{{old('password')}}" required>
                                        </div>
                                    </div>

                                    <label class="checkbox-style">Accept Term and Conditions
                                        <input type="checkbox" checked="checked" name="terms" value="1"> <span class="checkmark"></span>
                                    </label>
                                    <div class="text-center mt-4">
                                        <button class="bg-green text-white pt-2 pb-2 border-0 outline-none  w-100 btn-login" type="submit" style="max-width: 366px;">Sign Up</button>
                                    </div>
                                </form>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <form class="form" method="POST" id="teahcerForm" action="{{ route('register.sponsor') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="label-control" for="vendor_no">Name </label>
                                    <div class="input-wrap pl-3 pr-3 pt-1 pb-1 w-100">
                                        <i class="icon-user"></i>
                                        <input type="text" id="name" class="form-control pl-2 pr-2 border-0 bg-transparent outline-none" name="name" placeholder="Name" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="label-control" for="vendor_no">Email address </label>
                                    <div class="input-wrap pl-3 pr-3 pt-1 pb-1 w-100">
                                        <i class="icon-envelope"></i>
                                        <input type="email" id="email" class="form-control pl-2 pr-2 border-0 bg-transparent outline-none" name="email" placeholder="Email Address" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="label-control" for="vendor_no">Password </label>
                                    <div class="input-wrap pl-3 pr-3 pt-1 pb-1 w-100">
                                        <i class="icon-key"></i>
                                        <input type="password" id="password" class="form-control pl-2 pr-2 border-0 bg-transparent outline-none" name="password" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="label-control" for="vendor_no">Confirm Password</label>
                                    <div class="input-wrap pl-3 pr-3 pt-1 pb-1 w-100">
                                        <i class="icon-key"></i>
                                        <input type="password" id="con_pass" class="form-control pl-2 pr-2 border-0 bg-transparent outline-none" name="password_confirmation" placeholder="Confirm Password" required>
                                    </div>
                                </div>

                                <label class="checkbox-style">Accept Term and Conditions
                                    <input type="checkbox" checked="checked" value="1" name="terms"> <span class="checkmark"></span>
                                </label>
                                <div class="text-center mt-4">
                                    <button class="bg-green text-white pt-2 pb-2 border-0 outline-none  w-100 btn-login" style="max-width: 366px;">Sign Up</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <form class="form" method="POST" id="teahcerForm" action="{{ route('register.sponsor') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="label-control" for="vendor_no">Name </label>
                                    <div class="input-wrap pl-3 pr-3 pt-1 pb-1 w-100">
                                        <i class="icon-user"></i>
                                        <input type="text" id="name" class="form-control pl-2 pr-2 border-0 bg-transparent outline-none" name="name" placeholder="Name" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="label-control" for="vendor_no">Email address </label>
                                    <div class="input-wrap pl-3 pr-3 pt-1 pb-1 w-100">
                                        <i class="icon-envelope"></i>
                                        <input type="email" id="email" class="form-control pl-2 pr-2 border-0 bg-transparent outline-none" name="email" placeholder="Email Address" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="label-control" for="vendor_no">Password </label>
                                    <div class="input-wrap pl-3 pr-3 pt-1 pb-1 w-100">
                                        <i class="icon-key"></i>
                                        <input type="password" id="password" class="form-control pl-2 pr-2 border-0 bg-transparent outline-none" name="password" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="label-control" for="vendor_no">Confirm Password</label>
                                    <div class="input-wrap pl-3 pr-3 pt-1 pb-1 w-100">
                                        <i class="icon-key"></i>
                                        <input type="password" id="con_pass" class="form-control pl-2 pr-2 border-0 bg-transparent outline-none" name="password_confirmation" placeholder="Confirm Password" required>
                                    </div>
                                </div>

                                <label class="checkbox-style">Accept Term and Conditions
                                    <input type="checkbox" checked="checked" name="terms"> <span class="checkmark"></span>
                                </label>
                                <div class="text-center mt-4">
                                    <button class="bg-green text-white pt-2 pb-2 border-0 outline-none  w-100 btn-login" style="max-width: 366px;">Sign Up</button>
                                </div>
                            </form>
                        </div>
                    </div>
               </div>
           </div>
           <div class="col-md-7">
               <div class="col-md-12 p-5">
                   <div class="col-auto float-right">
                       <a href="/login" class="bg-green text-white btn-register pl-5 pr-5 pt-2 pb-2" style="box-shadow: rgb(179, 220, 207) -1px 3px 15px -3px;">Sign In</a>
                   </div>
               </div>
               <div class="p-md-5 p-1 mt-md-5 mt-0">
                   <h1 class="text-black sign-up">Sign Up to <br> Giving <strong class="text-green">Grades</strong></h1>
                   <p class="fontsize14px text-gray ">If you have an Account You <br>you can
                   <a href="/login" class="text-white text-underline">
                       <ins class="text-green ">login here</ins></a></p>
                   </div>
           </div>
       </div>
   </div>

@endsection
@section('afterScript')
<script>
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

