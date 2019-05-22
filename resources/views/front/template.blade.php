<!DOCTYPE html>
<!--
	ustora by freshdesignweb.com
	Twitter: https://twitter.com/freshdesignweb
	URL: https://www.freshdesignweb.com/ustora/
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web 2 | E-Commerce</title>
    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('front/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('front/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('tambahan_css')
  </head>
  <body>
   
    <div class="header-area">
        <div class="container">
            <div class="row">       
                <div class="col-md-12">
                    <div class="header-right">
                        <ul class="list-unstyled list-inline">
                            @auth
                            <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#">
                                    <span class="key">{{ Auth::user()->name }}</span><b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li style="text-align: left"><a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();"><i class="fa fa-lock"></i> Logout</a></li>
                                    <li><a href="{{ url('home') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                                </ul>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            @else
                            <li>
                                <li><a href="{{ url('login') }}"><i class="fa fa-user"></i> Login</a></li>
                            </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End header area -->
    
    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="{{ url('/') }}"><img src="{{ asset('front/img/logo.png') }}"></a></h1>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="shopping-item">
                        <a href="{{ route('carts.index') }}" ><i class="fa fa-shopping-cart" style="margin-left:0px;"></i> <span class="product-count">{{ session('cart') == null ? 0 : count(session('cart')) }}</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->
    
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="{{ Request::segment(1) == '' ? 'active' : '' }}"><a href="{{ url('/')}}">Home</a></li>
                        <li class="{{ Request::segment(1) == 'product_public' ? 'active' : '' }}"><a href="{{ url('product_public')}}">Shop page</a></li>
                        <li class="{{ Request::segment(1) == 'carts' ? 'active' : '' }}"><a href="{{ url('carts')}}">Cart</a></li>
                        @auth
                        <li><a href="{{ route('admin.orders.create') }}">Checkout</a></li>
                        @endauth                        
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->
    @yield('content')
    
    <div class="footer-bottom-area" style="padding: 5px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="copyright" style="margin: 0px;">
                        <p>&copy; {{ date('Y') }} Dani Kurniawan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer bottom area -->
   
    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    
    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!-- jQuery sticky menu -->
    <script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.sticky.js') }}"></script>
    
    <!-- jQuery easing -->
    <script src="{{ asset('front/js/jquery.easing.1.3.min.js') }}"></script>
    
    <!-- Main Script -->
    <script src="{{ asset('front/js/main.js') }}"></script>
    
    <!-- Slider -->
    <script type="text/javascript" src="{{ asset('front/js/bxslider.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/js/script.slider.js') }}"></script>
    
    @yield('tambahan_js')
  </body>
</html>