<!doctype html>
<html lang="en">
<head>
    <link rel="icon" href="{!! get_option('site_fav','/assets/default/404/images/favicon.png') !!}" type="image/png" sizes="32x32">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{!! get_option('site_description','') !!}">
    <link rel="stylesheet" href="/assets/default/vendor/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/assets/default/vendor/bootstrap/css/bootstrap-3.2.rtl.css"/>
    <link rel="stylesheet" href="/assets/default/vendor/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/assets/default/vendor/owlcarousel/dist/assets/owl.carousel.min.css"/>
    <link rel="stylesheet" href="/assets/default/vendor/raty/jquery.raty.css"/>
    <link rel="stylesheet" href="/assets/default/view/fluid-player-master/fluidplayer.min.css"/>
    <link rel="stylesheet" href="/assets/default/vendor/simplepagination/simplePagination.css"/>
    <link rel="stylesheet" href="/assets/default/vendor/easyautocomplete/easy-autocomplete.css"/>
    <link rel="stylesheet" href="/assets/default/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css"/>
    <link rel="stylesheet" href="/assets/default/vendor/jquery-te/jquery-te-1.4.0.css"/>
    <link rel="stylesheet" href="/assets/default/stylesheets/vendor/mdi/css/materialdesignicons.min.css"/>
    @if(get_option('site_rtl','0') == 1)
        <link rel="stylesheet" href="/assets/default/stylesheets/view-custom-rtl.css"/>
    @else
        <link rel="stylesheet" href="/assets/default/stylesheets/view-custom.css?time={!! time() !!}"/>
    @endif
    <link rel="stylesheet" href="/assets/default/stylesheets/view-responsive.css"/>
    @if(get_option('main_css')!='')
        <style>
            {!! get_option('main_css') !!}
        </style>
    @endif
    <script type="application/javascript" src="/assets/default/vendor/jquery/jquery.min.js"></script>
    <title>@yield('title'){!! $title ?? '' !!}</title>
    @yield('style')
