<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo csrf_token() ?>"/>
    <title>Dynamic Excel Importer 1.0</title>

    <link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/select2.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/style.css')}}" rel="stylesheet">
    <script src="{{asset("public/js/jquery-2.1.4.js")}}"></script>

    @yield('style')
            <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset("public/css/font-awesome.min.css")}}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>    <![endif]-->

    <script>
        var siteUrl = '{{url("/")}}';
    </script>
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><i class="fa fa-file-excel-o"></i> Dynamic Excel Importer 1.0</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">

            <ul class="nav navbar-nav navbar-right">
                <li><a href="https://github.com/haruncpi/Dynamic-Excel-Importer" target="_blank"><i
                                class="fa fa-github"></i> Github</a></li>
                <li><a href="{{route('homepageRoute')}}"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="{{route('importRoute')}}"><i class="fa fa-database"></i> Import</a></li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('danger'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong></strong> {{Session::get('danger')}}
                </div>
            @endif
        </div>
    </div>
</div>
@yield('content')
<div class="footer navbar-fixed-bottom">
    <div class="container">
        <div class="row">
            <hr>
            <div class="col-md-6">
                <p><i class="fa fa-user"></i> Developed By : <a href="http://learn24bd.com" target="_blank">Harun</a>
                </p>
            </div>
            <div class="col-md-6">
                <p class="text-right">All rights reserved</p>
            </div>
        </div>
    </div>
</div>
<!-- Scripts -->
<script src="{{asset("public/js/bootstrap.min.js")}}"></script>
<script src="{{asset("public/js/select2.js")}}"></script>
<script src="{{asset("public/js/sweetalert.min.js")}}"></script>
<script src="{{asset("public/js/laravel-ajax-setup.js")}}"></script>
<script src="{{asset("public/js/functions.js")}}"></script>
@yield('script')
</body>
</html>
