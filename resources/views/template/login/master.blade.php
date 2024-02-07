<!DOCTYPE html>
<html lang="en">

<head>

  @include('template.admin.head')
  @yield('headmeta')

</head>

<body class="bg-brand-gradient">
  <!-- Container Fluid-->
  <div class="container">
    @yield('content')
  </div>
  <!-- Container Fluid-->

  @include('template.login.plugin')

  @yield('footjs')
</body>

</html>
