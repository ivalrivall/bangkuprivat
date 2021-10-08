<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{url('/home')}}" class="nav-link">Home</a>
    </li>
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link text-danger" href="{{ route('logout') }}" type="button"
      onclick="event.preventDefault();document.getElementById('logout-form').submit();">
      <!-- return confirm('Apakah Anda Yakin Logout?'); -->
        <i class="fas fa-arrow-alt-circle-right"></i> Log Out
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>
    </li>
  </ul>
</nav>
