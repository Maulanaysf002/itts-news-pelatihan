<base href="./">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="DIGIYOK">
<meta name="keyword" content="">
<link href="{{ asset('img/logo/ITTS-logo.png') }}" rel="icon">
<title>{{ config('app.name') }} - @yield('title')</title>

<!-- Favicon-->
<link href="{{ asset('img/favicon/apple-touch-icon.png') }}" rel="apple-touch-icon" sizes="180x180">
<link type="image/png" href="{{ asset('img/favicon/favicon-32x32.png') }}" rel="icon" sizes="32x32">
<link type="image/png" href="{{ asset('img/favicon/favicon-16x16.png') }}" rel="icon" sizes="16x16">
<link href="{{ asset('img/favicon/site.webmanifest') }}" rel="manifest">
<link href="{{ asset('img/favicon/safari-pinned-tab.svg') }}" rel="mask-icon" color="#4aca9f">
<meta name="msapplication-TileColor" content="#4aca9f">
<meta name="theme-color" content="#ffffff">

<!-- Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Icons-->
<link type="text/css" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('vendor/iconic/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('vendor/materialdesign/css/materialdesignicons.min.css') }}" rel="stylesheet">

<!-- Custom fonts for this template-->
<link
  href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
  rel="stylesheet">

<!-- Main styles for this application-->
<link href="{{ asset('css/admin/digiyok.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/custom.css') }}" rel="stylesheet">

<!-- Modal Hapus -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
