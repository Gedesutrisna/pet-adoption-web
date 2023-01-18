<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom border-dark fixed-top">
    <div class="container-fluid">
    <a class="navbar-brand" href="/">
    <img src="img/logo.jpeg" alt="" width="60" class="d-inline-block align-top">
    </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item mx-5">
        <a class="nav-link  " href="/">Home</a>
      </li>
       <li class="nav-item mx-5">
        <a class="nav-link " href="/donates">Donate</a>
      </li>
       <li class="nav-item mx-5">
        <a class="nav-link " href="/pets">Pets</a>
      </li>
       <li class="nav-item mx-5">
        <a class="nav-link " href="/campaigns">Campaigns</a>
      </li>
       <li class="nav-item mx-5">
        <a class="nav-link " href="/shelters">Shelter</a>
      </li>
     </ul>
    <div class="profile mx-lg-5">
      @auth
          
      <li class="nav-item dropdown list-unstyled">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          {{ Auth()->user()->name }}
          @if(Auth::user()->image)
     <img class="image rounded-circle" src="{{ asset('storage/' . Auth::user()->image ) }}" alt="profile_image" style="width: 50px;height: 50px; padding: 10px; margin: 0px; ">
@endif
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
  </nav>
  