<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="{{ config('app.name', 'rusd Inventory Management Systen') }}">
<meta name="keywords" content="{{ config('app.name', 'rusd Inventory Management Systen') }}">
<meta name="author" content="rusd Inc">
<title>{{ config('app.name', 'rusd Inventory Management Systen') }}</title>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<link rel="icon" type="image/png" href="{{ asset('W.ico') }}" />

<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
<link rel="stylesheet" href="{{ asset('app-assets/vendors/css/wizard.css') }}">
<link rel="manifest" href="manifest.json">
<style>
     @font-face {
	font-family: 'GTWalsheimProRegular';
	src: url('/app-assets/fonts/gtwelsheimpro/GTWalsheimProRegular.ttf');
    }
    @font-face {
        font-family: 'GTWalsheimProBold';
        src: url('/app-assets/fonts/gtwelsheimpro/GTWalsheimProBold.ttf');
    }
    body{
        font-family: 'GTWalsheimProRegular'  !important;
        background-color: #fff;
    }
    .text-black{
    color: #000000;
    }
    .text-green {
        color: #6dccae;
    }
    .logoWrapper
    {
        font-size: 18px;
    }
    form label{
        text-transform: capitalize;
        letter-spacing: unset ;
        font-size: 14px;
    }
    .input-wrap{
        border-radius: 15px;
        background: #f9fafc;
    }
    .form-control:focus{
        outline: none !important;
        border-color: transparent !important;
        box-shadow: unset !important;
    }
    .text-gray {
        color: #707070;
    }
    .font-12{font-size: 12px;}
    .fontsize14px{font-size: 14px;}
    .bg-green {
        background: #63C6A5 !important;
    }
    .btn-login,.btn-register{
        border-radius: 15px;
    }
    .sign-up{
        font-size: 50px;
        font-weight: 700;
        font-family: 'GTWalsheimProRegular'  !important;
    }
    .alert-info {
        color: #385d7a  !important;
        background-color: #e2f0fb !important;
        border-color: #d6e9f9 !important;
    }
    strong{
        font-family: 'GTWalsheimProBold';
    }
    .nav-pills .nav-link{
        position: relative;
        color: #000 !important;
    }
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        color: #000 !important;
        background-color: unset !important;
    }
    .nav-tabs .nav-link:hover, .nav-tabs .nav-link:focus {
        color: #1d68a7  !important;
    }
    .activetab .nav-item .nav-link.active:before {
        content: "";
        position: absolute;
        left: 17px;
        width: 23px;
        height: 3px;
        background: #56bf9a;
        bottom: 0;
        border-radius: 35px 35px;
    }
    .checkbox-style {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 14px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    .checkbox-style input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }
    .checkbox-style input:checked ~ .checkmark {
        background-color: #6dccae;
        border: 1px solid #6dccae;
    }
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 22px;
        width: 22px;
        background: none;
        border: 1px solid #efefef;
        border-radius: 50% 50%;
    }
    .checkbox-style input:checked ~ .checkmark:after {
        display: block;
    }


    .checkbox-style .checkmark:after {
        left: 8px;
        top: 3px;
        width: 5px;
        height: 11px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(
    45deg);
    }
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }
    .navbar .navbar-toggle .icon-bar {
        background-color: inherit;
        border: 1px solid;
        display: block;
        position: relative;
        background: #fff;
        width: 24px;
        height: 2px;
        border-radius: 1px;
        margin: 0 auto;
    }
    .navbar .navbar-toggle {
        background-color: transparent;
        border: none;
        margin: 10px 15px 10px 0;
        width: 40px;
        height: 40px;
    }
    .app-sidebar .sidebar-background:after, .off-canvas-sidebar .sidebar-background:after{
        background: #3C4B64 !important;
        opacity: 1 !important;
    }
    .app-sidebar, .off-canvas-sidebar{
        font-family: 'GTWalsheimProRegular'  !important;
    }
    .app-sidebar .navigation>li.active:hover, .off-canvas-sidebar .navigation>li.active:hover {
        background: rgba(255, 255, 255, 0.05);
    }
    .app-sidebar .navigation li a {
        color: #fff !important;
        border-radius: unset !important;
        box-shadow: unset;
        padding: 10px 30px;
        margin: 0;
    }
    .app-sidebar .navigation li.active a {
        background: rgba(255, 255, 255, 0.05) !important;
        color: #fff !important;
        border-radius: unset !important;
        box-shadow: unset;
        padding: 10px 30px;
        margin: 0;
    }
    .app-sidebar .navigation > li.active > a i, .off-canvas-sidebar .navigation > li.active > a i {
        color: white !important;
    }
    .app-sidebar .navigation i, .off-canvas-sidebar .navigation i
    {
        color:  rgba(255, 255, 255, 0.6)  !important;
    }
    .app-sidebar .navigation li.has-sub>a:after, .off-canvas-sidebar .navigation li.has-sub>a:after{
        transform: rotate(180deg) ;
        -webkit-transform: rotate(180deg) ;
    }
    .app-sidebar .navigation li.open>a:after, .off-canvas-sidebar .navigation li.open>a:after{
        transform: rotate(90deg) ;
        -webkit-transform: rotate(90deg) ;
    }
    .app-sidebar .navigation li:hover>a, .off-canvas-sidebar .navigation li:hover>a {
        color: #fff;
    background: #321fdb;
    }
    .app-sidebar .navigation li.open>a, .off-canvas-sidebar .navigation li.open>a,.app-sidebar .navigation li.open .menu-content, .off-canvas-sidebar .navigation li.open .menu-content {
        background: rgba(0, 0, 0, 0.2);
    }
    .app-sidebar .navigation li.is-shown:hover>a, .off-canvas-sidebar .navigation li.is-shown:hover>a{
        background: none !important;
    }
    .c-sidebar-nav-title {
        padding: 0.25rem 2.25rem;
        margin-top: 1rem;
        font-size: 80%;
        font-weight: 700;
        text-transform: uppercase;
        transition: 0.3s;
        color: rgba(255, 255, 255, 0.6);
    }
    .navbar .navbar-toggle:focus{
        outline: none;  
    }
    .navbar .navbar-container{
        position: absolute;
        right: 50px;
    }
    .nav-header-lists{
        list-style: none;
        display: flex;
        align-items: center;
        margin-bottom: 0px;
    }
    .top-nav{
        padding-left: 270px;
        top: 75px;
        z-index: 3;
    }
    .navbar{
        box-shadow: unset !important;
    }
    .main-panel{
        margin-top: 125px !important;
    }
    .border-bottom{
        border-bottom: 1px  solid #ddd;
    }
    .dropdown-toggle::after{
        display: none;
    }
    .btn-primary {
        background-color: #321FDB!important;
        color: #fff!important;
        border-color: #321FDB;
    }
    .btn-danger {
        background-color: #E55353!important;
        color: #fff!important;
        border-color: #E55353;
    }
    .btn-info {
        background-color: #3399FF!important;
        color: #fff!important;
        border-color: #3399FF;
    }
    .btn-default {
        background-color: #CED2D8!important;
        color: #fff!important;
        border-color: #CED2D8;
        padding-top: 3px;
        padding-bottom: 3px;
    }
    .card{
        border-radius: 0 !important;
    }
    .card-header{
        border-bottom: 1px solid #ddd !important;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.25rem .75rem !important;
    }
    .btn-create{
        background-color: transparent;
        color: #000 ;
        border-color: transparent;
    }
    .bg-success{
        background: #2EB85C !important;
    }
    .bg-danger{
        background: #ff092a !important;
    }
    .permission-tree ul li{
        line-height: normal;
    }
</style>
