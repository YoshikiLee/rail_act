<!DOCTYPE html>
<html lang="{{ Config::get('application.language') }}">
<head>
  <meta charset="{{ Config::get('application.encoding') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=2" />
  <title>{{__('messages.title_admin')}}</title>
  <!-- Web Icon -->
  <!-- <link rel="apple-touch-icon" href="images/webclip.png" /> -->
  <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="{{asset('favicon.ico')}}">
  <link rel="icon" type="image/vnd.microsoft.icon" href="{{asset('favicon.ico')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicon-96x96.png')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicon-196x196.png')}}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon-32x32.png')}}">
  <!-- <link rel="manifest" href="/manifest.json"> -->
  <meta name="msapplication-TileColor" content="#2d88ef">
  <meta name="msapplication-TileImage" content="{{asset('mstile-144x144.png')}}">
  <!-- SEO -->
  <meta property="og:title" content="{{__('messages.og_title')}}" />
  <meta property="og:type" content="{{__('messages.og_type')}}" />
  <meta property="og:url" content="{{__('messages.og_url')}}" />
  <meta property="og:image" content="{{__('messages.og_image')}}" />
  <meta property="og:site_name" content="{{__('messages.og_site_name')}}" />
  <meta property="og:description" content="{{__('messages.og_description')}}" />
  <link href="{{ asset('css/kanri.min.css') }}" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  @yield('scripts')
</head>
<body>
  <div id="wrapper">

      <!-- Navigation -->
      <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{ url('admin/kanri') }}">{{__('messages.kanri_title')}}</a>
          </div>
          <!-- /.navbar-header -->

          <ul class="nav navbar-top-links navbar-right">
              <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      <i class="fa fa-user fa-fw"></i> {{ Auth::user()->username }} <i class="fa fa-caret-down"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-user">
                      <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                      </li>
                      <li class="divider"></li>
                      <li><a href="{{ url('admin/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-fw"></i> {{__('messages.logout')}}</a>
                          <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
                          {{Form::token()}}
                          </form>
                      </li>
                  </ul>
                  <!-- /.dropdown-user -->
              </li>
              <!-- /.dropdown -->
          </ul>
          <!-- /.navbar-top-links -->

          <div class="navbar-default sidebar" role="navigation">
              <div class="sidebar-nav navbar-collapse">
                  <ul class="nav" id="side-menu">
                      <li>
                          <a href="{{ url('admin/kanri') }}"><i class="fa fa-dashboard fa-fw"></i> {{__('messages.dashboard_title')}}</a>
                      </li>
                      <li>
                          <a href="{{ url('admin/member') }}"><i class="fa fa-user fa-fw"></i> {{__('messages.member_title')}}</a>
                      </li>
                      <li>
                          <a href="{{ url('admin/content') }}"><i class="fa fa-file fa-fw"></i> {{__('messages.content_title')}}</a>
                      </li>
                      <li>
                          <a href="{{ url('admin/history') }}"><i class="fa fa-history fa-fw"></i> {{__('messages.history_title')}}</a>
                      </li>
                  </ul>
              </div>
              <!-- /.sidebar-collapse -->
          </div>
          <!-- /.navbar-static-side -->
      </nav>
      @yield('content')
  </div>
  <!-- /#wrapper -->

  <!-- Scripts -->
  <script src="{{ asset('js/kanri.min.js') }}"></script>
  @yield('javascript')
</body>
</html>
