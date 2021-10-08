<!DOCTYPE html>
<html>
<head>
  @include('Template_homepage.head')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  @include('Template_homepage.navbar')

  <!-- Main Sidebar Container -->
  @include('Template_homepage.left-sidebar')

  <div class="content-wrapper">
      @yield('content')
  </div>

  @include('Template_homepage.footer')

</div>
</body>
</html>
