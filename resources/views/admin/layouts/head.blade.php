<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> 
    @if ( count(Auth::user()->unreadNotifications->where('type','App\Notifications\MaterialsNotifications')) )
    ({{ count(Auth::user()->unreadNotifications) }})
    @endif
  @yield('title')
  </title>
  <link rel="shortcut icon" href="{{ asset('/favicon.png') }}" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('/admin_styles/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/admin_styles/css/fontawesome-all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/admin_styles/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('/admin_styles/css/skins/_all-skins.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="shortcut icon" href="{{ asset('/user_styles/images/testlogo.png') }}" />
  @yield('css')

</head>
