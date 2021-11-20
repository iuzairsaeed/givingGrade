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
    .card-counter{
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 20px 10px;
    background-color: #fff;
    height: 100px;
    border-radius: 5px;
    transition: .3s linear all;
  }

  .card-counter:hover{
    box-shadow: 4px 4px 20px #DADADA;
    transition: .3s linear all;
  }

  .card-counter.primary{
    background-color: #007bff;
    color: #FFF;
  }

  .card-counter.danger{
    background-color: #ef5350;
    color: #FFF;
  }

  .card-counter.success{
    background-color: #66bb6a;
    color: #FFF;
  }

  .card-counter.info{
    background-color: #26c6da;
    color: #FFF;
  }

  .card-counter i{
    font-size: 5em;
    opacity: 0.2;
  }

  .card-counter .count-numbers{
    position: absolute;
    right: 35px;
    top: 20px;
    font-size: 32px;
    display: block;
  }

  .card-counter .count-name{
    position: absolute;
    right: 35px;
    top: 65px;
    font-style: italic;
    text-transform: capitalize;
    opacity: 0.5;
    display: block;
    font-size: 18px;
  }
</style>
{{-- <div class="alert alert-info pt-1 pb-1 mb-0" role="alert">

    This is a <strong>Global</strong> announcement that will show on both the frontend and backend. <em>See <strong>AnnouncementSeeder</strong> for more usage examples.</em>
</div> --}}

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">{{ ucFirst(auth()->user()->roles->first()->name) }} Dashboard</h1>
    </div>

    <div class="row">
    @php
        extract($data);
    @endphp
    @if(auth()->user()->roles->first()->name == config('constant.role.admin'))
        <div class="col-md-3">
            <div class="card-counter secondary">
            <i class="fa fa-users"></i>
            <span class="count-numbers">{{$sponsors}}</span>
            <span class="count-name">Sponsors</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-counter secondary">
                <i class="fa fa-users"></i>
                <span class="count-numbers">{{$teachers}}</span>
                <span class="count-name">Teachers</span>
            </div>
        </div>
    @endif

    @if(auth()->user()->roles->first()->name !== config('constant.role.corporate'))

        <div class="col-md-3">
            <div class="card-counter secondary">
                <i class="fa fa-dollar"></i>
                <span class="count-numbers">{{$funds}}</span>
                <span class="count-name">Fund Raised</span>
            </div>
        </div>



        <div class="col-md-3">
            <div class="card-counter secondary">
                <i class="fa fa-bullseye"></i>
                <span class="count-numbers">{{$goals}}</span>
                <span class="count-name">Goals</span>
            </div>
        </div>



        <div class="col-md-3">
            <div class="card-counter secondary">
                <i class="fa fa-book"></i>
                <span class="count-numbers">{{$subjects}}</span>
                <span class="count-name">Subjects</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-counter secondary">
            <i class="fa fa-home"></i>
            <span class="count-numbers">{{$classrooms}}</span>
            <span class="count-name">Classrooms</span>
            </div>
        </div>
    @endif

        <div class="col-md-3">
            <div class="card-counter secondary">
                <i class="fa fa-money"></i>
                <span class="count-numbers">{{$charities}}</span>
                <span class="count-name">Charities</span>
            </div>
        </div>

  </div>
</div>
@endsection

