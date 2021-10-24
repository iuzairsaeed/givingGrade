{{-- @extends('admin.layouts.app')

@section('content')
<section id="login">
    <div class="container-fluid">
        <div class="row full-height-vh">
            <div class="col-12 d-flex align-items-center justify-content-center gradient-crystal-clear">
                <div class="card px-4 py-2 box-shadow-2 width-400">
                    <div class="card-header text-center pb-0">
                        <img src="favicon.ico" alt="logo" class="main-logo mb-2 mt-3 width-200 ">
                    </div>
                    <div class="card-body">
                        <div class="card-block">
                            <br />
                            <form method="POST" action="{{ route('login') }}">
                            @csrf
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="ft-at-sign"></i></span>
                                            </div>
                                            <input type="username" class="form-control form-control-lg{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" id="username" placeholder="Username" required autofocus>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="icon-key"></i></span>
                                            </div>
                                            <input type="password" class="form-control form-control-lg{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="inputPass" placeholder="Password" required>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0 ml-5">
                                                <input type="checkbox" class="custom-control-input" name="remember" id="remember">
                                                <label class="custom-control-label float-left" for="remember">Remember Me</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="text-center col-md-12">
                                        <button type="submit"style="background-color: #004d40;"  class="btn btn 900 px-4 py-2 text-uppercase white font-small-4 box-shadow-2 border-0">Login</button>
                                    </div>
                                </div>
                              
                            </form>
                        </div>
                    </div>
                    <div class="card-footer grey darken-1">
                        <div class="text-center">
                            <p class="font-small-2">All rights Reserved © RUSD Investment Bank</p>
                            @if (Route::has('password.request'))
                                <div class="text-center mb-1">Forgot Password? <a href="{{ route('password.request') }}"><b>Reset</b></a></div>
                            @endif
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection --}}

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
<section id="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 p-4 pr-5">
                <a href="" class="text-black logoWrapper">
                    <img src="app-assets/img/givinggradeslogo.png" class="img-fluid" width="40" alt="">
                    <strong>Giving</strong> Grades
                </a>
                <div  class="tab-content mt-5 w-100 d-block px-4 py-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="">Email Address</label>
                            <div class="input-wrap pl-3 pr-3 pt-1 pb-1 w-100">
                                <i class="icon-envelope"></i> 
                                <input type="text" name="username" value="{{ old('username') }}" id="username" class="form-control pl-2 pr-2 border-0 bg-transparent outline-none" placeholder="Email Address">
                            </div>
                        </div>
                        @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                        <div class="form-group">
                            <label for="">Password</label>
                            <div class="input-wrap pl-3 pr-3 pt-1 pb-1 w-100">
                                <i class="icon-key "></i>
                                <input type="password" name="password" id="inputPass" class="form-control pl-2 pr-2 border-0 bg-transparent outline-none" placeholder="Password">
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-gray font-12 text-decoration-underline">Forgot Password ?</a>
                        @endif
                        <div class="text-center mt-4">
                            <button type="submit" class="bg-green text-white pt-2 pb-2 border-0 outline-none  w-100 btn-login" style="max-width: 366px;">Log In</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-7">
                <div class="col-md-12 p-5">
                    <div class="col-auto float-right">
                        <a href="/register" class="text-green pl-5 pr-5 pt-2 pb-2 bg-white" style="border-radius: 10px ;box-shadow: rgb(179, 220, 207) -1px 3px 15px -3px; background: rgba(255, 255, 255, 0.22);">
                            Register
                        </a>
                    </div>
                </div>
                <div class="p-md-5 p-1 mt-md-5 mt-0">
                    <h1 class="text-black sign-up">Sign Up to <br> Giving <strong class="text-green">Grades</strong></h1> 
                    <p class="fontsize14px text-gray ">Don't' have an account ? You <br> can create one
					<a href="/register" class="text-white text-underline">
                        <ins class="text-green ">here</ins></a></p>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection
