<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <title>Microblog</title>
    <link rel="icon" href="{{asset('assets/images/fav.png')}}" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="{{asset('assets/css/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/color.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">

</head>
<body>
<div class="theme-layout">

    <div class="responsive-header">
        <div class="mh-head first Sticky">

			<span class="mh-text">
				<a href="" title=""><img src="{{asset('assets/images/logo2.png')}}" alt=""></a>
			</span>

        </div>
        <div class="mh-head second">
            <form class="mh-form">
                <input placeholder="search"/>
                <a href="#/" class="fa fa-search"></a>
            </form>
        </div>
        <nav id="menu" class="res-menu">
            <ul>
                <li>
                    <a href="{{route('home')}}" title="">Home</a>
                </li>
            </ul>
        </nav>

    </div><!-- responsive header -->

    <div class="topbar stick">
        <div class="logo">
            <a title="" href="#"><img src="{{asset('assets/images/logo.png')}}" alt=""></a>
        </div>

        <div class="top-area">
            <ul class="setting-area">
                <li>
                    <a href="#" title="Home" data-ripple=""><i class="ti-search"></i></a>
                    <div class="searched">
                        <form method="post" class="form-search">
                            <input type="text" placeholder="Search Friend">
                            <button data-ripple><i class="ti-search"></i></button>
                        </form>
                    </div>
                </li>

            </ul>


            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                   
                @else
                    <li class="nav-item dropdown">
                        <div class="user-img">
                            <img src="{{auth()->user()->avatar??asset('assets/images/avatar.png')}}" alt="">
                            <span class="status f-online"></span>
                            <div class="user-setting">
                                <a href="{{route('timeline')}}" title=""><span class="fa fa-home"></span>Timeline</a>
                                <a href="#" title=""><span class="fa fa-edit"></span>Edit Profile</a>

                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                    <i class="ti-power-off"></i>
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div><!-- topbar -->

    @yield('content')

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="widget">
                        <div class="foot-logo">
                            <div class="logo">
                                <a href="#" title=""><img src="{{asset('assets/images/logo.png')}}" alt=""></a>
                            </div>
                        </div>
                        <ul class="location">
                            <li>
                                <i class="ti-map-alt"></i>
                                <p>33 new montgomery st.750 san francisco, CA USA 94105.</p>
                            </li>
                            <li>
                                <i class="ti-mobile"></i>
                                <p>+1-56-346 345</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- footer -->
</div>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/script.js')}}"></script>
@yield('scripts')
<script>
    $('#change-dp').on('change', function () {
        $('#dp-form').submit();
    })
</script>
</body>
</html>
