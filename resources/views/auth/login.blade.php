<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <style type="text/css">
        #login-register {
            background: url('{{asset('public/admin/images/bg.jpg')}}') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            /* Set rules to fill background */
            min-height: 100%;
            min-width: 1024px;
            /* Set up proportionate scaling */
            width: 100%;
            height: auto;
            /* Set up positioning */
            position: fixed;
            top: 0;
            left: 0;
            color: #fff;
            font-family: arial;
        }

        #formBox {
            margin-top: 150px;
            padding: 20px;
            background: rgba(0, 0, 0, 0.3);
        }

        #formBox #loginPic {
            margin: 0px auto;
            width: 80px;
            height: 80px;
            padding: 10px;
            border-radius: 50%;
            background: #ED5565;
            text-align: center;
            color: #fff;
        }

        #formBox .form-group {
            margin-top: 25px;
        }

        @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
            #formBox {
                margin-top: 50px;
                padding: 10px;
                background: rgba(0, 0, 0, 0.3);
            }

        }
    </style>
</head>
<body>
<div id="blur-screen">
</div>
<section id="login-register">
    <div class="container">
        <div class="row">
            <div class="col-md-12">


                <div class="col-md-4 col-xs-12 pull-right" id="formBox">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div id="login">
                        <form method="POST" action="{{url('auth/login')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    <input autofocus type="text" name="email" value="{{old('email')}}"
                                           class="form-control label_better" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                    <input type="password" name="password" class="form-control label_better"
                                           placeholder="Password">
                                </div>
                            </div>
                         <div class="row">
                             <div class="col-md-6 pull-left text-left">
                                 <button class="btn btn-danger" type="submit">Login</button>
                             </div>
                             <div class="col-md-6 pull-right text-right">
                                 <a href="{{url('password/email')}}" class="btn btn-default">Forgot Password</a>
                             </div>
                         </div>


                        </form>
                    </div>
                    <!-- ### end login -->
                    <div id="register">

                    </div>
                    <!-- ### end register -->
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>


