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
  <link href="{{ asset('css/front.min.css') }}" rel="stylesheet">
  @yield('scripts')
</head>
<body>
  <header id="header">
    <h1>{{__('messages.header_title')}}</h1>
    <div class="line"></div>
    <div class="logo">
      @if (Auth::check() && Auth::user()->isadmin)
      <div class="logout"><a href="{{ url('admin/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{__('messages.logout_title')}}</a></div>
      <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
        {{Form::token()}}
      </form>
      <div class="logout"><a href="{{ url('admin/content') }}">{{__('messages.kanri_link')}}</a></div>
      @endif
      <a href="{{__('messages.logo_url')}}">
        <img src="{{asset('/images/logo.png')}}" width="550" height="80" alt="{{__('messages.logo_alt')}}"/>
      </a>
    </div>
  </header><!-- /header -->

  <div id="mainImg">
    <h2>
      <img src="{{asset('/images/main_title_kanrisha.png')}}"  alt="{{__('messages.title_admin')}}" class="pc"/>
      <img src="{{asset('/images/main_title_kanrisha_sp.png')}}"  alt="{{__('messages.title_admin')}}" class="sp"/>
    </h2>
  </div>

  @yield('content')

  <!-- InstanceEndEditable -->
  <footer id="footer" class="clearfix"><!-- /footer-btn/sp -->
    <div id="pageTop"><a href="#header"><img src="{{asset('/images/gototop.gif')}}" width="1" height="1"></a></div>
    <div class="line"></div>
    <address>{{__('messages.footer_copyright')}}</address>
  </footer><!-- /footer -->
  <!-- Scripts -->
  <script src="{{ asset('js/front.min.js') }}"></script>
  @yield('javascript')
</body>
</html>
