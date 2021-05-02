<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Blog Network</title>
    <link rel="icon" href="{{asset('assets/js/script.js')}}" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="{{asset('assets/css/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/color.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">

</head>
<body>
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">
    <div class="container-fluid pdng0">
        <div class="row merged">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="land-featurearea">
                    <div class="land-meta">
                        <h1>My blog</h1>
                        <p>
                            My blog is free to use for as long as you want with two active projects.
                        </p>
                        <div class="friend-logo">
                            <span><img src="{{asset('assets/images/wink.png')}}" alt=""></span>
                        </div>
                        <a href="#" title="" class="folow-me">Follow Us on</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="login-reg-bg">
                    <div class="log-reg-area sign">
                        <h2 class="log-title">Login</h2>
                        <p>
                            Don’t use Blog Yet? <a href="#" title="">Take the tour</a> or <a href="#" title="">Join now</a>
                        </p>
                        <form method="post" action="{{ route('login') }}">
                        @csrf
                            <div class="form-group">
                                <input type="text" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ decrypt_string(old('email')) }}" required autocomplete="email" autofocus/>
                                <label class="control-label" for="email">Email</label><i class="mtrl-select"></i>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/>
                                <label class="control-label" for="password">Password</label><i class="mtrl-select"></i>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" checked="checked"/><i class="check-box"></i>Always Remember Me.
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" title="" class="forgot-pwd">Forgot Password?</a>

                            @endif

                            <div class="submit-btns">
                                <button class="mtr-btn signin" type="submit"><span>Login</span></button>
                                <button class="mtr-btn signup" type="button"><span>Register</span></button>
                            </div>
                        </form>
                    </div>
                    <div class="log-reg-area reg">
                        <h2 class="log-title">Register</h2>
                        <p>
                            Don’t use Blog Yet? <a href="#" title="">Take the tour</a> or <a href="#" title="">Join now</a>
                        </p>
                        <form method="post" action="{{ route('register') }}">
                        @csrf
                            <div class="form-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ decrypt_string(old('name')) }}" required autocomplete="name" autofocus/>
                                <label class="control-label" for="input">Full Name</label><i class="mtrl-select"></i>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ decrypt_string(old('email')) }}" required autocomplete="email"/>
                                <label class="control-label" for="input">Email</label><i class="mtrl-select"></i>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"/>
                                <label class="control-label" for="input">Password</label><i class="mtrl-select"></i>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <label class="control-label" for="input">Confirm Password</label><i class="mtrl-select"></i>

                            </div>

                            <a href="#" title="" class="already-have">Already have an account</a>
                            <div class="submit-btns">
                                <button class="mtr-btn " type="submit"><span>Register</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/script.js')}}"></script>
</body>

</html>
