<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>@yield('title') | Google analytics reporting</title>
    <meta name="description" content="Recevez des rapports des données de google analytics sur votre slack">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo asset('img/logo/apple-touch-icon-57x57.png'); ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo asset('img/logo/apple-touch-icon-60x60.png'); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo asset('img/logo/apple-touch-icon-72x72.png'); ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo asset('img/logo/apple-touch-icon-76x76.png'); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo asset('img/logo/apple-touch-icon-114x114.png'); ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo asset('img/logo/apple-touch-icon-120x120.png'); ?>">
    <link rel="icon" type="image/png" href="<?php echo asset('img/logo/favicon-32x32.png" sizes="32x32'); ?>">
    <link rel="icon" type="image/png" href="<?php echo asset('img/logo/favicon-96x96.png" sizes="96x96'); ?>">
    <link rel="icon" type="image/png" href="<?php echo asset('img/logo/favicon-16x16.png" sizes="16x16'); ?>">
    <link rel="manifest" href="<?php echo asset('img/logo/manifest.json'); ?>">
    <link rel="mask-icon" href="<?php echo asset('img/logo/safari-pinned-tab.svg'); ?>" color="#5bbad5">
    <link rel="shortcut icon" href="<?php echo asset('img/logo/favicon.ico'); ?>">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="<?php echo asset('img/logo/browserconfig.xml'); ?>">
    <meta name="theme-color" content="#ffffff">
    <link href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo asset('css/bootstrap.min.css'); ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo asset('css/font-awesome.min.css'); ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo asset('css/font-lineicons.css'); ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo asset('css/animate.css'); ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo asset('css/toastr.min.css'); ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo asset('css/select2.min.css'); ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo asset('css/style.css'); ?>" type="text/css" media="all" />
    
    <!--[if lt IE 9]>
        <script src="<?php echo asset('js/html5.js'); ?>"></script>
        <script src="<?php echo asset('js/respond.min.js'); ?>"></script>
    <![endif]-->
</head>

@if (Auth::guest() || Request::is('install') || Request::is('privacy-policy') )
    <body id="landing-page">
@else
    <body id="shortcodes-page">