</head>
<body>
<div class="container-fluid">
    <div class="row line-header"></div>
    <div class="col-md-10 col-md-offset-1">
        <div class="row middle-header">
            <div class="col-md-3 col-xs-12 tab-con">
                <div class="row">
                    <a href="/">
                        <img src="{{ get_option('site_logo') }}" alt="{{ get_option('site_title') }}" class="logo-icon"/>
                        <img src="{{ get_option('site_logo_type') }}" alt="{{ get_option('site_title') }}" class="logo-type"/>
                    </a>
                </div>
            </div>
            <div class="col-md-5 col-xs-12 tab-con">
                <div class="row search-box">
                    <form action="/search">
                        {{ csrf_field() }}
                        <input type="text" name="q" class="col-md-11 provider-json" placeholder="Search..."/>
                        <button type="submit" name="search" class="pull-left col-md-1"><span class="homeicon mdi mdi-magnify"></span></button>
                    </form>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 text-center tab-con">
                <div class="row">
                    @if(isset($user) && isset($user['vendor']) && $user['vendor'] == 1)
                        <a href="/user/content/new" class="header-upload-button pulse"><span class="headericon mdi mdi-arrow-up-bold"></span>{{ trans('main.upload_course') }}</a>
                    @endif
                    @if(isset($user))
                        <a href="/user/ticket" class="header-login-in-button">
                            <img src="{{ $userMeta['avatar'] ?? get_option('default_user_avatar','') }}" class="user-header-avatar">
                            <span class="header-title-caption">{{ $user['name'] }}</span>
                            <span class="headericon mdi mdi-chevron-down"></span>
                            <label class="alert">
                                @if(isset($alert['all']) && $alert['all']>0)
                                    <span class="noti-holder">{{ $alert['all'] }}</span>
                                @endif
                                <span class="noti-icon headericon mdi mdi-bell-alert"></span>
                            </label>
                            <label onclick="event.stopPropagation();" class="alert alert-f">
                                @if(isset($alert['ticket']) && $alert['ticket']>0)
                                    <span>{{ $alert['ticket'] }}</span>
                                @endif
                                <i class="headericon mdi mdi-email"></i>
                            </label>
                            <div class="animated user-overlap sbox3">
                                <div class="overlap-profile-viewer">
                                    @if(isset($user) && isset($user['vendor']) && $user['vendor'] == 1)
                                        <a href="/user/dashboard">
                                            <img src="{{ !empty($userMeta['avatar']) ? $userMeta['avatar'] : '/assets/default/images/user.png' }}" class="dash-s">
                                        </a>
                                    @else
                                        <a href="/user/content"><img src="{{ !empty($userMeta['avatar']) ? $userMeta['avatar'] : '/assets/default/images/user.png' }}" class="dash-s"></a>
                                    @endif
                                    @if(isset($user) && isset($user['vendor']) && $user['vendor'] == 1)
                                        <div class="overlap-profile-viewer-info">
                                            <a href="/user/dashboard" class="dash-s2"><span>{{ !empty($user['category']['title']) ? $user['category']['title'] : 'General User' }}</span></a>
                                            <a href="/user/dashboard" class="btn btn-danger">{{ trans('main.user_panel') }}</a>
                                        </div>
                                    @else
                                        <div class="overlap-profile-viewer-info">
                                            <a href="/user/video/buy" class="dash-s2"><span>{{ !empty($user['category']['title']) ? $user['category']['title'] : 'General User' }}</span></a>
                                            <a href="/user/video/buy" class="btn btn-danger">{{ trans('main.user_panel') }}</a>
                                        </div>
                                    @endif
                                </div>
                                <ul>
                                    <li><a href="/profile/{{ $user['id'] }}"><span class="headericon mdi mdi-account"></span>
                                            <p>{{ trans('main.profile') }}</p></a></li>
                                    <li><a href="/user/ticket"><span class="headericon mdi mdi-headset"></span>
                                            <p>{{ trans('main.support') }}</p></a></li>
                                    <li><a href="/user/profile"><span class="headericon mdi mdi-settings"></span>
                                            <p>{{ trans('main.settings') }}</p></a></li>
                                    <li><a href="/logout"><span class="headericon mdi mdi-power"></span>
                                            <p>{{ trans('main.exit') }}</p></a></li>
                                </ul>
                            </div>
                        </a>
                    @else
                        <a href="/user?redirect={{ Request::path() }}" class="header-login-button"><span class="headericon mdi mdi-account"></span>{{ trans('main.login_signup') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row sep"></div>
    <div class="hidden-xs" id="header-menu-section">
        <div class="row">
            <div class="menu-header">

                <div class="col-md-1 text-center tab-con">
                    <a href="/"><img src="{{ get_option('site_logo') }}" class="menu-logo"/></a>
                </div>
                <div class="col-md-10 col-xs-12 tab-con">
                    <ul id="accordion" class="cat-filters-li accordion accordion-s">
                        @foreach($setting['category'] as $mainCategory)
                            @if(count($mainCategory->childs)>0)
                                <li class="has-child" onmouseover="this.style.borderColor='{{ $mainCategory->color }}'" onmouseleave="this.style.borderColor='transparent'">
                                    <a href="javascript:void(0);">
                                        <img src="{{ $mainCategory->image }}"/>
                                        {{  $mainCategory->title }}
                                    </a>
                                    <ul>
                                        @foreach($mainCategory->childs as $child)
                                            <li onmouseover="this.style.borderColor='{{ $child->color }}'" onmouseleave="this.style.borderColor='transparent'">
                                                <a href="/category/{{ $child->class }}">
                                                    <img src="{{ $child->image }}"/>
                                                    {{ $child->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="no-child" onmouseover="this.style.borderColor='{{ $mainCategory->color }}'" onmouseleave="this.style.borderColor='transparent'">
                                    <a href="/category/{{ $mainCategory->class }}">
                                        <img src="{{ $mainCategory->image }}"/>
                                        {{ $mainCategory->title }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

            </div>
            <div class="sep-green"></div>
            <div class="menu-header menu-header-child">

                <div class="col-md-10 col-xs-12 col-md-offset-1">
                    <ul>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="hidden-md hidden-lg hidden-sm mobile-menu">
        <div class="row h-20"></div>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><b>{{ trans('main.category') }}</b></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        @foreach($setting['category'] as $mainCategory)
                            @if(count($mainCategory->childs)>0)
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$mainCategory->title}}<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        @foreach($mainCategory->childs as $child)
                                            <li><a href="/category/{{ $child->class }}">{{ $child->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li><a href="/category/{{ $mainCategory->class }}">{{$mainCategory->title}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>
</div>


