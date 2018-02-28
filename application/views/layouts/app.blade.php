<!DOCTYPE html>
<html lang="{{ Config::get('application.language') }}">
<head>
  <meta charset="{{ Config::get('application.encoding') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=2" />
  <title>{{__('messages.title')}}</title>
  <!-- Web Icon -->
  <!-- <link rel="apple-touch-icon" href="images/webclip.png" /> -->
  <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="favicon.ico">
  <link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico">
  <link rel="icon" type="image/png" sizes="96x96" href="favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="96x96" href="favicon-196x196.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
  <!-- <link rel="manifest" href="/manifest.json"> -->
  <meta name="msapplication-TileColor" content="#2d88ef">
  <meta name="msapplication-TileImage" content="mstile-144x144.png">
  <!-- SEO -->
  <meta property="og:title" content="{{__('messages.og_title')}}" />
  <meta property="og:type" content="{{__('messages.og_type')}}" />
  <meta property="og:url" content="{{__('messages.og_url')}}" />
  <meta property="og:image" content="{{__('messages.og_image')}}" />
  <meta property="og:site_name" content="{{__('messages.og_site_name')}}" />
  <meta property="og:description" content="{{__('messages.og_description')}}" />
  {{ HTML::style('css/front.min.css') }}
  @yield('scripts')
</head>
<body>
  <!-- Scripts -->
  {{ HTML::script('js/front.js') }}
  @yield('javascript')
</body>
</html>