@endif

    <!-- Preloader -->
    <div id="mask">
        <div id="loader"></div>
    </div>
    <header>
        <div class="header-holder">
        <nav class="navigation navigation-header">
            <div class="container-fluid">
                <div class="navigation-brand">
                    <div class="brand-logo">
                        <a href="{{ URL::route('home') }}" class="logo"></a>
                        <span class="sr-only"></span>
                    </div>
                    <button class="navigation-toggle visible-xs" type="button" data-toggle="dropdown" data-target=".navigation-navbar">
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navigation-navbar">
                    @if (Auth::guest())
                        <ul class="navigation-bar navigation-bar-right">

                            <li class="{{ Request::is('install') ? 'active' : '' }}"><a href="{{ URL::route('install') }}">{{ trans('app.install') }}</a></li>
                            <li class="{{ Request::is('support') ? 'active' : '' }}"><a href="{{ URL::route('support') }}">{{trans('app.support')}}</a></li>
                            <li class="{{ Request::is('login') ? 'active' : '' }}"><a href="{{ URL::route('login') }}">{{trans('app.login')}}</a></li>
                            <li class="featured  class="{{ Request::is('register') ? 'active' : '' }}""><a href="{{ URL::route('register') }}">{{trans('app.register')}}</a></li>
                            <li> 
                                @if (App::isLocale('en') or App::isLocale('') )
                                    <a href="{{ URL::route('lang', ['lang' => 'fr']) }}">
                                        <img style="max-width:30px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEYAAAAvCAYAAABe1bwWAAABlElEQVRoQ+3bv07CUBTH8d/BQYluYpx8D0cXWxYHTZCS+DcODj6MM5oIiQ6WKiRO+gY8isS4OACLHENDSUUlnFiGm/yYCFxK7iffnulWkHr5lUYRAz2HYBPAOgBJf29936ztWn8y8/r+0cXMa6csVEA7AmkrctXVqPqcrI03vnVSW1rs5+uAlLP4t+QaDsBMbFfCLpZPN6LLXgzjBeGtAAdZogyv5R4MoCp3hYerQ9ku33s5kZesUVyFiR1UfPGDxiOge4T5JtASPwjfABQIkxbQ1yGMzgPF6VsJGBDmjyoIQxjbwGAxLIbF2ARYjM2LM4bFsBibAIuxeXHGsBgWYxNgMTYvzhgWw2JsAizG5sUZw2JYjE2Axdi8OGNYDIuxCbAYmxdnDIthMTYBFmPz4oxhMSzGJjClGJ7B+4Gj7+IFYVOAuRzhdvGc78ioxXO+v91KgiJPhk/AjE+GDz8vlRr5jwWtA9jPZHKNLuLcrSSIurpyPH6WIMHwKuGOqJwBmjx98i8nR2A6ArQ/gZu16Pop2fAXkg44lBfMKAsAAAAASUVORK5CYII=">
                                    </a>
                                @else
                                    <a href="{{ URL::route('lang', ['lang' => 'en']) }}">
                                        <img style="max-width:30px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEYAAAAvCAYAAABe1bwWAAADfElEQVRoQ+2bX0hTURzHv2dO829ONpNMs4ggiF4KzB4KKTOVEjJ1EEWZ+A8q6imlh3qIwPXQH+jBpFooas4/YBD21EuG/YGgeqkWgovp0G3+mzP358S9sGWx7e7eyby73vM0uL9zzu/72fccfmc7l2BFK9MZS0DRAKAAQBYAsvL5an7u+Ni6msMJHYsC1EJARikUbWpD27BvIFZ44c2xxOQkjx6AVugMfPuJBMx/aZPni0ipyTXcdbJgynQ/O0DpGb7iIokXJxiAUtKp6Xt0lpTqfhQTSl5FIlJIX7GCYbVQcoyUtRr7AVQIERdJH1GDAQYZMFMANJGIFNJX3GDoJAOGChGWnRGPhiMa3OibENId4gYDr2AwVQUqnD+kRl37OMx2F284IgcDwWB0p7dgd04iOt/Y0P3WLoNhCKQlKtB1aTsUBKxbGNfwbZJ0zNE9abhSusnPornbjC8mJy82hstbecVHO5j3UspRx+O2NhvqVKU/V8usG61DFnybWAo7/5gG01ikYQEkb1CwgpkltC0zAXHMGgrQnMteeLyA0+WFx0MxNedGc485YGxMg7lQqMapfFXYLlgZ6PJQ3Hlhwch3h/TAMIrK96Wj7rCG3WjDbfNLXtwanMTXEPtOTDvGB6JgZwpayrOgjOOmMz3vxvVeM35ZQ9c2kgDDAKrIV6G2UM1pmmvd5pBO8Q0gGTCZaUrom/JCgllY8kL7YIwTHhMgHTAbldA3hgaz7KaoujcGt5f7+CUZMAd3paK5nPm1M3Rr6THj8zh3sSeZyrepSIPje9NZKnaHB10jNhgtv5GnSYD2QAY2q+LZZwMfZvD4tZWLn9hP1+EfIh/W5LLF3TujA/eHpzC76PGLT1ASFk5lvgommwsXn5rWD5hnTXnoHbXj5ac5BNtBmOPC/h0p6H8/s37AcCrlGSCZPYanbs5wGUwQRDIYGQzn6vknQHZMrDrG4Vzmrt/5mUES0UQGE/h7lMEE8bcMRgbDb+uTHSM7RnYMPwLBHGOtqpPrmABwiAwmSB0jg5HB8Np7mKW0JnfweGUZ9WBqZcAMADgZ9bnFPeEgsVbWF4PQqN/zFTUXghL2X/rpyvoOQqJ7M1ysYPw3w5kETVVXk5Lpgh4E1WJNOCp5ERgWaeo5/7sEvklt1bUnQBW19O/bJ1HJZ40nsRBg1AM8yTS0D/ly+QMpzH7D4sxATQAAAABJRU5ErkJggg==">
                                    </a>
                                @endif
                            </li>
                        </ul>  
                    @else
                        <ul class="navigation-bar navigation-bar-right">
                            <li class="{{ Request::is('slack/channels') ? 'active' : '' }}"><a href="{{ URL::route('channels') }}">{{ trans('app.channels')}} </a></li>
                            <li class="{{ Request::is('ga/accounts') ? 'active' : '' }}"><a href="{{ URL::route('ga-accounts') }}">{{ trans('app.google_accounts')}}</a></li>
                            <li class="{{ Request::is('reportings') ? 'active' : '' }}"><a href="{{ URL::route('reportings') }}">{{ trans('app.reportings')}}</a></li>
                            <li class="{{ Request::is('install') ? 'active' : '' }}"><a href="{{ URL::route('install') }}">{{ trans('app.install') }}</a></li>
                            <li class="{{ Request::is('support') ? 'active' : '' }}"><a href="{{ URL::route('support') }}">{{trans('app.support')}}</a></li>
                            <li><a href="{{ URL::route('logout') }}">{{trans('app.logout')}}</a></li>
                            <li> 
                                @if (App::isLocale('en') or App::isLocale('') )
                                    <a href="{{ URL::route('lang', ['lang' => 'fr']) }}">
                                        <img style="max-width:30px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEYAAAAvCAYAAABe1bwWAAABlElEQVRoQ+3bv07CUBTH8d/BQYluYpx8D0cXWxYHTZCS+DcODj6MM5oIiQ6WKiRO+gY8isS4OACLHENDSUUlnFiGm/yYCFxK7iffnulWkHr5lUYRAz2HYBPAOgBJf29936ztWn8y8/r+0cXMa6csVEA7AmkrctXVqPqcrI03vnVSW1rs5+uAlLP4t+QaDsBMbFfCLpZPN6LLXgzjBeGtAAdZogyv5R4MoCp3hYerQ9ku33s5kZesUVyFiR1UfPGDxiOge4T5JtASPwjfABQIkxbQ1yGMzgPF6VsJGBDmjyoIQxjbwGAxLIbF2ARYjM2LM4bFsBibAIuxeXHGsBgWYxNgMTYvzhgWw2JsAizG5sUZw2JYjE2Axdi8OGNYDIuxCbAYmxdnDIthMTYBFmPz4oxhMSzGJjClGJ7B+4Gj7+IFYVOAuRzhdvGc78ioxXO+v91KgiJPhk/AjE+GDz8vlRr5jwWtA9jPZHKNLuLcrSSIurpyPH6WIMHwKuGOqJwBmjx98i8nR2A6ArQ/gZu16Pop2fAXkg44lBfMKAsAAAAASUVORK5CYII=">
                                    </a>
                                @else
                                    <a href="{{ URL::route('lang', ['lang' => 'en']) }}">
                                        <img style="max-width:30px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEYAAAAvCAYAAABe1bwWAAADfElEQVRoQ+2bX0hTURzHv2dO829ONpNMs4ggiF4KzB4KKTOVEjJ1EEWZ+A8q6imlh3qIwPXQH+jBpFooas4/YBD21EuG/YGgeqkWgovp0G3+mzP358S9sGWx7e7eyby73vM0uL9zzu/72fccfmc7l2BFK9MZS0DRAKAAQBYAsvL5an7u+Ni6msMJHYsC1EJARikUbWpD27BvIFZ44c2xxOQkjx6AVugMfPuJBMx/aZPni0ipyTXcdbJgynQ/O0DpGb7iIokXJxiAUtKp6Xt0lpTqfhQTSl5FIlJIX7GCYbVQcoyUtRr7AVQIERdJH1GDAQYZMFMANJGIFNJX3GDoJAOGChGWnRGPhiMa3OibENId4gYDr2AwVQUqnD+kRl37OMx2F284IgcDwWB0p7dgd04iOt/Y0P3WLoNhCKQlKtB1aTsUBKxbGNfwbZJ0zNE9abhSusnPornbjC8mJy82hstbecVHO5j3UspRx+O2NhvqVKU/V8usG61DFnybWAo7/5gG01ikYQEkb1CwgpkltC0zAXHMGgrQnMteeLyA0+WFx0MxNedGc485YGxMg7lQqMapfFXYLlgZ6PJQ3Hlhwch3h/TAMIrK96Wj7rCG3WjDbfNLXtwanMTXEPtOTDvGB6JgZwpayrOgjOOmMz3vxvVeM35ZQ9c2kgDDAKrIV6G2UM1pmmvd5pBO8Q0gGTCZaUrom/JCgllY8kL7YIwTHhMgHTAbldA3hgaz7KaoujcGt5f7+CUZMAd3paK5nPm1M3Rr6THj8zh3sSeZyrepSIPje9NZKnaHB10jNhgtv5GnSYD2QAY2q+LZZwMfZvD4tZWLn9hP1+EfIh/W5LLF3TujA/eHpzC76PGLT1ASFk5lvgommwsXn5rWD5hnTXnoHbXj5ac5BNtBmOPC/h0p6H8/s37AcCrlGSCZPYanbs5wGUwQRDIYGQzn6vknQHZMrDrG4Vzmrt/5mUES0UQGE/h7lMEE8bcMRgbDb+uTHSM7RnYMPwLBHGOtqpPrmABwiAwmSB0jg5HB8Np7mKW0JnfweGUZ9WBqZcAMADgZ9bnFPeEgsVbWF4PQqN/zFTUXghL2X/rpyvoOQqJ7M1ysYPw3w5kETVVXk5Lpgh4E1WJNOCp5ERgWaeo5/7sEvklt1bUnQBW19O/bJ1HJZ40nsRBg1AM8yTS0D/ly+QMpzH7D4sxATQAAAABJRU5ErkJggg==">
                                    </a>
                                @endif
                            </li>
                        </ul>
                    @endif
                    
                </div>
            </div>
        </nav>
    </div>
    </header>

    @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>{{ Session::get('success') }}</strong>
            <i class="icon icon-badges-votes-10"></i>
        </div>
    @endif 
    

    @if(Session::has('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>{{ Session::get('error') }}</strong>
            <i class="icon icon-badges-votes-11"></i>
        </div>
    @endif  

    @yield('content')

    <footer id="" class=" light">
        <div class="copyright">© copyright <a href="https://ga-creation.fr"> GA-creation </a> {{ trans('app.footer_rights')}}
</div>
    </footer>
    
    <div class="back-to-top"><i class="fa fa-angle-up fa-3x"></i></div>
    
    <!--[if lt IE 9]>
        <script type="text/javascript" src="<?php echo asset('js/jquery-1.11.0.min.js?ver=1'); ?>"></script>
    <![endif]-->  
    <!--[if (gte IE 9) | (!IE)]><!-->  
        <script type="text/javascript" src="<?php echo asset('js/jquery-2.1.0.min.js?ver=1'); ?>"></script>
    <!--<![endif]-->  
    
    <script type="text/javascript" src="<?php echo asset('js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/jquery.flexslider-min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/jquery.nav.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/jquery.appear.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/jquery.plugin.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/waypoints.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/waypoints-sticky.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/headhesive.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/select2.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/scripts.js'); ?>"></script>

    <script>
    $(document).ready(function(){
    
        if($(".select-multiple").length > 0){
                $(".select-multiple").select2({'placeholder': '{{ trans("app.metric_placeholder" ) }}'.replace('&eacute;', 'é' )});
            }
        })
    </script>
    {!! Analytics::render() !!}
</body>
</html>