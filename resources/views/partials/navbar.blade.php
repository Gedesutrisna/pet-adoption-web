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
          <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header d-block">
                  @if (auth()->check())
                          
                     
                  @foreach (Auth::user()->notification as $notification)
                  @if (!$notification->read_at)

                  @if ($notification->type == 'Adoption Declined'|| $notification->type == 'Adoption Declined')

                  <div class="alert alert-danger d-flex justify-content-between" role="alert">
                   <p style="font-size: 14px;">{{ $notification->data }}</p> 
                    <form action="{{ route('notification.read', $notification) }}" method="post">
                      @csrf
                      @method('PATCH')
                      <button class="btn btn-sm btn-primary" type="submit" style="font-size: 14px">Mark as Read</button>
                    </form>
                  </div>
                      
                  @else
                                          
                  <div class="alert alert-success d-flex justify-content-between" role="alert">
                    <p style="font-size: 14px;">{{ $notification->data }}</p> 
                    <form style="margin-left: 30px" action="{{ route('notification.read', $notification) }}" method="post">
                      @csrf
                      @method('PATCH')
                      <button class="btn btn-sm btn-primary" type="submit" style="font-size: 14px">Mark as Read</button>
                    </form>
                  </div>

                  @endif

                  @endif
                  @endforeach
                </div>
                <div class="modal-body">
                  <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>
                  
                </div>
                @else
                        
                @endif
              </div>
            </div>
          </div>
        
        </ul>
        @if (auth()->check())
            
        <button class="mx-20" type="button" style="border: 0px;background:none;margin-right:20px" data-bs-toggle="modal" data-bs-target="#exampleModal1">
         <i class="bi bi-bell"></i>
         </button>
        @else
<a href="login"  style="border: 0px;background:none;margin-right:20px;color: black;">  <i class="bi bi-bell"></i></a>       
            
        @endif

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
          <a href="/login" class="nav-link"><i class="bi bi-person" style="font-size: 25px; color: black;width: 50px;height: 50px; padding: 10px; margin: 0px;"></i></a>
      </div>
      @endauth
        </div>
      </div>
    </div>
  </nav>