<header class="navbar navbar-dark sticky-top bg-light flex-md-nowrap p-0 shadow " style="height: 50px">
  
    <a class="nav-link {{ Request::is('dashboard') ? 'active' : ''}}" aria-current="page" href="/dashboard" style="margin-left:10px;">
      <span data-feather="home"></span>
      Dashboard
    </a>
 
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="profile mx-lg-5">
    @auth
        
    <li class="nav-item dropdown list-unstyled">
      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ Auth::guard('admin')->user()->name }}
 
      </a>


      <ul class="dropdown-menu" style="margin-left:-70px; margin-top:30px;">
        <li><a href="/profile" class="dropdown-item">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        @can('admin')
        <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-window"></i> My Dashboard</a></li>
        <li><hr class="dropdown-divider"></li>
            
        @endcan
        
          <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
          </form>
      </ul>
    </li>
        @else
    <div class="profile">
        <a href="/login" class="nav-link"><i class="bi bi-person" style="font-size: 25px; color: black;"></i></a>
    </div>
    @endauth
  </div>
  </div>
</header>

