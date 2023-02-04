<nav class="navbar navbar-expand-lg bg-body-white">
    <div class="container">
      <a class="navbar-brand ms-2" href="#">Tw<span>&</span>ce</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav align-item-center mx-auto my-3 mb-2">
          <li class="nav-item-custom ms-5">
            <a class="nav-link" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item-custom ms-5">
            <a class="nav-link" aria-current="page" href="/pets">Pets</a>
          </li>  
          <li class="nav-item-custom ms-5">
            <a class="nav-link" aria-current="page" href="/campaigns">Campaign</a>
          </li>  
          <li class="nav-item-custom ms-5">
            <a class="nav-link" aria-current="page" href="/shelters">Shelters</a>
          </li>
        </ul>
        <form class="Search me-5" role="search">
          <div class="input-group">
            <button class="input-group-text border-end-0 bg-white"><i class="bi bi-search"></i></button>
            <input class="form-control border-start-0" type="text" placeholder="Search" aria-label="Search">
        </div>
        </form>
        <div class="profile-img my-3">
          @auth
            <a class="text-decoration-none " style="color:black;" href="/profile"> 
             @if (empty(Auth::user()->image))
             {{ Auth()->user()->name }}          
              @else
           <img class="image rounded-circle" src="{{ asset('storage/' . Auth::user()->image ) }}" alt="{{ Auth::user()->name }}" style="width: 50px;height: 50px; padding: 10px; margin: 0px; ">
              @endif
            </a>
              @can('admin')
              <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-window"></i> My Dashboard</a></li>
              <li><hr class="dropdown-divider"></li>   
              @endcan
              @else
      <div class="profile">
          <a href="/login" class="nav-link"><i class="bi bi-person" style="font-size: 25px; color: black;"></i></a>
      </div>
      @endauth
        </div>
      </div>
    </div>
  </nav>